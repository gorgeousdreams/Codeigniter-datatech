<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>datascience</title>

	<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/styles.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/dd.css')?>" rel="stylesheet">
	
	<script src="<?=base_url('assets/js/jquery-1.11.3.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/jquery.sha1.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/datascience.js')?>" type="text/javascript"></script>
	
	<script type="text/javascript">
	appConstant.url = "<?=base_url()?>";
	</script>
	
</head>
<body>
	<header class="navbar navbar-ds navbar-fixed-top bs-docs-nav" role="banner">
  		<div class="container">
    		<div class="navbar-header">
		      	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
		        	<span class="sr-only">Toggle navigation</span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		      	</button>
      			<div class="navbar-brand">
      				<img alt="" src="<?=base_url('assets/images/datascience_logo.jpg')?>">
      			</div>
    		</div>
    		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      			<ul class="nav navbar-nav">
       				<li class="<?php echo $current_page=='home' ? 'active': '' ?>">
       				<a title="Home" href="<?=base_url('home')?>">
       					<div class="icon"><i class="fa fa-home"></i></div>Home</a>
       				</li>
					<li class="<?php echo $current_page=='blog' ? 'active': '' ?>">
					<a title="Blogs" href="<?=base_url('blog')?>">
						<div class="icon"><i class="fa fa-edit"></i></div>Blog</a>
					</li>
					<li class="<?php echo $current_page=='events' ? 'active': '' ?>">
					<a title="Events" href="<?=base_url('events')?>">
						<div class="icon"><i class="fa fa-calendar-check-o"></i></div>Events</a>
					</li>
					<li class="<?php echo $current_page=='coolstuff' ? 'active': '' ?>">
						<a title="Cool Stuff" href="<?=base_url('coolstuff')?>">
						<div class="icon"><i class="fa fa-rocket"></i></div>Cool Stuff</a>
					</li>
					<li class="dropdown">
	        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	        			<div class="icon"><i class="fa fa-cubes"></i></div>Resources <b class="caret"></b></a>
	        			<ul class="dropdown-menu">
		          			<li><a title="" href="jobboard"><i class="fa fa-briefcase"></i> Job Board</a></li>
							<li><a title="" href="datasets"><i class="fa fa-database"></i> Datasets</a></li>
							<li><a title="" href="education"><i class="fa fa-cog"></i> Education</a></li>
							<li><a title="" href="glossary"><i class="fa fa-book"></i> Glossary</a></li>
	        			</ul>
	      			</li>
	      			<li class="dropdown <?php echo $current_page=='account' ? 'active': '' ?>">
	      				
	      				<?php if($loggedin==1){?>
	      				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	      				<div class="icon round"><i class="fa fa-user"></i></div><?=$nickName ?> <b class="caret"></b></a>
	      				<ul class="dropdown-menu arrow_box">
		          			<li><a title="" href="<?=base_url('profile')?>"><i class="fa fa-user"></i> Profile</a></li>
							<li><a title="" href="<?=base_url('messages')?>"><i class="fa fa-envelope"></i> Messages</a></li>
							<li><a title="" href="<?=base_url('readinglist')?>"><i class="fa fa-file-text-o"></i> Reading List</a></li>
							<li><a title="" href="<?=base_url('usercontent')?>"><i class="fa fa-folder-open"></i> Your Content</a></li>
							<li><a title="" href="<?=base_url('stats')?>"><i class="fa fa-line-chart"></i> Stats</a></li>
							<!-- li><a title="" href="settings"><i class="fa fa-gear"></i> Settings</a></li-->
							<li><a title="" href="<?=base_url('feedback')?>"><i class="fa fa-send"></i> Send Feedback</a></li>
							<li><a title="" href="<?=base_url('help')?>"><i class="fa fa-question-circle"></i> Help</a></li>
							<li><a title="" href="<?=base_url('user/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
	        			</ul>
	        			<?php }else{?><li> 
		       				<a title="Home" href="<?=base_url('signup')?>">
		       					<div class="icon"><i class="fa fa-user-plus"></i></div>Sign IN | SIGN UP</a>	       				
	        			<?php }?>
					</li>
					<li class="socials">
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-linkedin-square"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</li>
      			</ul>
    		</nav>
    		<div class="dropdown socials-sm">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
      			<div class="icon round"><i class="fa fa-share-alt"></i></div><b class="caret"></b></a>
				<ul class="dropdown-menu arrow_box">
					<li><a href=""><i class="fa fa-facebook"></i></a></li>
					<li><a href=""><i class="fa fa-twitter"></i></a></li>
					<li><a href=""><i class="fa fa-linkedin-square"></i></a></li>
					<li><a href=""><i class="fa fa-youtube"></i></a></li>
				</ul>
			</div>
    		
    		<!--  div class="search-box">
    			<div class="search-form">
    				<input id="search-checkbox" type="checkbox"/>
    				<label for="search-checkbox"><i class="fa fa-search"></i></label>
    				<input type="text" class="navbar-search" placeholder="Search"/>
    			</div>
    		</div-->
  		</div>
	</header>
<div id="main">
