<link href="<?=base_url('assets/css/calendar.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/custom_1.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/modernizr.custom.63321.js')?>" type="text/javascript"></script>

<section id="events-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Events</h1>
		</div>
		
		<div id="event-view-options">
			<ul class="menu horizontal-list">
				<li><a href="events"><button>Default</button></a></li>
				<li><a href="eventscalendar"><button class="active">Calendar View</button></a></li>
				<li><a href="eventsmap"><button>Map View</button></a></li>	
			</ul>
			<div class="button-container">
				<button>New Event</button>
			</div>
			<br>
		</div>
		<div id="events-calendar" class="toggle-tab">
			<div class="custom-calendar-wrap custom-calendar-full">
				<div class="custom-header clearfix">
					<h3 class="custom-month-year">
						<span id="custom-month" class="custom-month"></span>
						<span id="custom-year" class="custom-year"></span>
						<nav>
							<span id="custom-prev" class="custom-prev"></span>
							<span id="custom-next" class="custom-next"></span>
							<span id="custom-current" class="custom-current" title="Got to current date"></span>
						</nav>
					</h3>
				</div>
				<div id="calendar" class="fc-calendar-container"></div>
			</div>
			<script type="text/javascript" src="<?=base_url('assets/js/jquery.calendario.js')?>"></script>
			<script type="text/javascript">	
				$(function() {
	
					var codropsEvents = {
						'08-08-2015' : '<a href="#">Event Title1</a>',
						'08-24-2015' : '<a href="#">Event Title2</a>',
						'08-25-2015' : '<a href="#">Event Title2</a>',
						'08-26-2015' : '<a href="#">Event Title2</a>',
						'08-27-2015' : '<a href="#">Event Title2</a>',
						'08-28-2015' : '<a href="#">Event Title2</a>',
						'08-09-2015' : '<a href="#">Event Title3</a>',
						'08-10-2015' : '<a href="#">Event Title4</a>',
						'08-11-2015' : '<a href="#">Event Title4</a>',
						'08-12-2015' : '<a href="#">Event Title4</a>',
						'08-17-2015' : '<a href="#">Event Title5</a>',
						'08-18-2015' : '<a href="#">Event Title5</a>',
						'08-19-2015' : '<a href="#">Event Title6</a>',
						'08-21-2015' : '<a href="#">Event Title7</a>',
						'08-22-2015' : '<a href="#">Event Title7</a>',
						'08-23-2015' : '<a href="#">Event Title7</a>'
						};
					
					var cal = $( '#calendar' ).calendario( {
							onDayClick : function( $el, $contentEl, dateProperties ) {
	
								for( var key in dateProperties ) {
									console.log( key + ' = ' + dateProperties[ key ] );
								}
	
							},
							caldata : codropsEvents
						} ),
						$month = $( '#custom-month' ).html( cal.getMonthName() ),
						$year = $( '#custom-year' ).html( cal.getYear() );
	
					$( '#custom-next' ).on( 'click', function() {
						cal.gotoNextMonth( updateMonthYear );
					} );
					$( '#custom-prev' ).on( 'click', function() {
						cal.gotoPreviousMonth( updateMonthYear );
					} );
					$( '#custom-current' ).on( 'click', function() {
						cal.gotoNow( updateMonthYear );
					} );
	
					function updateMonthYear() {				
						$month.html( cal.getMonthName() );
						$year.html( cal.getYear() );
					}
	
					// you can also add more data later on. As an example:
					/*
					someElement.on( 'click', function() {
						
						cal.setData( {
							'03-01-2013' : '<a href="#">testing</a>',
							'03-10-2013' : '<a href="#">testing</a>',
							'03-12-2013' : '<a href="#">testing</a>'
						} );
						// goes to a specific month/year
						cal.goto( 3, 2013, updateMonthYear );
	
					} );
					*/
				
				});
			</script>
		</div>
		
		
	</div>
</section>
