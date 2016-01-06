<section id="usercontent-contents" class="first-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<h3>By Content Type</h3>
			</div>
			<div class="col-sm-9">
				<h3>Your Content</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="category-list">
					<ul class="menu">
						<li><a href="#"><b>All Types</b></a></li>
						<li><a href="#">Question Asked</a></li>
						<li><a href="#">Questions Followed</a></li>
						<li><a href="#">Answers</a></li>
						<li><a href="#">Posts</a></li>
					</ul>
					<br>
					<h3>By Topic</h3>
					<ul class="menu">
						<li><a href="#"><b>All Topic</b></a></li>
						<li><a href="#">Question Asked</a></li>
						<li><a href="#">Questions Followed</a></li>
						<li><a href="#">Answers</a></li>
						<li><a href="#">Posts</a></li>
					</ul>
					<br>
					<h3>By Year</h3>
					<ul class="menu">
						<li><a href="#"><b>All Time</b></a></li>
						<li><a href="#">2015</a></li>
						<li><a href="#">2014</a></li>
					</ul>
					<br>
					<h3>Sort Order</h3>
					<ul class="menu">
						<li><a href="#"><b>Newest First</b></a></li>
						<li><a href="#">Oldest First</a></li>
					</ul>
					
				</div>
			</div>
			<?php
				if(!empty($usercontent['data']))
				{
					foreach ($usercontent['data'] as $key => $post):
						?>
						<div class="col-sm-9">
							<div class="content-overview">
								<div class="single-content">
									<a href="#"><?=$post["post_title"] ?></a>
									<div class="content-category">
										<span><?=$post["post_crd"] ?></span>
									</div>
								</div>
							</div>
						</div>
					<?php	endforeach;
				}?>
		</div>
	</div>
</section>
