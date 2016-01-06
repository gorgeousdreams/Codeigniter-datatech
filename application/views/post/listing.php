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
	</div>
	<br>
	<br>
<?php endforeach; } else{?>
	<label><?php echo $posts["msg"]; ?></label>
<?php } ?>
</div>