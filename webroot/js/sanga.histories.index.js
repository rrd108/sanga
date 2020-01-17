$(function() {
	
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
	
	autocompleteBuilder({
		selector : '#xfquantity-id',
		url : '/Histories/search',
		target : '#fquantity-id'
	});
});