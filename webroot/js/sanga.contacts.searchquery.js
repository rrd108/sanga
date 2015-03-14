$(function() {	
	$('#xzip').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Zips/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label;
			$('#zip-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label;
			$('#zip-id').val(ui.item.value);
			return false;
		}
	});
	
	$('#xgroup').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Groups/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label;
			$('#group-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label;
			$('#group-id').val(ui.item.value);
			return false;
		}
	});
});