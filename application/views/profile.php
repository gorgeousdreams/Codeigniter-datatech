<section id="account-contents" class="first-section">
	<div class="container">
		<h1 class="section-header">My Account</h1>
		<div class="row profile">
			<div class="col-sm-3">
				<div class="icon round bio-image"><i class="fa fa-user fa-5x"></i></div>
			</div>
			<?php
				if(!empty($profile['data']))
				{
					$userData = $profile['data'][0]; ?>
			<div class="col-sm-9">
				<h2><?=$userData["usrd_full_name"] ?></h2>
				<h3>Position or Title</h3>
				<br>
				<p><?=$userData["usrd_about"] ?></p>
			</div>
			<?php }?>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-3">
				<h3>Settings</h3>
			</div>
			<div class="col-sm-9">
				<h3>Account</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="category-list">
					<ul class="menu">
						<li><a href="#"><b>Account</b></a></li>
						<li><a href="#">Privacy</a></li>
						<li><a href="#">Email & Notifications</a></li>
						<li><a href="#">Topics of interest</a></li>
						<li><a href="#">Topics of expertise</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="content-overview">
					<div class="row settings-fields">
						<div class="col-sm-3">Primary Email:</div>
				<?php
				if(!empty($profile['data']))
				{
					$userData = $profile['data'][0]; ?>
						<div class="col-sm-9"><?=$userData["usr_email"] ?></div>
						<?php }?>
					</div>
					<hr>
					<div class="row settings-fields">
						<div class="col-sm-3">Password</div>
						<div class="col-sm-9"><a onclick="showPopupDiv(true)">Change Password</a></div>
					</div>
					<hr>
					<div class="row settings-fields">
						<div class="col-sm-3">Logout</div>
						<div class="col-sm-9">Logout of all other browsers</div>
					</div>
					<hr>
				</div>
				<br>
				<h3>Profile</h3>
				<div class="content-overview">
					<div class="row settings-fields">
						<div class="col-sm-3"><i class="fa fa-twitter fa-2x"></i> Twitter</div>
						<div class="col-sm-9"><button>Connect Twitter Account</button></div>
					</div>
					<hr>
					<div class="row settings-fields">
						<div class="col-sm-3"><i class="fa fa-facebook-square fa-2x"></i> Facebook</div>
						<div class="col-sm-9"><button>Connect Facebook Account</button></div>
					</div>
					<hr>
					<div class="row settings-fields">
						<div class="col-sm-3"><i class="fa fa-linkedin-square fa-2x"></i> LinkedIn</div>
						<div class="col-sm-9"><button>Connect LinkedIn Account</button></div>
					</div>
					<hr>
					<div class="row settings-fields">
						<div class="col-sm-3"><i class="fa fa-tumblr-square fa-2x"></i> Tumblr</div>
						<div class="col-sm-9"><button>Connect Tubmblr Account</button></div>
					</div>
					<hr>
					<div class="row settings-fields">
						<div class="col-sm-3"><i class="fa fa-wordpress fa-2x"></i> Wordpress</div>
						<div class="col-sm-9"><button>Connect Wordpress Account</button></div>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
	
	<?php 
	$currentPassword = '';
	$displayError = '';
	?>
	
	<div id="popupBox">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<a href="javascript:showPopupDiv(false)"><i class="fa fa-close"></i></a>
				<h3>Change Password</h3>
				<form id="changepass-form" onsubmit="return validateChangePassword();" method="POST">
				<input type="password" name="current_password" placeholder="Current Password" class="required" value="<?=$currentPassword?>"/><i class="fa fa-asterisk"></i> <span id="current_password"></span><br>
				<input type="password" name="password" placeholder="Password" class="required"/><i class="fa fa-asterisk"></i> <span id="password_emsg"></span><br>
				<input type="password" name="confirm_password" placeholder="Confirm Password" class="required"/><i class="fa fa-asterisk"></i> <span id="confirm_password_emsg"></span>
				<div id="error_message"><?=$displayError?></div>
				<button>Change Password</button>
			</form>			
			</div>
		</div>
	</div>
</section>
