<section id="messages-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Messages</h1>
		</div>
		<div class="row">
			<div class="button-container">
			<button onclick="showPopupDiv(true)">Compose</button>
		</div>
			<div class="col-sm-8">
			</div>
		</div>
		<div class="row messages">
			<div class="col-sm-4">
				<div class="messages-list">
				<ul class="menu">
				<?php 
				if(!empty($messages['data']))
				{
					foreach ($messages['data'] as $key => $msg): ?>
						<li><a href="<?=base_url('messages/content/?msgId='.$msg["msg_id"])?>"><?=$msg["msg_title"] ?></a></li>		
				<?php endforeach;
				}?>
				</ul>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="message-content">
				<?php 
				$this->load->helper('date');
				if(!empty($message_content['data']))
				{
					foreach ($message_content['data'] as $key => $msg): ?>
					<p><?=$msg["msg_content"] ?></p>
					<p><?=$msg["usrd_full_name"] ?></p>
					<p><?php echo mdate('%M %d, %Y', strtotime($msg["msg_crd"])) ?></p>
				<?php endforeach;
				}?>
				</div>
			</div>
		</div>
	</div>
	
	<div id="popupBox">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<a href="javascript:showPopupDiv(false)"><i class="fa fa-close"></i></a>
				<h3>Compose New Message</h3>
				<div id="messages-form" class="dataset-form">
					<div class="key-value">
						<div>To:</div><input type="text" name="messageto" class="required"/>
					</div>
					<div class="key-value">
						<div>Subject:</div><input type="text" name="messagesubject" class="required"/>
					</div>
					<div class="key-value">
						<div>Message:</div><textarea name="message"></textarea>
					</div>
				</div>
					<button onclick="do_add_record('messages-form','messages/add_record','messages')">Compose</button>
			</div>		
		</div>
	</div>
</section>
