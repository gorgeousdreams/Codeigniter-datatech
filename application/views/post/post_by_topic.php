<?php if($this->session->flashdata("success")) ?>
<label><?php echo $this->session->flashdata("success"); ?></label>
<?php if($this->session->flashdata("error")) ?>
<label><?php echo $this->session->flashdata("error"); ?></label>
<br>
<br>

<style>
	h3
	{
		margin:0;
	}		
	.truncate {
	  width: 350px;
	  white-space: nowrap;
	  overflow: hidden;
	  text-overflow: ellipsis;
	}
</style>
<div>
<?php 
if(!empty($posts['data']))
{
foreach ($posts['data'] as $key => $post): ?>
	<div>
		<?php if($post['img'] != "") {?>
		<div>
			<img width="50" src="<?php echo base_url()."uploads/post/".$post['id']."/".$post['img']; ?>" alt="">	
		</div>
		<?php } ?>
		<div>
			<h3><a rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ? base_url("post/".$post["url"]) : "#ex2"; ?>" ><?php echo ucfirst($post['title']); ?></a></h3>
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
<?php endforeach; } else{?>
	<label><?php echo $posts["msg"]; ?></label>
<?php } ?>
</div>