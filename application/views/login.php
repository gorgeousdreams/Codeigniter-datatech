<section id="signup-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Login</h1>
		</div>
		<div class="sign-up-wrapper">
			<div class="row">
				<div class="col-sm-6 social-buttons">
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
				
					<a href="<?php echo $authUrl;?>">
					<button class="btn-google">
						<i class="fa fa-google-plus-square fa-2x"></i> <span>Login With Google</span>
					</button>
					</a>
					<a href="<?php echo site_url('social/facebook'); ?>">
					<button class="btn-facebook">
						<i class="fa fa-facebook-square fa-2x"></i> <span>Login With Facebook</span>
					</button>
					</a>
					<button class="btn-twitter">
						<i class="fa fa-linkedin-square fa-2x"></i> <span>Login With LinkedIn</span>
					</button>
					
					<!-- button class="btn-twitter">
						<i class="fa fa-twitter-square fa-2x"></i> <span>Sign Up With Twitter</span>
					</button-->
					<div class="with-email-wrapper">
						<h4 class="or-with-email">Or</h4>
						<h3><a href="<?=base_url('signup/signup_with_email')?>">Sign Up with your Email</a></h3>
					</div>
					<div id="status" style="display: none;"></div>
				</div>
				<div class="col-sm-6">
					<div id="login-form" class="login-form">
						<h3>Login</h3>
						<div><input type="text" name="email" class="required" placeholder="Email"/></div>
						<div><input type="password" name="password" class="required" placeholder="Password"/></div>
						<div id=error_message style="display: none;"></div>
						<div><input type="checkbox" name="remember_me" id="remember_me"/> Remember Me</div>
						<div><span>Forgot Password?</span></div>
						<button onclick="doLoginUser()">Login</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
