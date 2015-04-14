$(function() {
	
	//for filter
	
	autocompleteBuilder = function(params){
		$(params.selector).autocomplete({
			minLength : 2,
			html: true,
			source : $.sanga.baseUrl + params.url,
			focus: function() {
				return false;
			},		
			select : function(event, ui) {	//when we select something from the dropdown
				this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
				$(params.target).val(ui.item.value);
				return false;
			},
			change : function(event, ui) {
				if (ui.item) {
					this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
					$(params.target).val(ui.item.value);
				}
				return false;
			}
		});
	}
	
	$('#daterange').dateRangePicker({
		//https://github.com/longbill/jquery-date-range-picker
		language : 'hu',
		separator : ' - ',		//split in php by this
		startOfWeek : 'monday'
		});
	
	autocompleteBuilder({
		selector : '#xfcontact-id',
		url : '/Contacts/search',
		target : '#fcontact-id'
	});
	
	autocompleteBuilder({
		selector : '#xfuser-id',
		url : '/Users/search',
		target : '#fuser-id'
	});
	
	autocompleteBuilder({
		selector : '#xfgroup-id',
		url : '/Groups/search',
		target : '#fgroup-id'
	});

	autocompleteBuilder({
		selector : '#xfevent-id',
		url : '/Events/search',
		target : '#fevent-id'
	});
});