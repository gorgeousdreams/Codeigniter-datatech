<div class="conversation">
	<?php if(!empty($messages["data"])){ ?>
		<?php foreach($messages["data"] as $key => $message){ ?>
		<?php $div_style = $this->session->userdata("user_id") == $message["sender_id"] ? "text-align:right;" : "" ?>
		<?php $label_style = $this->session->userdata("user_id") == $message["sender_id"] ? "background-color:#3C3A3A;color:white" : "" ?>
			<div style="<?php echo $div_style ?>">
				<?php if($this->session->userdata("user_id") != $message['sender_id'] ) { ?>
				<label><?php echo ucwords($message['name']); ?> : </label>
				<lable class="single-msg" style="<?php echo $label_style ?>"><?php echo $message['body'] ?></lable>
				<?php } else { ?>
				<lable class="single-msg" style="<?php echo $label_style ?>"><?php echo $message['body'] ?></lable>
				<label> - <?php echo ucwords($message['name']) ; ?></label>
				<?php }?>
			</div>
		<?php } ?>
<br>
<br>
		<div>
			<form action="<?php echo base_url("user/send_message"); ?>" method="post" accept-charset="utf-8">
				<input type="hidden" name="user_id" value="<?php echo $this->input->get("conversation_id") ? $this->input->get("conversation_id") : 0 ?>">
				<div>
					<textarea name="message" placeholder="Your message" cols="50" rows="3"></textarea>
					<?php echo $this->session->flashdata("error") ? $this->session->flashdata("error") : "" ; ?>
				</div>
				<div>
					<button type="submit">Send</button>
				</div>
			</form>
		</div>
	<?php } ?>
</div>