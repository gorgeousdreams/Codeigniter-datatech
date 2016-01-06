<div>
	<?php if(!empty($conversations["data"])) { ?>
	<?php foreach ($conversations["data"] as $key => $conversation): ?>
		<div>
		<?php $id = $conversation["id"]; ?>
			<a href="<?php echo base_url("user/conversations?conversation_id=".$id); ?>"><?php echo $conversation["name"] ?></a>
		</div>
	<?php endforeach; } ?>
</div>