<section id="blog-contents" class="first-section">

 <script type="text/javascript">
	       var count = 10;
	        function customCheckbox(checkboxName){
	            var checkBox = $('input[name="'+ checkboxName +'"]');
	            $(checkBox).each(function(){
	                $(this).wrap( "<span class='custom-checkbox'></span>" );
	                if($(this).is(':checked')){
	                    $(this).parent().addClass("selected");
	                }
	            });
	            $(checkBox).click(function(){
	                $(this).parent().toggleClass("selected");
	                if($(this).is(':checked')) count --;
	                else count ++;
	                if(count<=0){
		                $('#interested_submit').prop('disabled', false);  
		                $('#interested_submit').html('continue');                    
	                }
	                else{
	                    $('#interested_submit').html('<span id="topic_count">10</span> More Topics to Continue');
	                    $('#interested_submit').attr('disabled','disabled');
	                    console.log(count);
	                    $('#topic_count').html(count);
	                    
	                }
	                
	            });
	            
	        }
	        $(document).ready(function (){
	            customCheckbox("selected_topics[]");
	        })
  </script>

<?php
	if($this->session->userdata('first_signup') ==2 )
		{
			$userData = array('user_id'=>$this->session->userdata('user_id'),
					'fullname'=>$this->session->userdata('full_name'),
					'email'=>$this->session->userdata('email'),
					'first_signup'=>1
			);
				
			$this->session->set_userdata($userData);
		   
?>
			<script type="text/javascript">
							$(document).ready(function(){
						        $('button[type="submit"]').attr('disabled','disabled');
								$('#myModal_interest').modal({
									backdrop: 'static'
								});
							});
			</script>
			<script>
			    $(document).ready(function(){
			        $('[data-toggle="popover"]').popover();   
			    });
 		    </script>

 		    <script>
				function myFunction() {
				    document.getElementById("myForm_interest").submit();
				}
            </script>


			<div class="container">
			  
				<div id="myModal_interest" class="modal fade">
				    <div class="modal-dialog modal-lg" style="height:60%">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h3 class="modal-title">Follow topics to see the best answers about them</h3>
				                <h4 class="modal-title">Select all the topics you're interested in</h4>
				            </div>
				            <div class="modal-body">
				            	<div style="height:600px; overflow-y:scroll;">
				                    <form class="container-fluid" id="myForm_interest" action="<?php echo base_url("user/insert_interest") ;?>" method="post" accept-charset="utf-8">
				                       	 <div class="row">
				                            	<?php
				                            		if(!empty($topics['data']))
				                            		{
				                            			foreach ($topics['data'] as $key => $topic) {?>

				                            				<div class="col-md-2 img-cell">	
				                            				<?php		
						                            			if($topic['topic_img'] != "") {?>
						    										<img src="<?php echo base_url()."uploads/topic/".$topic['topic_img']; ?>" width="130px" height="120px" alt="">
						    										<div class="img-text"><?php echo $topic['topic_title'] ?> </div>                                    
								                                    <div class="img-check">                                       
								                                        <label><input type="checkbox" name="selected_topics[]" value="<?php echo $topic['topic_id'] ?>" /> </label>
								                                    </div>
								                                    
								                                <?php }?>
								                            </div>
						    						    <?php }?>						    								
							    			
							    					<?php } ?>	

				                            </div>				                				                         	
				                    	</form>
					                </div>
				            	</div>
				            <div class="modal-footer">				                       
			                   <button type="submit" class="btn btn-primary" onclick="myFunction()" value="Submit" id="interested_submit" style="float:right"><span id="topic_count">10</span>More topics to continue</button> 
				            </div>
				        </div>
				    </div>
				</div>
			</div>				
<?php } 
	else if ($this->session->userdata('first_signup') ==1)
		{
			$userData = array('user_id'=>$this->session->userdata('user_id'),
					'fullname'=>$this->session->userdata('full_name'),
					'email'=>$this->session->userdata('email'),
					'first_signup'=>0
			);
				
			$this->session->set_userdata($userData);
		   
?>
			<div class="container">
  <!-- Trigger the modal with a button -->
			   <script type="text/javascript">
				$(document).ready(function(){
					$('#myModal_expertise').modal({
						backdrop: 'static'
					});
				});
			   </script>
			   
			    <script>
				    $(document).ready(function(){
				        $('[data-toggle="popover"]').popover();   
				    });
			    </script>
			    <script>
					function myFunction() {
					    document.getElementById("myForm_expertise").submit();
					}
            	</script>


				<div id="myModal_expertise" class="modal fade">
				    <div class="modal-dialog modal-lg" style="height:60%">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h3 class="modal-title" style="width:90%; margin-left:5%; margin-right:5%">What topics do you Know about?</h3>
			                    <h4 class="modal-title" style="width:90%; margin-left:5%; margin-right:5%">Add your area of study, hobbies, skills and other interests.</h4>
				           
				            </div>
				            <div class="modal-body">
			                    <div style="height:600px; overflow-y:scroll;">
				                    <form class="container-fluid" id="myForm_expertise" action="<?php echo base_url("user/insert_expertise");?>" method="post" accept-charset="utf-8">
										<div class="row">
			                            	<?php
			                            		if(!empty($topics['data']))
			                            		{
			                            			foreach ($topics['data'] as $key => $topic) {?>

			                            				<div class="col-md-2 img-cell">	
			                            				<?php		
					                            			if($topic['topic_img'] != "") {?>
					    										<img src="<?php echo base_url()."uploads/topic/".$topic['topic_img']; ?>" width="130px" height="120px" alt="">
					    										<div class="img-text"><?php echo $topic['topic_title'] ?> </div>                                    
							                                    <div class="img-check">                                       
							                                        <label><input type="checkbox" name="selected_topics[]" value="<?php echo $topic['topic_id'] ?>" /> </label>
							                                    </div>
							                                    
							                                <?php }?>
							                            </div>
					    						    <?php }?>						    								
						    			
						    					<?php } ?>	

					                    </div>				           
				                    </form>
			                    </div>>
				                
				            </div>
				            <div class="modal-footer">				                       
			                   <button type="submit" class="btn btn-primary" onclick="myFunction()" value="Submit" id="expertise_submit" style="float:right">Submit</button> 
				            </div>
				        </div>
				    </div>
				</div>
			</div>				
<?php } ?>	
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				
				<div class="search-form">
					<span><i class="fa fa-search"></i>Quick Search</span>
					<input type="text"/>
				</div>
				<div class="container-title-bg-c">
					<span><a href=""><i class="fa fa-refresh"></i> Refresh Feeds</a></span>
				</div>
				<div>
					<?php 
					if(!empty($feeds['data']))
					{
						$this->load->helper('date');
						foreach ($feeds['data'] as $key => $feed):?>
					<div class="single-content">
						
						<div class="row">
							<div class="col-sm-3 post-info">
								<div class="author-avatar"></div>
								<div class="content-stats">
									<div class="upvote"><button>Upvote | <?=$feed["post_voted"] ?></button></div>
									<br>
									<div class="downvote"><button>Downvote | <?=$feed["post_devoted"] ?></button></div>
									<br>
									<div class="comments"><button>Comment | <?=$feed["comments"] ?></button></div>
									<br>
									<div class="btn-group other-button-options">
								        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><button>Share | <?=$feed["shares"] ?></button></a>
								        <ul class="dropdown-menu">
								            <li><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></li>
								            <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
								            <li><a href="#">Embed</a></li>
								        </ul>
								    </div>
								</div>
							</div>
							<div class="col-sm-9 post-content">
								<h3 class="content-title"><?=$feed["post_title"] ?></h3>
								<div class="author"><?=$feed["usrd_full_name"] ?>, <?=$feed["usrd_about"] ?></div>
								<span><?=$feed["post_voted"] ?> upvotes by ...</span>
								<p><?=$feed["post_content"]?></p>
								<div class="content-buttons">
									<button class="see-more">See More</button>
									<div class="btn-group other-button-options">
								        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-h"></i></button>
								        <ul class="dropdown-menu">
								            <li><a href="#"><input type="checkbox"/>Add to Reading List</a></li>
								            <li><a href="#" class="icon-indent">Thank</a></li>
								            <li><a href="#" class="icon-indent">Report Answer</a></li>
								            <li><a href="#" class="icon-indent">Remove From Feed</a></li>
								        </ul>
								    </div>
								</div>
							</div>
						</div>
						<div class="content-category border-top">
							<span><a href="">Academic</a>, 
							<a href="">Analytic</a>, 
							<a href="">Business</a>, 
							<a href="">IOTs</a>, 
							<a href="">Python</a>,
							<a href="">R</a>,
							<a href="">Data Mining</a>,
							<a href="">Machine Learning</a>
							</span> |
							<span><?php echo mdate('%M %d, %Y', strtotime($feed["post_crd"])) ?></span>
						</div>
					</div>	
					<?php endforeach; }?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="new-post-form">
					<button class="new-post" onclick="showPopupDiv(true)">Write New Post</button>
					<div class="middle-hline"></div>
				</div>
				<div class="container-title-bg">
					<span>Feed Topics</span><button>Edit</button>
				</div>
				<ul class="topic-list">
				<?php 
				if(!empty($topics['data']))
				{
					foreach ($topics['data'] as $key => $topic):?>
					<li><i class="fa fa-circle"></i> <?=$topic["topic_title"] ?></li>
				<?php endforeach; }?>
				</ul>
				<div class="container-title-bg">
					<span>My Recent Posts</span>
				</div>
				<ul class="recent-post-list">
				<?php 
				if(!empty($user_posts['data']))
				{
					foreach ($user_posts['data'] as $key => $user_post):?>
					<li><?=$topic["post_content"] ?></li>
				<?php endforeach;
				}else{
					echo 'You don\'t have any post yet';
				}?>
				</ul>
				<div class="container-title-bg">
					<span>Trending</span>
				</div>
				<ul class="trending-list">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
				</ul>
			</div>
		</div>
	</div>
