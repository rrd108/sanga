$(function() {
	/*$( document ).tooltip(
					{position : {
						  my: "right center",
						  at: "right-20 bottom",
						  collision: "flipfit"
						  }
					  });*/

	$('ul.sf-menu').superfish({
		pathClass:	'current'
	});
	
	$.sanga = {};
	$.sanga.baseUrl = $($('script')[0]).attr('src').replace(/\/js\/jquery\.js/, '');
	$.sanga.animation = {
					open : 'animated bounceInDown', // Animate.css class names
					close : 'animated bounceOutUp', // Animate.css class names
					timeout : 2,
					easing : 'swing', // unavailable - no need
					speed: 500 // unavailable - no need
					};
	
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
				var controller;
				if (ui.item.value.search(/g/) === 0) {
					controller = 'Groups'
				} else {
					controller = 'Contacts';
				}
				var url = $('#qForm').attr('action').replace(/Search\/quicksearch/, controller + '/view/');
				url = url + ui.item.value.substring(1);
				$(location).attr('href', url);
				return false;
			}
		});
});