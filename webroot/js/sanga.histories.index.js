$(function() {
	
	$('#xcontact-id').autocomplete({
		minLength : 2,
		html: true,
		source : $.sanga.baseUrl + '/Contacts/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
			$('#contact-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
			$('#contact-id').val(ui.item.value);
			return false;
		}
	});

});