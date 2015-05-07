$(function() {
	$('.gContact').click(function(event){
		var gContact = $(this);
		gContact.addClass('gSelected');
		
		gContact.prepend($('#ajaxloader').show());
		
		//collect data
		var gData = {
			'google_id'	: gContact.find('.gId').text(),
			'contactname': gContact.find('.gName').text(),
			'email'		: gContact.find('.gEmail').text(),
			'phone'		: gContact.find('.gPhone').text(),
			'address'	: gContact.find('.gAddress').text(),
			'comment'	: gContact.find('.gComment').map(
								//get all text date and separate them by comme
								function(){
									return $(this).text(); 
								}).get().join(', ')
		};
		
		//save user data
		$.ajax({
			url : $('.link').attr('href'),
			data : gData,
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				$('#ajaxloader').hide();
				gContact.prepend($('#errorImg').show());
				gContact.removeClass('gSelected');
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				gContact.prepend($('#okImg').show().hide(6000));
			}
		});
	});
});