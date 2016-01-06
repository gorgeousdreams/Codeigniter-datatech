<script type="text/javascript">
	window.fbAsyncInit = function() {     
    FB.init({
        appId      : <?php echo FACEBOOK_APP_ID; ?>,
        status     : true,
        xfbml      : true
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "http://connect.facebook.net/en_US/all.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<!-- twitter -->
<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>
<script src="https://platform.twitter.com/widgets.js"></script>
<script src="<?php echo base_url();?>/resources/js/custom/post_post_by_url.js" type="text/javascript"></script>
<?php if($this->session->flashdata("success")) ?>
<label><?php echo $this->session->flashdata("success"); ?></label>
<?php if($this->session->flashdata("error")) ?>
<label><?php echo $this->session->flashdata("error"); ?></label>

<?php $posts = $posts["data"];?>
<div>

	<div>
		<label><?php echo $posts['title'];?></label>
	</div>
	<?php $image_path =""; if($posts['img'] != "") {
			$image_path = base_url()."uploads/post/".$posts['id']."/".$posts['img']; 
		?>

	<div>
		<img width="50" src="<?php echo $image_path ?>" alt="">	
	</div>
	<?php } ?>
	<div>Content:
		<?php echo $posts["raw_content"];?>
	</div>
	<div>
		<label>Tags:</label>
		<?php $post_tags = "";
		$tag_count = count($posts["tags"]);

		foreach($posts["tags"] as $tag_key => $tag)
		{
			$url = $this->session->userdata("user_id") ? base_url('user/dashboard?tag%5B%5D='.$tag["tag"]) : "#ex2";
			$rel = $this->session->userdata("user_id") ? "" : "modal:open";

			if($tag_count != $tag_key+1)
				$post_tags .= "<a  rel= '".$rel."' href='".$url."'>".ucfirst($tag["tag"])."</a>, ";
			else
				$post_tags .= "<a  rel= '".$rel."' href='".$url."'>".ucfirst($tag["tag"])."</a>";
		}
		 ?>
		<?php echo $post_tags;?>
	</div>
	<div>
	
		<label>Topics:</label>
		<?php $post_topics = "";
		$topic_count = count($posts["topics"]);

		foreach($posts["topics"] as $topic_key => $topic)
		{
			$url = $this->session->userdata("user_id") ? base_url('user/dashboard?topic%5B%5D='.$topic["id"]) : "#ex2";
			$rel = $this->session->userdata("user_id") ? "" : "modal:open";

			if($topic_count != $topic_key+1)
				$post_topics .= "<a rel= '".$rel."' href='".$url."'>".ucfirst($topic["topic"])."</a>, ";
			else
				$post_topics .= "<a rel= '".$rel."' href='".$url."'>".ucfirst($topic["topic"])."</a>";
		} ?>
		<?php echo $post_topics;?>
	</div>
	<div>
		<label>Category : </label>
		<?php 
			$url = $this->session->userdata("user_id") ? base_url('user/dashboard?category='.$posts["category"]["id"]) : "#ex2";
			$rel = $this->session->userdata("user_id") ? "" : "modal:open";
		 ?>
		<?php echo "<a rel= '".$rel."' href='".$url."'>".$posts["category"]["title"]."</a>";?>
	</div>
	<br>
	<?php if($posts["created_by"] == $this->session->userdata("user_id")){?>
		<a href="<?php echo base_url()?>post/edit/<?php echo $posts['id']?>"><button type="button">Edit</button></a>
	<?php } ?>
	<br>
	<br>

	<div class="total_shares">
		Total shares: <?php if($share_count["data"] !="")
							{	echo $share_count["data"];	}
							else
							{	echo "0";	}
						?>
	</div>

	<div class="view-count">
		<span>Views : </span><span><?php echo ($posts["viewed_count"]["viewed_count"]); ?></span>
	</div>
		<?php if($this->session->userdata("user_id")) { ?>
		<div>
			<div><label class="voted-count"><?php echo $posts["voted"]?></label><span class="vote" data-type="vote" data-post-id = "<?php echo $posts["id"] ?>">Vote</span></div>
			<div><label class="devoted-count"><?php echo $posts["devoted"]?></label><span class="vote" data-type="devote"  data-post-id = "<?php echo $posts["id"] ?>">Devote</span></div>
		</div>
		<input type="hidden" name="post_id" class="post-id" value="<?php echo $posts["id"]?>" data-is-question="<?php echo $posts["type"]?>" placeholder="">
		<input type="hidden" name="user_id" class="user-id" value="<?php echo $this->session->userdata("user_id")?>" placeholder="">
		<input type="hidden" name="created_by" class="created-by" data-session-id="<?php echo $this->session->userdata("user_id") ?>" value="<?php echo $posts["created_by"]?>" placeholder="">
		<textarea name="comment" class="comment"></textarea>
		<?php echo form_error("comment")."<br>"; ?>
		<div class="error-empty-comment-div" style="display:none">Comment Field can not be empty.<br></div>
		<button type="button" class="post-comment">Post Comment</button><br><br>
		<div class="comment_display_div">
		<?php if(!empty($posts["comments"])) foreach ($posts["comments"] as $comment): ?>
			<div class="">
				<?php if(($posts["type"] == QUESTION) && ($posts["created_by"] == $this->session->userdata("user_id"))){ ?>
					<input type="checkbox" name="is_answer" class="check_comment" data-comment-id="<?php echo $comment["id"] ?>" <?php echo $comment["is_answer"] == 1 ?'checked':''; ?> >
				<?php }?>
				 <span class="commented-by"><?php echo $comment["name"]; ?> :</span>
				 <span class="comment-by-user"><?php echo $comment["comment"]?></span>&nbsp;&nbsp;<span class="ago"> <?php echo ago($comment["created_on"])." ago";?></span>
			</div>
		<?php endforeach ?>
		</div>
		<br>
		<br>
		<div>
		<?php $content = limit_text(trim(strip_tags($posts["content"])), 20); ?>
			<a href="javascript:void(0)" target="_blank" class="fb-share-post" title="Share this car on facebook">Share on facebook</a>
			
			<a class="twitter-share-button" href="https://twitter.com/share" data-size="small" data-url="<?php echo site_url("post/".$posts['url']); ?>" data-text="<?php echo $posts['title']; ?>" data-count="none" >Share on Twitterrrrrrrrrrrr</a>
			
			
			
		</div>

	<?php } ?>
	<a href="javascript:void(0)" class="share-link" title="Get Link">Get Link</a>
	
	<div class="get-share-link-panel" style="display:none;">
		<b>Copy this link to share this post : </b>
		<input type="text" size="<?php echo strlen(site_url('post/'.$posts['url'])); ?>" id="post-link" value="<?php echo site_url('post/'.$posts['url']); ?>">
	</div>
	
</div>
<!-- TWITTER SHARE -->
<script>
	twttr.events.bind('tweet' , function(event) {
	  // do somethings here
	var post_id = $(".post-id").val();
		    		$.ajax({
		    			data:"type=twitter&post_id="+post_id,
		    			url:BASE_URL+"post/share",
		    			dataType:"JSON",
		    			type: "POST",
		    			success: function(response){
		    				if(response.success)
		    				{
		    					alert(response.msg);
		    				}
		    			}
		    		})
	});
</script>
<!-- FACEBOOK SHARE -->
<script>
	$(".fb-share-post").on("click",function(e) {
		e.preventDefault();
		
	    FB.ui({
	        method: 'feed',
	        name: '<?php echo $posts['title']; ?>',
	        link: BASE_URL+'post/<?php echo $posts['url']; ?>',
	        picture: '<?php echo $image_path; ?>',
	        caption: 'Post on our site - quora',
	        description: '<?php echo strip_tags(trim(preg_replace("/\s\s+/", ' ', $content))); ?>'
	    }, function(response)
		    {
		    	if(response && response.post_id)
		    	{
		    		var post_id = $(".post-id").val();
		    		$.ajax({
		    			data:"type=facebook&post_id="+post_id,
		    			url:BASE_URL+"post/share",
		    			dataType:"JSON",
		    			type: "POST",
		    			success: function(response){
		    				if(response.success)
		    				{
		    					alert(response.msg);
		    				}
		    			}
		    		})
		    	}
		    }

	    );
	});

$(document).ready(function(){

	$(document).on('click',".check_comment", function() {
	  var $box = $(this);
	  if ($box.is(":checked")) {
	    var group = ".check_comment[name='" + $box.attr("name") + "']";
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	  } else {
	    $box.prop("checked", false);
	  }

	  var post_id = $(".post-id").val();
	  var comment_id = $(".check_comment:checked").attr('data-comment-id');
    		$.ajax({
    			data:"post_id="+post_id+"&comment_id="+comment_id, 
    			url:BASE_URL+"post/update_comment_answer",
    			dataType:"JSON",
    			type: "POST",
    			success: function(response){
    				if(response.success)
    				{
    				}
    			}
    		});

	});

});	

	
</script>
