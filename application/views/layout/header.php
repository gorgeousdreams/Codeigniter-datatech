<!DOCTYPE html>
<html>
<head>

	<title>Quora Clone</title>
	<script src="<?php echo base_url("resources/js/jquery-1.11.3.js")?> " type="text/javascript" charset="utf-8" ></script>
	<script src="<?php echo base_url("resources/js/jquery-ui.js")?> " type="text/javascript" charset="utf-8" ></script>
	<script type="text/javascript" charset="utf-8" async defer>
		var BASE_URL = "<?php echo base_url(); ?>";
	</script>
<script type="text/javascript" src="http://latex.codecogs.com/latexit.js"></script>
	<link  href="<?php echo base_url('resources/css/common.css'); ?>"  rel="stylesheet">
</head>
<body>

	<nav>
		<ul>
			<li><a class="login area-of-interest"  rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ? site_url() : "#ex2"; ?>" title="Home">Home</a></li>
			<li><a class="login area-of-interest"  rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ? site_url("categories") : "#ex2"; ?>" title="Categories">Categories</a></li>
			<?php if($this->session->userdata("user_id")){ ?>
			<li><a class="area-of-interest" href="<?php echo base_url("post/add"); ?>" title="Add New Post">Add Post</a></li>
			<li><a id="area-of-interest"  href="#ex1" rel="modal:open" title="Area Of Interests">Area Of Interests</a></li>
			<li><a id="area-of-expertise"  href="#ex3" rel="modal:open" title="Area Of expertise">Area Of expertise</a></li>
			<?php } ?>
			<?php if($this->session->userdata("user_id")){ ?>
			<li><a href="#message" rel="modal:open" title="Message a user">Send a message</a></li>
			<li><a href="<?php echo base_url("user/conversations") ?>" title="Inbox">Conversations</a></li>
			<li><a href="<?php echo base_url("user/logout"); ?>" title="Logout">Logout</a></li>
			<?php } else{?><li><a href="<?php echo base_url("user/login"); ?>" title="Login">Login</a></li>
			<?php }?>
		</ul>
	</nav>