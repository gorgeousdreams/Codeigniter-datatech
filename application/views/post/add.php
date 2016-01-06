<div>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<div>
			<div>
				<label>Title</label>
			</div>
			<div>
				<input type="text" name="title" value="<?php echo $this->input->post("title") ? $this->input->post("title") : "" ; ?>">
				<?php echo form_error("title")?>
			</div>
		</div>
		<div>
			<div>
				<label>Type</label>
			</div>
			<div>
				<select name="type">
					<option value="">Select Type Of post</option>
					<option value="1" <?php echo $this->input->post("type") == "1" ? "Selected='selected'" : ""?>>
						Link
					</option>
					<option value="2" <?php echo $this->input->post("type") == "2" ? "Selected='selected'" : ""?>>
						Audio
					</option>
					<option value="3" <?php echo $this->input->post("type") == "3" ? "Selected='selected'" : ""?>>
						Question
					</option>
					<option value="4" <?php echo $this->input->post("type") == "4" ? "Selected='selected'" : ""?>>
						Blog
					</option>
				</select>
			</div>
		</div>
		<div>
			<div>
				<label>Image</label>			
			</div>	
			<div>
				<input type="file" name="image">			
			</div>	
		</div>
		<div>
			<div>
				<label>Content</label>
			</div>
			<div style="width:600px;" >
				<textarea rows="10" cols="20" name="content" class="ckeditor"><?php echo $this->input->post("content") ? $this->input->post("content") : "" ?></textarea>
				<?php echo form_error("content")?>

			</div>
		</div>
		<div>
			<div>
				<label>Tag</label>			
			</div>	
			<div>  
				<select style="width:200px" class="post-tags form-control" multiple="multiple" name="tag[]">
					<?php 
					if(!empty($tags["data"])){
						foreach($tags["data"] as $tag)
							{ ?>
						<option value="<?php echo $tag['tag']?>"><?php echo $tag['tag']; ?></option>}
						<?php } } ?>
					</select>	
				</div>	
			</div>
			<div>
				<div>
					<label>Category</label>
				</div>
				<div>
					<select name="category" class="category">
						<option value="">Select a Category</option>
						<?php
						if(!empty($categories)){ 
							foreach ($categories as $key => $category){  ?>
							<option value="<?php echo $category['id']?>" <?php echo $category['id'] == $this->input->post('category') ? "Selected='selected'" : "" ?>><?php echo $category['title']; ?></option>
							<?php } } ?>
						</select>
						<?php echo form_error("category")?>
					</div>
				</div>
				<div class="topics-parent-div" style="<?php echo !isset($topics) ? "display:none": "" ?>">
					<div>
						<label>Topics</label>
					</div>
					<div id="topics">
						<div class="add-new-topic-div">
							<div class='topics'>

								<?php if(isset($topics) && !empty($topics["data"])){ ?>
								<?php foreach($topics["data"] as $key => $value): ?>
									<input type='checkbox' name='topics[]' value="<?php echo $value["topic"] ?>" <?php echo isset($_POST["topics"]) && $_POST["topics"] && in_array($value["topic"],$_POST["topics"]) ? "checked" : "" ?>><label class='topics_label'><?php echo $value["topic"] ?></label>
								<?php endforeach; ?>
								<?php } ?>

							</div>
							<input type="text" class="extra_topics" name="extra_topics" value="">
							<button type="button" class="add_topic">+</button>

						</div>
					</div>
				</div>
				<div>
					<button type="submit">Save</button>
				</div>
			</form>

		</div>
