<div>

<?php if(!empty($categories)) { foreach ($categories as $key => $category){ ?>
	<div>
		<a rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ?  base_url('category?category_id='.$category["id"].'') : "#ex2";?>"><?php echo $category["title"]?></a>
	</div>
<?php } }?>
	
</div>