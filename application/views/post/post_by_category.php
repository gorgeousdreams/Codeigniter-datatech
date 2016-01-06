<?php if($this->session->flashdata("success")) ?>
<label><?php echo $this->session->flashdata("success"); ?></label>
<?php if($this->session->flashdata("error")) ?>
<label><?php echo $this->session->flashdata("error"); ?></label>

<div>
	
	<?php if(!empty($posts["data"])){
			foreach ($posts["data"] as $key => $post) {
		?>
		<div>
			<a href="<?php echo base_url('post/'.$category_url.'/'.$post["url"].'')?>"><?php echo ucfirst($post["title"])?></a>
		</div>
		<?php if($post['img'] != "") {?>
		<div>
			<img width="50" src="<?php echo base_url()."uploads/post/".$post['id']."/".$post['img']; ?>" alt="">	
		</div>
		<?php } ?>
	<?php } } else{ ?>
		<label><?php echo $posts["msg"]; ?></label>
<?php }?>
</div>