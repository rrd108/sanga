$(function() {
	$( "#dialog" ).dialog({
		autoOpen: false,
		closeText: '⊗',
		position: {
			of: $('#settings'),
			my: 'top',
			at: 'right-350'
		},
		width: '600',
		show: {
			effect: "slideDown"
		},
		hide: {
			effect: "slideUp"
		}
	});

	$( "#settings" ).click(function() {
		$( "#dialog" ).dialog( "open" );
	});
	
	$('#settingsForm').submit(function(event){
		event.preventDefault();
		$.ajax({
			url : $.sanga.baseUrl + '/Settings/edit',
			data : $('#settingsForm').serialize(),
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				noty({
					text: textStatus,
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
				location.reload();
			}
		});
	});
});