$(function() {

    input2td = function(){
		var input = $('input.imp');
		if (input.length) {
			var val = input.val();
			input.parent().addClass('message error');
            //get data in input as the text of the td and remove save button form this row
			input.parent().empty().text(val).parent().children().last().empty();
		}
	};
	
	$('td.error').on('click', function(event){
		input2td();
		var val = $(this).text();
		$(this).empty().removeClass().attr('title', '');
		$(this).append('<input type="text" value="' + val + '" class="imp" id="x'+$(this).data('id')+'">');
        $(this).append('<input type="hidden" value=""  id="'+$(this).data('id')+'">');

        autocompleteBuilder({
            selector : '#x' + $(this).data('id'),
            url : '/Contacts/search',
            target : '#' + $(this).data('id')
        });

		$('.imp').select();
		$(this).parent().children().last().append('<button type="button">' + $.sanga.texts[$.sanga.lang].save + '</button> ');
	});
	
	$('td').on('click', 'button', function(event){
		var queryData = {};
		var tds = $(this).parent().parent().children();
		var lastTd = tds.length - 1;
		var td = $(event.target).parent();
//we loose the inserted hidden input in next line, so this is the place to get autocompleter's hidden input's value
		input2td();		//this should be called here as in the function we remove button, so we loose "this"
		td.append('<img id="loader" src="' + $.sanga.baseUrl + '/img/ajax-loader.gif">');
		$.each($('th'), function(index, value){
			if (lastTd != index && $(tds[index]).text())
			{
				if ($(value).text() == 'contact' || $(value).text() == 'group'
                    || $(value).text() == 'event' || $(value).text() == 'unit')
				{
					queryData[$(value).text() + '_id'] = $(tds[index]).text();
				} else {
					queryData[$(value).text()] = $(tds[index]).text();
				}
			}
		});
		
		$.ajax({
			url : $.sanga.baseUrl + '/Histories/add',
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