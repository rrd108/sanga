$(function() {
	$( document ).tooltip({position : { my: "right center", at: "right bottom", collision: "flipfit" }});
	$( "#birth" ).datepicker();
	$('ul.sf-menu').superfish({
			pathClass:	'current'
		});
});