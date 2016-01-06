<section id="blog-contents" class="first-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<h3>Filter By Date</h3>
			</div>
			<div class="col-sm-9">
				<h3>Reading List</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="category-list">
					<ul class="menu">
						<li><a href="#">Last Week</a></li>
						<li><a href="#">View All</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="content-overview">
					<?php for($i = 0; $i < 4; $i++){?>
					<div class="single-content">
						
						<div class="row">
							<div class="col-sm-3 post-info">
								<div class="author-avatar"></div>
								<div class="content-stats">
									<div class="upvote"><button>Upvote | 5</button></div>
									<br>
									<div class="downvote"><button>Downvote | 10</button></div>
									<br>
									<div class="comments"><button>Comment | 15</button></div>
									<br>
									<div class="btn-group other-button-options">
								        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><button>Share | 4.3K</button></a>
								        <ul class="dropdown-menu">
								            <li><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></li>
								            <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
								            <li><a href="#">Embed</a></li>
								        </ul>
								    </div>
								</div>
							</div>
							<div class="col-sm-9 post-content">
								<h3 class="content-title">What are some nice, beautiful stories</h3>
								<div class="author">Paulo Knabben, Entrepreneur/Pharmacist, Co-founder/CEO at Nanorganic</div>
								<span>5 upvotes by ...</span>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
								Duis 
								</p>
								<div class="content-buttons">
									<button class="see-more">See More</button>
									<div class="btn-group other-button-options">
								        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-h"></i></button>
								        <ul class="dropdown-menu">
								            <li><a href="#"><input type="checkbox"/>Add to Reading List</a></li>
								            <li><a href="#" class="icon-indent">Thank</a></li>
								            <li><a href="#" class="icon-indent">Report Answer</a></li>
								            <li><a href="#" class="icon-indent">Remove From Feed</a></li>
								        </ul>
								    </div>
								</div>
							</div>
						</div>
						<div class="content-category border-top">
							<span><a href="">Academic</a>, 
							<a href="">Analytic</a>, 
							<a href="">Business</a>, 
							<a href="">IOTs</a>, 
							<a href="">Python</a>,
							<a href="">R</a>,
							<a href="">Data Mining</a>,
							<a href="">Machine Learning</a>
							</span> |
							<span>Jun 27, 2015</span>
						</div>
					</div>	
					<?php }?>
					
				</div>
			</div>
		</div>
	</div>
</section>
