<div class="">
	<form action="" method="post" accept-charset="utf-8">
		<div class="">
			<div>
				<label>Title</label>
			</div>
			<div>
				<input type="text" name="title" value="<?php echo $this->input->post("title") ? $this->input->post("title") : "" ; ?>">	
			<?php echo form_error("title");?>
			</div>
			<div>
				<button type="submit">Save</button>			
			</div>
		</div>
	</form>
</div>