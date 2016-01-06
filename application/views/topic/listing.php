<div>

<?php foreach ($topics["data"] as $key => $topic): ?>
	<div>
		<label><a  rel="<?php echo $this->session->userdata("user_id") ? "" : "modal:open"; ?>" href="<?php echo $this->session->userdata("user_id") ? base_url('posts?category_id='.$category_id.'&&topic_id='.$topic['id']) : "#ex2"; ?>"><?php echo $topic["topic"]?></a></label>
	</div>
<?php endforeach ?>
	
</div>