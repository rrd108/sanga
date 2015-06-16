$(function() {
	input2td = function(){
		var input = $('input.imp');
		if (input.length) {
			var val = input.val();
			input.parent().addClass('message error');
			input.parent().empty().text(val).parent().children().last().empty();	//get data in input as the text of the td and remove save button form this row
		}
	}
	
	$('td.error').on('click', function(event){
		input2td();
		var val = $(this).text();
		$(this).empty().removeClass().attr('title', '');
		$(this).append('<input type="text" value="' + val + '" class="imp">');
		$('.imp').select();
		
		$(this).parent().children().last().append('<button type="button">' + $.sanga.texts[$.sanga.lang].save + '</button> ');
	});
	
	$('td').on('click', 'button', function(event){
		var queryData = {};
		var tds = $(this).parent().parent().children();
		var lastTd = tds.length - 1;
		var td = $(event.target).parent();
		input2td();		//this should be called here as in the function we remove button, so we loose "this"
		td.append('<img id="loader" src="' + $.sanga.baseUrl + '/img/ajax-loader.gif">');
		$.each($('th'), function(index, value){
			if (lastTd != index && $(tds[index]).text())
			{
				if ($(value).text() == 'groups' || $(value).text() == 'skills')
				{
					queryData[$(value).text()] = {'_ids' : $(tds[index]).text()};
				} else {
					queryData[$(value).text()] = $(tds[index]).text();
				}
			}
		});
		
		$.ajax({
			url : $.sanga.baseUrl + '/Contacts/add',
			data : queryData,
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				noty({
					text: textStatus + ': ' + jqXHR.responseJSON.message,
					type: 'error',
					timeout: 3500,
					});
			},
			success : function(data, textStatus, jqXHR){
				noty({
					text: jqXHR.responseJSON.message + ' ' + jqXHR.responseJSON.errors,
					type: jqXHR.responseJSON.success ? 'success' : 'error',
					timeout: 3500,
					});
				if (jqXHR.responseJSON.success) {
					$('#loader').parent().append('<img src="' + $.sanga.baseUrl + '/img/ok.png">');
					$('#loader').parent().parent().children().removeClass().off('click');
				}
				$('#loader').remove();
			}
		});
	});
});