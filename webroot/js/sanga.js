jQuery(document).ready(function() {
		jQuery('ul.sf-menu').superfish({
			pathClass:	'current'
		});
	}
);

$(function() {
	$( document ).tooltip({position : { my: "right center", at: "right bottom", collision: "flipfit" }});
	$( "#birth" ).datepicker();
});