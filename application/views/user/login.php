  <?php
  ########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
    $google_client_id       = GOOGLE_CLIENT_ID;
    $google_client_secret   = GOOGLE_CLIENT_SECRET;
    $google_redirect_url    = site_url('social/google_oauth'); //path to your script
    $google_developer_key   = GOOGLE_DEVELOPER_KEY;

    //include google api files
    require_once (APPPATH.'libraries/google-plus/Google_Client.php');
    require_once (APPPATH.'libraries/google-plus/contrib/Google_Oauth2Service.php');
    
    $gClient = new Google_Client();
    $gClient->setApplicationName('liilt_beta');
    $gClient->setClientId($google_client_id);
    $gClient->setClientSecret($google_client_secret);
    $gClient->setRedirectUri($google_redirect_url);
    $gClient->setDeveloperKey($google_developer_key);

    $google_oauthV2 = new Google_Oauth2Service($gClient);
    $authUrl = $gClient->createAuthUrl();
    
    ?>

<a class="login area-of-interest" href="<?php echo site_url(); ?>" title="Home">Home</a>
<br>
<br>
<h3 style="margin-top: 0;">Social account login</h3>

<a class="register-social-button-facebook" href="<?php echo site_url('social/facebook'); ?>"><i class="fa fa-facebook-square"></i> Facebook</a>

<a class="register-social-button-linkedin" href="<?php echo site_url('social/linkedin');?>"><i class="fa fa-linkedin-square"></i> Linkedin</a>

<a class="register-social-button-google" href="<?php echo $authUrl;?>"><i class="fa fa-google-plus"></i> Google</a>