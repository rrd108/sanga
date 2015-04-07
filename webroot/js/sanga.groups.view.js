$(function() {	
	
	$('#name').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Contacts/search',
		html : true,
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = '';
			
			$.ajax({
				url : $.sanga.baseUrl + '/Contacts/editgroup/' + ui.item.value,
				data : {
						'groups[_ids][]' : [$('#addMember').attr('action').split('/').pop()]
						},
				type : 'post',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					noty({
						text: textStatus + ((jqXHR && jqXHR.responseJSON &&jqXHR.responseJSON.message) ? ' : ' + jqXHR.responseJSON-message : ''),
						type: 'error',
						timeout: 3500,
					});
				},
				success : function(data, textStatus, jqXHR){
					noty({
						text: jqXHR.responseJSON.message,
						type: 'success',
						timeout: 3500,
					});
					$('#members').append('<a href="' + $.sanga.baseUrl + '/Contacts/view/' + ui.item.value + '">' + ui.item.label + '</a>');
				}
			});
			return false;
		},
		change : function(event, ui) {
			this.value = '';
			
			$.ajax({
				url : $.sanga.baseUrl + '/Contacts/editgroup/' + ui.item.value,
				data : {
						'groups[_ids][]' : [$('#addMember').attr('action').split('/').pop()]
						},
				type : 'post',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					noty({
						text: textStatus + ((jqXHR && jqXHR.responseJSON &&jqXHR.responseJSON.message) ? ' : ' + jqXHR.responseJSON-message : ''),
						type: 'error',
						timeout: 3500,
					});
				},
				success : function(data, textStatus, jqXHR){
					noty({
						text: jqXHR.responseJSON.message,
						type: 'success',
						timeout: 3500,
					});
					$('#members').append('<a href="' + $.sanga.baseUrl + '/Contacts/view/' + ui.item.value + '">' + ui.item.label + '</a>');
				}
			});
			return false;
		}
	});
	
	$('#members a').hover(
		function(event){
			$('#ajaxremove').show().insertAfter($(this));
		}, function(event){
			$('#ajaxremove').hide();
		}
	);

});