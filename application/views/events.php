<section id="events-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Events</h1>
		</div>
		
		<div id="event-view-options">
			<ul class="menu horizontal-list">
				<li><a href="events"><button class="active">Default</button></a></li>
				<li><a href="eventscalendar"><button>Calendar View</button></a></li>
				<li><a href="eventsmap"><button>Map View</button></a></li>	
			</ul>
			<div class="button-container">
				<button onclick="showPopupDiv(true)">New Event</button>
			</div>
			<br>
		</div>
		<div id="event-row-column" class="row toggle-tab active">
		<?php 
				if(!empty($events['data']))
				{
					foreach ($events['data'] as $key => $post): ?>
					<div class="col-sm-4">
						<div class="single-content">
						<h3 class="content-title"><?=$post["post_title"] ?></h3>
						<div class="events-category">
							<div><?=$post["post_crd"] ?></div>
							<div><?=$post["post_location"] ?></div>
						</div>
						<p><?=$post["post_content"] ?></p>
						<div class="content-category">
							<span><a href="">Tutorials/Lectures</a>, 
							<a href="">Machine Learning</a></span>
						</div>
						<div class="content-buttons">
							<button>Comment</button>
							<button>Share</button>
						</div>
						</div>
					</div>
				<?php endforeach;
		}?>
		</div>
		
		<div id="popupBox">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<a href="javascript:showPopupDiv(false)"><i class="fa fa-close"></i></a>
				<h3>New Event</h3>
				<div id="newevent-form" class="dataset-form">
					<div class="key-value">
						<div class="field-name inline">Name</div><input type="text" name="eventname" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Date</div><input type="text" name="eventdate" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Location</div><input type="text" name="eventlocation">
					</div>
					<div class="key-value">
						<div class="field-name inline">Description</div><textarea name="eventdesc"></textarea>
					</div>
					<button onclick="do_add_record('newevent-form','events/add_record','events')">Add</button>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</section>
