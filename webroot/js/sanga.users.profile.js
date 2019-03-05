$(function() {

	$('.editbox').hide();

	$('#editForm').submit(function(event){
		event.preventDefault();
	});

	$('p.ed').hover(function () {
		if ($('#ajaxsave').is(':hidden')) {
			$(this).parent().parent().append($('#editlink').show());
		}
	});

	$('#editlink').click(function(event){
		//if there is any other open input we should close it
		$('.editbox').hide();
		$('span.dta').show();
		//and open exactly this one
		$(this).parent().find('.editbox').show();
		$(this).parent().find('span.dta').hide();
		$('#ajaxsave').hide();
		event.preventDefault();
	});

	$('.editbox').keyup(function(event){
		//hide editlink and show ajaxsave
		$('#editlink').hide();
		$(this).parent().parent().parent().append($('#ajaxsave').show());
		if (event.key == 'Enter') {
			$('#ajaxsave').click();
		}
		if (event.key == 'Escape') {
			$(this).hide();
			$(this).parent().find('.dta').show();
			$('#ajaxsave').hide();
		}

	});

	$('#ajaxsave').click(function(event){
		var theSpan, newData;
		var editedData = {};
		var editbox = $(this).parent().find('.editbox');
		theSpan = editbox.parent().find('.dta');
		if (editbox.is(':checkbox')) {
			newData = + editbox.is(':checked');		// + converts bool to int
		} else {
			newData = editbox.val();
		}
		editedData[editbox.attr('id')] = newData;
		var theP = editbox.parent();
		var oldData = theSpan.text();
		if (editedData.password) {
			theSpan.text('******');
		} else {
			theSpan.text(newData);
		}
		$('#editlink').hide();
		theP.append($('#ajaxloader').show());

		$('#ajaxsave').hide();
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
		editbox.hide();
		theSpan.show();
	});

});