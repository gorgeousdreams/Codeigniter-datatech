<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    define('FACEBOOK_SDK_V4_SRC_DIR', APPPATH . "libraries/facebook/");
    require_once(APPPATH . "libraries/facebook/autoload.php");
    require_once(APPPATH . "libraries/facebook/FacebookSession.php");
    require_once(APPPATH . "libraries/facebook/FacebookRedirectLoginHelper.php");
    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);

class Social extends BaseController
{
    public $user = "";
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('User_model'));
    }

    function facebook()
    {
        $permissions = ['email', 'public_profile'];
        // Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
        $helper = new FacebookRedirectLoginHelper(site_url("social/fb_oauth"));
        $loginUrl = $helper->getLoginUrl($permissions);
        redirect($loginUrl);
    }

    function fb_oauth()
    {
          $helper = new FacebookRedirectLoginHelper(site_url("social/fb_oauth"));
          try
          {
                $session = $helper->getSessionFromRedirect();
                $request = new FacebookRequest($session, 'GET', '/me?fields=id,name,email,first_name,last_name,gender,address,cover');
                $response = $request->execute();
                $graphObject = $response->getGraphObject('Facebook\GraphUser');
                $fb_id = $graphObject->getId(); 
                $fb_name = $graphObject->getName(); 
                $fb_email = $graphObject->getEmail();

                $user = $this->User_model->check_email($fb_email);

                if($user['rc'])
                {
                    // user exists and login him/her to the system

                    $user_id = $user['data']['id'];
                    $user_data = array(
                            'updated_on' => time(),
                            'account_type' => FACEBOOK_ACCOUNT
                        );

                    $dir = FCPATH . "uploads/profile_images/" . $user_id . "/";

                    if($user['data']['profile_image'] == "" || !file_exists($dir.$user['data']['profile_image']))
                    {
                        $url = 'http://graph.facebook.com/'.$fb_id.'/picture?width=800&heigth=800';
                        $this->add_picture($user_id, $url, 'facebook.jpg');
                    }
                    // if($user['data']['gravatar_url'] == "" )
                    // {
                    //     $profile_pic_url = "https://graph.facebook.com/".$fb_id."/picture?width=700";

                    //     $user_data['gravatar_url'] = $profile_pic_url;
                    // }

                    $response = $this->User_model->update($user_id, $user_data);

                    $user_session_data = array(
                      'user_id' => $user_id,
                      'email' => $user['data']['email']
                    );

                    $result = $this->set_login_session_data($user_session_data);
                    if($this->session->userdata("user_id"))
                    {
                       //redirect("user/dashboard");exit;
                       redirect("dashboard");exit;
                    }

                }
                else
                {
                    $profile_pic_url = "https://graph.facebook.com/".$fb_id."/picture?width=700";
                    // register the user in the system and log him/her in

                    $default = base_url()."resources/images/avatar.jpg";
                    $size = 40;
                    
                    $email = trim( $fb_email ); // "MyEmailAddress@example.com"
                    $email = strtolower( $email ); // "myemailaddress@example.com"
                    $email = md5( $email );

                    $grav_url = "http://www.gravatar.com/avatar/" . $email. "";

                    $hash = md5(microtime().rand());                        
                    $user_data = array(
                      'name' => $fb_name,
                      'email' => $fb_email,
                      'created_on' => time(),
                      'account_type' => FACEBOOK_ACCOUNT,
                      'gravatar_url' => $grav_url,
                      "password" => $hash
                    );

                   $response = $this->User_model->add_user_from_social_login($user_data);

                      $session_data["user_id"] = $response["data"];
                      $session_data["email"] = $user_data["email"];
                      
                      $this->add_picture($response["data"], $profile_pic_url, 'facebook.jpg');
                      

                    $default = base_url()."resources/images/avatar.jpg";
                    $size = 40;
                    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $fb_email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

                    $user_data_ = array(
                        'updated_on' => time(),
                        'gravatar_url' => isset($grav_url)?$grav_url:""
                    );

                    $response = $this->User_model->update_gravatar_url($user_data_, $response["data"]);

                      $result = $this->set_login_session_data($session_data);

                      if($this->session->userdata("user_id"))
                      {
                          //redirect("user/dashboard");
                          redirect("dashboard");
                      }
                }
          } catch(FacebookRequestException $ex) {

              $this->session->flashdata("error", "There is some facebook issue currently. Please try again later.");
              redirect("user/login");exit;
              
            // When Facebook returns an error
          } catch(\Exception $ex) {
               $this->session->flashdata("error", "There is some local issue currently. Please try again later.");
              redirect("user/login");exit;
            // When validation fails or other local issues
          }
    }

    // function facebook()
    // {
    //     $fb_config = array(
    //         'appId' => FACEBOOK_APP_ID,
    //         'secret' => FACEBOOK_APP_SECRET,
    //         'cookie' => true
    //         );

    //     $this->load->library('facebook', $fb_config);
    //     $user = $this->facebook->get_user();

    //     pr($user);
    //     if($user)
    //     {
    //         try {
    //             $fbme = $facebook->api('/me');
    //           } catch (FacebookApiException $e) {
    //             error_log($e);
    //             $user = null;
    //           }

    //     }
    //     else
    //     {
    //         $loginUrl = $fb_config->login_url();
    //         header('Location: '.$loginUrl);
    //     }
    
    // }


    function linkedin()
    {    
        require(APPPATH . "libraries/linkedin/http.php");
        require(APPPATH . "libraries/linkedin/oauth_client.php");

        $client = new oauth_client_class;
        $client->server = 'LinkedIn';
        $client->redirect_uri = site_url('social/linkedin');

        $client->client_id = LINKEDIN_CLIENT_ID; 
        $application_line = __LINE__;
        $client->client_secret = LINKEDIN_CLIENT_SECRET;


        if(strlen($client->client_id) == 0
        || strlen($client->client_secret) == 0)
            die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
                'create an application, and in the line '.$application_line.
                ' set the client_id to Consumer key and client_secret with Consumer secret. '.
                'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
                'necessary permissions to execute the API calls your application needs.';

        if(($success = $client->Initialize()))
        {
            if(($success = $client->Process()))
            {
                if(strlen($client->access_token))
                {
                    $success = $client->CallAPI(
                        'https://api.linkedin.com/v1/people/~:(id,first-name,last-name,email-address,public-profile-url,headline,location,industry,summary,picture-url,positions,phone-numbers,primary-twitter-account)', 
                        'GET', array(
                            'format'=>'json'
                        ), array('FailOnAccessError'=>true), $lUser);
                }
            }
            $success = $client->Finalize($success);
        }

        if(strlen($client->authorization_error))
        {
            $client->error = $client->authorization_error;
            $success = false;
        }

        if($client->exit)
            exit;

        if($success)
        {
            $linkedinUser = json_decode(json_encode($lUser),true);
            
            if(!empty($linkedinUser))
            {
                $exists = $this->User_model->check_email($linkedinUser['emailAddress']);

                if($exists['rc'])
                {
                    // user exists and login him/her to the system

                    $user_id = $exists['data']['id'];
                    
                    if($exists['data']['gravatar_url'] == "" )
                    {
                        if(isset($linkedinUser['pictureUrl']))
                        {
                            $default = base_url()."resources/images/avatar.jpg";
                            $size = 40;
                            $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $linkedinUser['emailAddress'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

                            $user_data = array(
                                'updated_on' => time(),
                                'gravatar_url' => isset($grav_url)?$grav_url:""
                            );

                            $response = $this->User_model->update_gravatar_url($user_data,$user_id);


                            $dir = FCPATH . "uploads/profile_images/" . $user_id . "/";

                            if($exists['data']['profile_image'] == "" || !file_exists($dir.$exists['data']['profile_image']))
                            {
                                $url = $linkedinUser['pictureUrl'];
                                $this->add_picture($user_id, $url, 'linkedin.jpg');
                            }
                        }
                    }

                    $user_data = array(
                        'user_id' => $user_id,
                        'email' => $exists['data']['email']
                    );

                   $result = $this->set_login_session_data($user_data);
                   if($this->session->userdata("user_id"))
                   {
                       redirect("user/dashboard");exit;
                   }
                }
                else
                {
                    // register the user in the system and log him/her in
                    if(isset($linkedinUser['pictureUrl']))
                    {
                        $default = base_url()."resources/images/avatar.jpg";
                        $size = 40;
                        
                        $email = trim( $linkedinUser['emailAddress'] ); // "MyEmailAddress@example.com"
                        $email = strtolower( $email ); // "myemailaddress@example.com"
                        $email = md5( $email );

                        $grav_url = "http://www.gravatar.com/avatar/" . $email. "";
                        
                    }
                    
                    $hash = md5(microtime().rand());

                    $user_data = array(
                        'name' => $linkedinUser['firstName']." ".$linkedinUser['lastName'],
                        'email' => $linkedinUser['emailAddress'],
                        'created_on' => time(),
                        'gravatar_url' => isset($grav_url)?$grav_url:"",
                        'account_type' => LINKEDIN_ACCOUNT,
                        "password" => $hash
                    );

                    $response = $this->User_model->add_user_from_social_login($user_data);

                    $session_data["user_id"] = $response["data"];
                    $session_data["email"] = $user_data["email"];
                    $url = $linkedinUser['pictureUrl'];
                    $result_add_pic = $this->add_picture($response["data"], $url, 'linkedin.jpg');

                    $result = $this->set_login_session_data($session_data);

                    if($this->session->userdata("user_id"))
                    {
                        redirect("user/dashboard");exit;
                    }

                }
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Authentication error occured! Please try again.');
                redirect('login');
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Authentication error occured! Please try again.');
            redirect('login');
        }
    }

    function google_oauth()
    {

        ########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
        $google_client_id       = GOOGLE_CLIENT_ID;
        $google_client_secret   = GOOGLE_CLIENT_SECRET;
        $google_redirect_url    = base_url().'social/google_oauth'; //path to your script
        $google_developer_key   = GOOGLE_DEVELOPER_KEY;

        //include google api files
        require_once (APPPATH.'libraries/google-plus/Google_Client.php');
        require_once (APPPATH.'libraries/google-plus/contrib/Google_Oauth2Service.php');

        //start session
        //session_start();

        $gClient = new Google_Client();
        $gClient->setApplicationName('liilt_beta');
        $gClient->setClientId($google_client_id);
        $gClient->setClientSecret($google_client_secret);
        $gClient->setRedirectUri($google_redirect_url);
        $gClient->setDeveloperKey($google_developer_key);
        // $google_oauthV2 = new Google_Oauth2Service($gClient);
        //  $authUrl = $gClient->createAuthUrl();
        //  echo $authUrl; exit;
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        
       
        //If user wish to log out, we just unset Session variable
        if (isset($_REQUEST['reset'])) 
        {
          unset($_SESSION['token']);
          $gClient->revokeToken();
          header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
        }

        //If code is empty, redirect user to google authentication page for code.
        //Code is required to aquire Access Token from google
        //Once we have access token, assign token to session variable
        //and we can redirect user back to page and login.
        if (isset($_GET['code'])) 
        { 
            $gClient->authenticate($_GET['code']);
            //$_SESSION['token'] = $gClient->getAccessToken();
            $this->session->set_userdata('google_token', $gClient->getAccessToken());
            header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
            return;
        }

        if(isset($_GET['error']))
        {
            redirect("register");
        }
 
        if ($this->session->userdata('google_token'))
        { 
            $gClient->setAccessToken($this->session->userdata('google_token'));
        }

        if ($gClient->getAccessToken()) 
        {
            //For logged in user, get details from google using access token
            $googleuser = $google_oauthV2->userinfo->get();
               
            $exists = $this->User_model->check_email($googleuser['email']);

            if($exists['rc'])
            {
                // user exists and login him/her to the system
                $user_id = $exists['data']['id'];

                $dir = FCPATH . "uploads/profile_images/" . $user_id . "/";
                if($exists['data']['profile_image'] == "" || !file_exists($dir.$exists['data']['profile_image']))
                { 
                    $url = $googleuser['picture'];
                    $this->add_picture($user_id, $url, 'google.jpg');
                }

                $user_data = array(
                                'user_id' => $user_id,
                                'email' => $exists['data']['email']
                            );

               
                   $result = $this->set_login_session_data($user_data);

                   if($this->session->userdata("user_id"))
                   {
                       redirect("user/dashboard");exit;
                   }
            }
            else
            {
                // register the user in the system and log him/her in
                // facebook image = https://graph.facebook.com/$user['id']/picture?width=***

                $hash = md5(microtime().rand());

                if(isset($googleuser['picture']))
                {
                    $default = base_url()."resources/images/avatar.jpg";
                    $size = 40;
                    
                    $email = trim( $googleuser['email'] ); // "MyEmailAddress@example.com"
                    $email = strtolower( $email ); // "myemailaddress@example.com"
                    $email = md5( $email );

                    $grav_url = "http://www.gravatar.com/avatar/" . $email. "";
                    
                }

                $user_data = array(
                    'name' => $googleuser['given_name']." ".$googleuser['family_name'],
                    'email' => $googleuser['email'],
                    'created_on' => time(),
                    'gravatar_url' => isset($grav_url)?$grav_url:"",
                    'account_type' => GOOGLE_ACCOUNT,
                    "password" => $hash
                );

                $response = $this->User_model->add_user_from_social_login($user_data);

                $session_data["user_id"] = $response["data"];
                $session_data["email"] = $user_data["email"];
                
                $url = $googleuser['picture'];
                $result_add_pic = $this->add_picture($response["data"], $url, 'google.jpg');

                $result = $this->set_login_session_data($session_data);

                if($this->session->userdata("user_id"))
                {
                    redirect("user/dashboard");exit;
                }
            }
        }
        else 
        {
            //For Guest user, get google login url
            $authUrl = $gClient->createAuthUrl();
        }
        exit;
    }

    function add_picture( $user_id, $url, $name = '' )
    {
        $dir = FCPATH.'uploads/temp/';
        if(!is_dir($dir))
        {
            $old_umask = umask(0);
            mkdir($dir, 0777, true);
            umask($old_umask);
        }

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        
        // fetch the photo from google
        $img = file_get_contents($url, false, stream_context_create($arrContextOptions));
            
        // save the photo locally to a temp directory
        $temp_image = "temp_".rand(0, 9999).time().".jpg";
        $picture_temppath = $dir.$temp_image;
        file_put_contents($picture_temppath, $img);

        $res = $this->User_model->save_user_picture($user_id, $picture_temppath, $name);
        return $res;
    }

}