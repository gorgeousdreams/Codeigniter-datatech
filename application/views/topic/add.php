<div>
	<form action="" method="post" accept-charset="utf-8">
		<div>

			<label>Topic</label>

		</div>
		<div>

			<input type="text" name="topic" value="<?php echo $this->input->post("topic") ;?>">
			<?php echo form_error("topic");?>
		</div>
		<div>

			<label>Select A Category</label>

		</div>

		<div>

			<?php if(!empty($categories)){ foreach ($categories as $key => $category): ?>
				<input type="checkbox" name="categories[]" value="<?php echo $category["id"]?>" <?php echo $_POST["categories"] && in_array($category["id"] , $_POST["categories"]) ? "checked" : ""?> > <?php echo $category["title"]?>
			<?php endforeach; } ?>
			<?php echo form_error("categories");?>
		</div>

		<div>

			<button type="submit">Save</button>

		</div>
	</form>
</div>