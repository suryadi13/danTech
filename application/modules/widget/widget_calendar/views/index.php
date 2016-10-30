		<!--event-calendar-->
          <div class="row" style="margin-top:<?=$margin_top;?>;">
		  <div class="col-lg-12">
              <div class="widget-calendar">
				 <div id="eventCalendarShowDescription" class="eventCalendar-wrap" data-current-month="<?=$bulan;?>" data-current-year="<?=$tahun;?>"></div>
			  </div>
		  </div>
		  </div>
          <!--event-calendar-->
<!-- Grid CSS File (only needed for demo page) -->
<!--<link rel="stylesheet" href="jquery/event-calendar/css/paragridma.css">
<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
<link rel="stylesheet" href="<?=site_url();?>assets/js/event-calendar/css/eventCalendar.css">
<!-- Theme CSS file: it makes eventCalendar nicer -->
<link rel="stylesheet" href="<?=site_url();?>assets/js/event-calendar/css/eventCalendar_theme_responsive.css">
<script src="<?=site_url();?>assets/js/event-calendar/js/jquery.eventCalendar.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$("#eventCalendarShowDescription").eventCalendar({
			eventsjson: '<?=site_url();?>widget_calendar/p_json',
			jsonDateFormat: 'human',
			showDescription: true,
			openEventInNewWindow: false,
			cacheJson: false
		});
	});
</script>   
