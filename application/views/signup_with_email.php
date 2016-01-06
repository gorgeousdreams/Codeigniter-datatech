<?php 
$oldFullName = '';
$oldEmail = '';
$displayError = '';
if($status == 'FAILED')
{
	$oldFullName = $fullname;
	$oldEmail = $email;
	$displayError = $errMsg;
}
?>
<section id="signup-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Sign Up</h1>
		</div>
		<div class="sign-up-wrapper">
			<form id="signup-form" onsubmit="return validateSignupForm();" action="<?=base_url('signup/register_email')?>" method="POST">
				<div><input type="text" name="full_name" placeholder="Full Name" class="required" value="<?=$oldFullName?>"/><i class="fa fa-asterisk"></i> <span id="full_name_emsg"></span></div>
				<div><input type="text" name="email" placeholder="Email" class="required" value="<?=$oldEmail?>"/><i class="fa fa-asterisk"></i> <span id="email_emsg"></span></div>
				<div><input type="password" name="password" placeholder="Password" class="required"/><i class="fa fa-asterisk"></i> <span id="password_emsg"></span></div>
				<div><input type="password" name="confirm_password" placeholder="Confirm Password" class="required"/><i class="fa fa-asterisk"></i> <span id="confirm_password_emsg"></span></div>
				<div id="error_message"><?=$displayError?></div>
				<button>Sign Up</button>
			</form>
		</div>
	</div>
</section>
