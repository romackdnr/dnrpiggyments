// JavaScript Document

$(document).ready(function() {
	var visits = "<?php echo $flot_data_visits; ?>";
	var views = "<?php echo $flot_data_views; ?>";
	$('#placeholder').css({
		height: '300px',
		width: '1050px'
	});
	$.plot($('#placeholder'),[
			{ label: 'Visits', data: visits },
			{ label: 'Pageviews', data: views }
		],{
	        lines: { show: true },
	        points: { show: true },
	        grid: { backgroundColor: '#fffaff' }
	});
});