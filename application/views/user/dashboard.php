<style>
	h3
	{
		margin:0;
	}	
</style>
<?php if($this->session->flashdata("success")) ?>
<label><?php echo $this->session->flashdata("success"); ?></label>
<?php if($this->session->flashdata("error")) ?>
<label><?php echo $this->session->flashdata("error"); ?></label>
<br>
<br>

<?php if($this->session->userdata("user_id"))
{
	?>
	<label>Hello <?php echo isset($user_details['data']['name']) ? ucwords($user_details['data']['name']) : ""; ?></label>
	<?php if(!file_exists(FCPATH."uploads/profile_images/".$user_details['data']['id']."/".$user_details['data']['profile_image'])) { ?>
		<img src="<?php echo isset($user_details['data']['gravatar_url']) ? $user_details['data']['gravatar_url'] : "" ; ?>" alt="Profile Picture" width='150 ' />
	<?php } else{ ?>
		<img src="<?php echo isset($user_details['data']['profile_image']) ? base_url("uploads/profile_images/".$user_details['data']['id']."/".$user_details['data']['profile_image']) : "" ; ?>" alt="Profile Picture" width='150 ' />
	<?php } ?>
	<?php }?>
	<br>
	<br>

	<!-- search form -->

	<div class="dashboard-search-box">
		<form action="<?php echo base_url("user/dashboard") ?>" method="get" accept-charset="utf-8">

			<div>
				<select class="dashboard-category" name="category">
					<option value="">Select A Category</option>
					<?php if(!empty($categories)){ foreach ($categories as $key => $category): ?>
						<option value="<?php echo $category["id"] ?>" <?php echo $this->input->get("category") == $category["id"] ? "Selected='selected'" : "" ?>><?php echo $category["title"] ?></option>
					<?php endforeach; } ?>
				</select>
			</div>
			<div>
				<select class="dashboard-topics" name="topic[]" multiple style="width:25%">
					<option value="">Select Topics</option>
					<?php if(isset($topics) and !empty($topics["data"])){ ?>
					<?php foreach ($topics["data"] as $key => $value) { ?>
					<option value="<?php echo $value["id"] ?>" <?php echo isset($_GET["topic"]) && in_array($value["id"], $_GET["topic"]) ? "Selected='selected'" : "" ?>><?php echo $value["topic"] ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div>
			<div>
				<select class="dashboard-tags form-control" multiple="multiple" name="tag[]" style="width:25%">
					<?php
					if(!empty($tags["data"])){
						foreach($tags["data"] as $tag)
							{ ?>
						<option value="<?php echo $tag['tag']?>"><?php echo $tag['tag']; ?></option>}
						<?php } } ?>
					</select>
				</div>
				<div>
					<input type="text" name="extra_param" value="<?php echo $this->input->get("extra_param") ? $this->input->get("extra_param") : "" ?>" style="width:25%" placeholder="Title or Content">
				</div>
				<div>
					<button type="submit">Search</button>
				</div>
			</form>
		</div>

		<br>

		<i><h3>Recent Posts</h3></i>
		<br>
		<div>
			<?php 
			if((isset($posts) && $posts != "") && (!empty($posts['data'])))
			{
				foreach ($posts['data'] as $key => $post): ?>
				<div>
					<?php if($post['img'] != "") {?>
					<div>
						<?php 
						$offset = explode( '.',$post['img']);
						$image_path = base_url()."uploads/post/".$post['id']."/".$offset['0']."".HEIGHT_FOR_POST_LISTING."_".WIDTH_FOR_POST_LISTING.".jpg";
						?>
						<img width="50" src="<?php echo $image_path; ?>" alt="">	
					</div>
					<?php } ?>
					<div>
						<h3><a  rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ? base_url("post/".$post["url"]) : "#ex2"; ?>" ><?php echo ucfirst($post['title']); ?></a></h3>
					</div>
					<div class="truncate">
						<?php echo $post['raw_content']?>
					</div>
					<?php if($this->session->userdata("user_id")){ ?>
					<div class="accordion">

						<h3 class="accordion-header-comments">Comments</h3>
						<div>
							<div>
								<div><label class="voted-count"><?php echo $post["voted"]?></label><span class="vote" data-type="vote" data-post-id = "<?php echo $post["id"] ?>">Vote</span></div>
								<div><label class="devoted-count"><?php echo $post["devoted"]?></label><span class="vote" data-type="devote"  data-post-id = "<?php echo $post["id"] ?>">Devote</span></div>
							</div>
							<input type="hidden" name="post_id" class="post-id" value="<?php echo $post["id"]?>" data-is-question="<?php echo $post["type"]?>" placeholder="">
							<input type="hidden" name="user_id" class="user-id" value="<?php echo $this->session->userdata("user_id")?>" placeholder="">
							<input type="hidden" name="created_by" class="created-by" data-session-id="<?php echo $this->session->userdata("user_id") ?>" value="<?php echo $post["created_by"]?>" placeholder="">
							<textarea name="comment" class="comment"></textarea>
							<?php echo form_error("comment")."<br>"; ?>
							<div class="error-empty-comment-div" style="display:none">Comment Field can not be empty.<br></div>
							<button type="button" class="post-comment">Post Comment</button><br><br>
							<div class="comment_display_div">
								<?php if(!empty($post["comments"])) foreach ($post["comments"] as $comment): ?>
									<div class="">
										<?php if(($post["type"] == QUESTION) && ($post["created_by"] == $this->session->userdata("user_id"))){ ?>
										<input type="checkbox" name="is_answer" class="check_comment" data-comment-id="<?php echo $comment["id"] ?>" <?php echo $comment["is_answer"] == 1 ?'checked':''; ?> >
										<?php }?>
										<span class="commented-by"><?php echo $comment["name"]; ?> :</span>
										<span class="comment-by-user"><?php echo $comment["comment"]?></span>&nbsp;&nbsp;<span class="ago"> <?php echo ago($comment["created_on"])." ago";?></span>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>

					<?php } ?>
				</div>
				<br>
				<br>
			<?php endforeach; } else {?>
			<label><?php echo $posts["msg"]; ?></label>
			<?php } ?>
		</div>