$(function() {
	$( document ).tooltip({position : { my: "right center", at: "right bottom", collision: "flipfit" }});
	$( "#birth" ).datepicker();
	$('ul.sf-menu').superfish({
		pathClass:	'current'
	});
	
	$('#quickterm').autocomplete({
			minLength : 2,
			html: true,
			source : $('#qForm').attr('action'),
			focus: function() {
				// prevent value inserted on focus
				return false;
			},
			select : function(event, ui) {	//when we select something from the dropdown
				this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code
				var userUrl = $('#qForm').attr('action').replace(/quicksearch/, 'view/' + ui.item.value);
				$(location).attr('href', userUrl);
				return false;
			}
		});
});