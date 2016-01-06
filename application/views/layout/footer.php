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
    <?php $user_data = $user_data_expertise = array();

$user_id = $this->session->userdata("user_id");

$get_area_of_interest_by_user = get_area_of_interest_by_user_id($user_id);

$categories_and_areas = get_area_of_interest();

$get_area_of_expertise_by_user = get_area_of_expertise_by_user_id($user_id);

if(!empty($get_area_of_interest_by_user["data"]))
{
	$user_data = $get_area_of_interest_by_user["data"];
}
if(!empty($get_area_of_expertise_by_user["data"]))
{
	$user_data_expertise = $get_area_of_expertise_by_user["data"];
}
// pr($user_data);exit;
?>

<!-- login popup -->
<div class="login-modal current" id="ex2">
	<center>
		<h2>Please Login First</h2>
		<br>
		<h3><a class="register-social-button-linkedin" href="<?php echo site_url('social/facebook');?>"><i class="fa fa-linkedin-square"></i> Facebook</a>
		<a class="register-social-button-linkedin" href="<?php echo site_url('social/linkedin');?>"><i class="fa fa-linkedin-square"></i> Linkedin</a>
		<a class="register-social-button-google" href="<?php echo $authUrl;?>"><i class="fa fa-google-plus"></i> Google</a></h3>
	</center>
</div>

