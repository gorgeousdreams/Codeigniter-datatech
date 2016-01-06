<div id="jumbotron">
	<div id="banner-carousel" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>
		    <li data-target="#myCarousel" data-slide-to="4"></li>
		  </ol>
		
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="<?=base_url('assets/images/carousel_img.jpg')?>" alt="">
		      <div class="carousel-caption">
		        <h2></h2>
		      </div>
		    </div>
		
		    <div class="item">
		      <img src="<?=base_url('assets/images/carousel_img.jpg')?>" alt="">
		      <div class="carousel-caption">
		        <h2></h2>
		      </div>
		    </div>
		
		    <div class="item">
		      <img src="<?=base_url('assets/images/carousel_img.jpg')?>" alt="">
		      <div class="carousel-caption">
		        <h2></h2>
		      </div>
		    </div>
		    
		    <div class="item">
		      <img src="<?=base_url('assets/images/carousel_img.jpg')?>" alt="">
		      <div class="carousel-caption">
		        <h2></h2>
		      </div>
		    </div>
		    
		    <div class="item">
		      <img src="<?=base_url('assets/images/carousel_img.jpg')?>" alt="">
		      <div class="carousel-caption">
		        <h2></h2>
		      </div>
		    </div>
		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <div class="carousel_icon_prev">
		    	<i class="fa fa-angle-left fa-3x"></i>
		    </div>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <div class="carousel_icon_next">
		    	<i class="fa fa-angle-right fa-3x"></i>
		    </div>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</div>
</div>
<section id="about-us" class="first-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">	
				<div class="about-content">
					<div class="section-header-wrapper">
						<h1>About Us</h1>
					</div>
					<p>Data (Science) Products Resource Center is an online community for professional practitioners, students and businesses. 
					We provide a Data Science community center with content ranging from Data Engineering, Collection, Preparation, Integration, Analytics and Visualization.</p>
					<p>Our Resource Center provides an integral experience supporting our efforts to learn, teach, network and collaborate with similar interest individuals and experts from various fields.</p> 
					<p>The community-shared content covers the spectrum whether you are interested in introductory levels or state-of-art academic research.</p>
					
					<div class="section-header-wrapper"></div>
					<?php if($loggedin == 0){?>
					<a href="<?=base_url('Signup')?>"><button class="login-button">Login / Sign Up</button></a>
					<?php }?>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
</div>
</section>
<section id="topics">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Topics</h1>
		</div>
		<ul class="menu topics-category">
			<li class="first-item active"><a href="">Show All</a></li><li>
			<a href="">Data Engineering</a></li><li>
			<a href="">Collection</a></li><li>
			<a href="">Preparation</a></li><li>
			<a href="">Integration</a></li><li class="last-item">
			<a href="">Analytics and Visualization</a></li>
		</ul>
		
		<?php 
		if(!empty($topics['data']))
		{
			$rowCtr = 1;
			$colCtr = 0;
			foreach ($topics['data'] as $key => $topic): 
			
				if($colCtr == 0){?>
				<div class="row topic-grid">
			<?php }?>
			
			<div class="col-sm-2 col-sm-5ths">
			    <div class="topic-image-container">
			    	<?php if($topic['topic_img'] != "") {?>
			    	<img src="<?php echo base_url()."uploads/topic/".$topic['topic_img']; ?>" alt="">
			    	<?php } ?>
			    </div>
			    <h3><a rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ? base_url("post/".$topic["topic_url"]) : "#ex2"; ?>" ><?php echo ucfirst($topic['topic_title']); ?></a></h3>
		    </div>
		<?php 	$colCtr++;
				if($colCtr == 5){
					$colCtr = 0;
					$rowCtr++;
				?>
				</div>
			<?php }
			
			endforeach; }?>
	</div>
</section>
<section id="our-feeds">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Our Feeds</h1>
		</div>
		<div class="row">
		<?php 
		if(!empty($feeds['data']))
		{
			foreach ($feeds['data'] as $key => $feed): ?>
			<div class="col-sm-4">
				
				<div class="row top-section">
					<div class="col-sm-6">
						<h3><?=$feed["post_title"] ?></h3>
						<div class="author"><?=$feed["usrd_full_name"] ?></div>
						<div class="author-about"><span><?=$feed["usrd_about"] ?></span></div>
					</div>
					<div class="col-sm-6">
						<?php if(!empty($feed["post_img"])){?>
						<div class="topic-image-container">
							<img alt="" src="<?=base_url('uploads/post/'.$feed["post_img"])?>">
						</div>
						<?php }?>
					</div>
				</div>
				<div class="feed-content">
					<p><?=$feed["post_content"]?></p>
					<button class="see-more">See More</button>
				</div>
				<div class="content-stats">
					<div class="upvote">Upvote | <?=$feed["post_voted"] ?></div>
					<div class="downvote">Downvote | <?=$feed["post_devoted"] ?></div>
					<br>
					<div class="comments">Comment | 0</div>
					<div class="share">Share | 0</div>
				</div>
				<div class="tags-content">
					<span>Tags: <a href="">Question</a>, <a href="">Lecture</a>, <a href="">Blog</a>, <a href="">Article</a></span>
				</div>
			</div>
		<?php endforeach;
		}?>
		</div>
	</div>
</section>
<section id="contact-us">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Contact Us</h1>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h5>Leave us a message</h5>
				<form id="contact-us-form" action="">
					<div><input type="text" placeholder="Name"/><i class="fa fa-user"></i> Name</div>
					<div><input type="text" placeholder="Email"/><i class="fa fa-envelope"></i> Email</div>
					<div><input type="text" placeholder="Website"/><i class="fa fa-globe"></i> Website</div>
					<div><textarea rows="" cols=""></textarea></div>
					<button>Send Message</button>
				</form>
			</div>
			<div class="col-sm-6">
				<h5>Contact</h5>
				<div>
					<p>He turned, stared, bawled something about "crawling out in a thing like a dish cover," and ran on to the gate of the house at the crest. 
					A sudden whirl of black smoke driving across the road hid him for a moment.</p>
<br>
T: 0 800 500 55 123 465<br>
A: Johny Bravo, Street Number, City<br>
E: info@yourdomain.com
					</p>
				</div>
				<div class="socials">
					<div class="round"><a href=""><i class="fa fa-facebook"></i></a></div>
					<div class="round"><a href=""><i class="fa fa-twitter"></i></a></div>
					<div class="round"><a href=""><i class="fa fa-rss"></i></a></div>
					<div class="round"><a href=""><i class="fa fa-pinterest"></i></a></div>
					<div class="round"><a href=""><i class="fa fa-tumblr"></i></a></div>
					<div class="round"><a href=""><i class="fa fa-skype"></i></a></div>
				</div>
			</div>
		</div>
	</div>
</section>