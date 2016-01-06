<script type="text/javascript" src="<?php echo base_url()?>resources/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/ckeditor/config.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/ckeditor/adapters/jquery.js"></script>
<div>
<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<div>
		<div>
			<label>Title</label>
		</div>
		<div><?php ?>
			<input type="text" name="title" value="<?php echo $this->input->post("title") ? $this->input->post("title") : $post['title'];  ?>">
			<?php echo form_error("title")?>
		</div>
	</div>
	<div>
		<div>
			<label>Type</label>
		</div>
		<div>
			<select name="type">
				<option value="">Select Type Of post</option>}
				<option value="1" <?php echo $this->input->post("type") == "1" ? "Selected='selected'" : " "?> <?php echo $post['type'] =="1"? "Selected='selected'":""?>>
					Link
				</option>
				<option value="2" <?php echo $this->input->post("type") == "2" ? "Selected='selected'" : ""?> <?php echo $post['type'] =="2"? "Selected='selected'":""?> >
					Audio
				</option>
				<option value="3" <?php echo $this->input->post("type") == "3" ? "Selected='selected'" : ""?> <?php echo $post['type'] =="3"? "Selected='selected'":""?> >
					Question
				</option>
				<option value="4" <?php echo $this->input->post("type") == "4" ? "Selected='selected'" : ""?> <?php echo $post['type'] =="4"? "Selected='selected'":""?> >
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
			<?php if ($post['img']=="") {?>
				<input type="file" name="image">
			<?php } else{?>
				<img src="<?php echo base_url()?>uploads/post/<?php echo $post['id']?>/<?php echo $post['img']?>" width="200" height="200">
				<a href="<?php echo base_url()?>post/delete_image/<?php echo $post['id']?>" class="delete_image">Delete</a>
			<?php }?>			
		</div>	
	</div>
	<div>
		<div>
			<label>Content</label>
		</div>
		<div style="width:500px;" >
			<textarea rows="10" cols="50" name="content" class="ckeditor"><?php echo $this->input->post("content") ? $this->input->post("content") : $post['raw_content']; ?></textarea>
			<?php echo form_error("content")?>
			
		</div>
	</div>
	 <div>
		<div>
			<label>Tag</label>			
		</div>	
		<div> <?php $posted_tags = array_map('current', $post_tags);?>
			 <select style="width:200px" class="post-tags form-control" multiple="multiple" name="tag[]">
				<?php 
				if(!empty($tags["data"]))
				{
					foreach($tags["data"] as $tag)
					{ ?>
						<option value="<?php echo $tag['tag']?>" <?php echo isset($posted_tags) && !empty($posted_tags) && in_array($tag['id'],$posted_tags) ? "Selected='selected'" : "" ?> ><?php echo $tag['tag']; ?>
						</option>
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
					<option value="<?php echo $category['id']?>" <?php echo $category['id'] == $this->input->post('category') ? "Selected='selected'" : "" ?><?php echo $post['category_id'] == $category['id'] ? "Selected='selected'" : "" ?>><?php echo $category['title']; ?></option>
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
									<input type='checkbox' name='topics[]' value="<?php echo $value["topic"] ?>" <?php echo isset($_POST["topics"]) && $_POST["topics"] && in_array($value["topic"],$_POST["topics"]) ? "checked" : "" ?><?php if(!empty($post['post_topics'])){foreach($post['post_topics'] as $topic){if($topic['topicname']==$value["topic"]){echo "checked";}}}?>><label class='topics_label'><?php echo $value["topic"] ?></label>
								<?php endforeach; ?>
							<?php } ?>
							
						</div>
					<input type="text" class="extra_topics" name="extra_topics" value="">
					<button type="button" class="add_topic">+</button>

				</div>
		</div>
	</div>
	
	<div>
		<button type="submit">Update</button>
	</div>
</form>

</div>
<script>
	$(document).ready(function(){
		
		$(".delete_image").on('click',function(){
	        if(confirm('are you sure you want to delete this image?'))
	        {
	          return true;
	        }
	        else
	        {
	          return false;
	        }
	     });
	});

</script>