</section>
<div id="popupBox">
	<div class="popupBoxWrapper">
		<div class="popupBoxContent">
			<a href="javascript:showPopupDiv(false)"><i class="fa fa-close"></i></a>
			<h3>Add Post</h3>
			<div id="newpost-form" class="newpost-form">
				<div class="key-value">
					<div class="field-name inline">Category</div>
					<div class="select-wrapper inline">
						<select name="category" class="required">
						<option value="">-- Select a Category --</option>
						<?php 
						if(!empty($categories['data']))
						{
							foreach ($categories['data'] as $key => $category):?>	
							<option value="<?=$category["cat_id"] ?>"><?=$category["cat_title"] ?></option>
						<?php endforeach; }?>
						</select>
					</div>
				</div>
				<div class="key-value">
					<div class="field-name inline">Title</div>
					<input type="text" name="title" class="popup-form required"/>
				</div>
				<div class="key-value">
					<div class="field-name inline">URL</div>
					<input type="text" name="url" class="popup-form required"/>
				</div>
				<div class="key-value">
					<div class="field-name inline">Content</div>
					<textarea name="content" class="popup-form required"></textarea>
				</div>
				<div class="key-value">
					<div class="field-name inline" style="line-height:20px;">Image </div><input type="file" name="image" class="inline"/>
				</div>
				<button onclick="do_add_record('newpost-form','post/add','dashboard')">Add</button>
			</div>
		</div>
	</div>
</div>