<!-- Modal HTML embedded directly into document -->
<div class="modal current" id="ex1">

	<?php if($this->session->flashdata("success_i")) {?>
	<label class="success"><?php echo $this->session->flashdata("success_i"); ?></label>
	<?php } ?>
	<?php if($this->session->flashdata("error_i")) {?>
	<label class="error"><?php echo $this->session->flashdata("error_i"); ?></label>
	<?php } ?>

	<form action="<?php echo base_url("user/post_interest") ;?>" method="post" accept-charset="utf-8">
		<div>
			<h4>Area of Interest</h4>
		</div>
		<?php	if($categories_and_areas["rc"]) 
		{
			$clear = "";
			foreach($categories_and_areas["data"] as $key => $category)
			{

				if($key%4 == 0)
				{
					$clear = "clear: both;width: 25%;float: left;display: block";
				}
				else
				{
					$clear = "width: 25%;float: left";
				}
				?>

				<div style="<?php echo $clear?>">
					<h5><?php echo $category["title"]?></h5>
					<?php if(isset($category['topics']) && !empty($category['topics']))
					{
						foreach($category['topics'] as $topic)
						{
							?>
							<div>
								<input type="checkbox" class="area-of-interest-topics" name="topics[<?php echo $category['id']?>][]" value="<?php echo $topic["id"]?>" <?php echo !empty($user_data) && isset($user_data[$category['id']]) && in_array($topic["id"],$user_data[$category['id']]) ? "checked" : "" ; ?>><?php echo $topic["topic"]?>
							</div>
							<?php } 
						}?>
					</div>
					<?php } 

				}?>

				<div style="display: inline-block;float: right;clear: both;">
					<button type="submit" class="save-area-of-interest">Save</button>
					<a style="position:relative" href="#close-modal" rel="modal:close"><button type="button">Close</button></a>
				</div>
			</form>
		</div>

		<!-- Modal HTML embedded directly into document -->
		<div class="modal-expertise current" id="ex3">

			<?php if($this->session->flashdata("success_e")) {?>
			<label class="success"><?php echo $this->session->flashdata("success_e"); ?></label>
			<?php } ?>
			<?php if($this->session->flashdata("error_e")) {?>
			<label class="error"><?php echo $this->session->flashdata("error_e"); ?></label>
			<?php } ?>

			<form action="<?php echo base_url("user/post_expertise") ;?>" method="post" accept-charset="utf-8">
				<div>
					<h4>Area of expertise</h4>
				</div>
				<?php	if($categories_and_areas["rc"]) 
				{
					$clear = "";
					foreach($categories_and_areas["data"] as $key => $category)
					{

						if($key%4 == 0)
						{
							$clear = "clear: both;width: 25%;float: left;display: block";
						}
						else
						{
							$clear = "width: 25%;float: left";
						}
						?>

						<div style="<?php echo $clear?>">
							<h5><?php echo $category["title"]?></h5>
							<?php if(isset($category['topics']) && !empty($category['topics']))
							{
								foreach($category['topics'] as $topic)
								{
									?>
									<div>
										<input type="checkbox" class="area-of-expertise-topics" name="topics[<?php echo $category['id']?>][]" value="<?php echo $topic["id"]?>" <?php echo !empty($user_data_expertise) && isset($user_data_expertise[$category['id']]) && in_array($topic["id"],$user_data_expertise[$category['id']]) ? "checked" : "" ; ?>><?php echo $topic["topic"]?>
									</div>
									<?php } 
								}?>
							</div>
							<?php } 

						}?>

						<div style="display: inline-block;float: right;clear: both;">
							<button type="submit" class="save-area-of-expertise">Save</button>
							<a style="position:relative" href="#close-modal" rel="modal:close"><button type="button">Close</button></a>
						</div>
					</form>
				</div>

				<!-- mahana message popup -->
				<!-- Get all users -->
				<?php if($this->session->userdata("user_id")) {?>
				<?php $users = get_all_users(); ?>
				<div id="message" >
					<div class="message-popup-body">
						<?php if(!empty($users["data"])){ ?>
						<form action="<?php echo base_url("user/send_message"); ?>" method="post" accept-charset="utf-8">
							<input type="hidden" name="new_message" value="1">
							<div>
								<select name="user_id" class="user-dropdown user_id">
									<option value="">Select User</option>
									<?php foreach ($users["data"] as $key => $user) { ?>
									<option value="<?php echo $user["id"] ?>"><?php echo ucwords($user["name"]); ?></option>
									<?php } ?>	
								</select>
							</div><br>
							<div>
								<textarea name="message" class="message-textarea" rows="10" cols="45"></textarea>
							</div>
							<div class="error-div" style="display:none">
							<span clss='error'>Message can not be blank.</span>
							</div>
							<div>
								<button type="submit" class="send-message">Send</button>
							</div>
						</form>
						<?php } else {?>
						<h3>No User Found</h3>
						<?php } ?>
					</div>
				</div>
				<?php } ?>

				<!-- modal resources -->

				<script src="<?php echo base_url("resources/plugin/modal/jquery.modal.js")?> " type="text/javascript" charset="utf-8" ></script>
				<script src="<?php echo base_url("resources/plugin/modal/jquery.modal.min.js")?> " type="text/javascript" charset="utf-8" ></script>
	
				<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("resources/plugin/modal/jquery.modal.css"); ?>">

				<!-- <script src="<?php echo base_url("resources/js/jquery-1.11.3.min.map")?> " type="text/javascript" charset="utf-8" ></script> -->

				<!-- loading select2 plugin -->

				<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
				<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

				<script type="text/javascript" src="<?php echo base_url()?>resources/ckeditor/ckeditor.js"></script>

				<script src="<?php echo base_url("resources/js/global.js")?> " type="text/javascript" charset="utf-8" ></script>
				<?php $check_number_of_areas_of_interest = check_number_of_areas_of_interest($user_id);

				if($this->session->userdata("user_id") && ($check_number_of_areas_of_interest["rc"] && $check_number_of_areas_of_interest["data"]["count"] < 10 ) || ($check_number_of_areas_of_interest["rc"] == FALSE))
				{?>
					<script>
						$(document).ready(function(){
							$("#area-of-interest").trigger("click");
							return false;
						});
					</script>
				<?php } ?>

				<?php if( (!empty($_GET)) && isset($_GET["status"]) && ($_GET["status"] == "updated" || $_GET["status"] == "error") ){ ?>
					<script>
						$(document).ready(function(){
							$("#area-of-interest").trigger("click");
							return false;
						});
					</script>
				<?php } ?>
				<?php if( (!empty($_GET)) && isset($_GET["status"]) && ($_GET["status"] == "updated_expertise" || $_GET["status"] == "error_expertise") ){ ?>
					<script>
						$(document).ready(function(){
							$("#area-of-expertise").trigger("click");
							return false;
						});
					</script>
				<?php } ?>
	</body>
</html>