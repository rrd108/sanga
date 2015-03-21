$(function() {
	
	$('input.editbox').hide();
	
	$('#editForm').submit(function(event){
		event.preventDefault();
	});

	$('p.ed').hover(
		function(){		//handlerIn
			$(this).append($('#editlink').show());
		}/*,
		function(){		//handlerOut
			$('#editlink').hide();
		}*/
	);
	
	$('#editlink').click(function(event){
		//if there is any other open input we should close it
		$('.editbox').hide();
		$('span.dta').show();
		//and open exactly this one
		$(this).parent().find('.editbox').show();
		$(this).parent().find('span.dta').hide();
		event.preventDefault();
	});

	$('.editbox').change(function(event){
		var theSpan, newData;
		var editedData = {};
		theSpan = $(this).parent().find('.dta');
		if ($(this).is(':checkbox')) {
			newData = + $(this).is(':checked');		// + converts bool to int
		} else {
			newData = $(this).val();
		}
		editedData[$(this).attr('id')] = newData;
		var theP = $(this).parent();
		var oldData = theSpan.text();
		theSpan.text(newData);
		$('#editlink').hide();
		theP.append($('#ajaxloader').show());

		$.ajax({
			url : $('#editForm').attr('action'),
			data : editedData,
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				$('#ajaxloader').hide();
				theP.append($('#errorImg').show());
				theSpan.text(oldData);
				$('.editbox').val(oldData);
				noty({
					text: textStatus + ' ' + jqXHR.responseJSON.message,
					type: 'error',
					timeout: 3500,
					});
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				//theP.append($('#okImg').show().hide(12500));
				if (jqXHR.responseJSON.error) {
					var type = 'error',
						message = jqXHR.responseJSON.error;
					theSpan.text(oldData);
					$('.editbox').val(oldData);
				} else {
					var type = 'alert',
						message = jqXHR.responseJSON.save;
				}
				noty({
					text: message,
					type: type,
					timeout: 3500,
					});
			}
		});
		$(this).hide();
		theSpan.show();
	});
	
});