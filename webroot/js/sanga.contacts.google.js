$(function() {
	$('.gContact').click(function(event){
		$(this).addClass('gSelected');
		
		$(this).append($('#ajaxloader').show());
		
		//collect data
		var gData = {
			'google_id'	: $(this).find('.gId').text(),
			'name'		: $(this).find('.gName').text(),
			'email'		: $(this).find('.gEmail').text(),
			'phone'		: $(this).find('.gPhone').text(),
			'address'	: $(this).find('.gAddress').text(),
			'comment'	: $(this).find('.gComment').map(
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
				$(this).append($('#errorImg').show());
				$(this).removeClass('gSelected');
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				$(this).append($('#okImg').show().hide(6000));
			}
		});

		
		//save user photo
		
	});
});