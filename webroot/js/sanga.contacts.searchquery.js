$(function() {

	createSelect = function(name, addOptGroups){
		var prefix = '';
		var select = '<select ' +
					'name="condition_' + name + '[]"' +
					'>';

		if (addOptGroups) {
			prefix = $.sanga.texts[$.sanga.lang].and + ' ';
			select += '<optgroup label="---' + $.sanga.texts[$.sanga.lang].and + '---">';
		}

		select += '<option value="&%">' + prefix + $.sanga.texts[$.sanga.lang].contains + '</option>' +
					'<option value="&=">' + prefix + '=</option>' +
					'<option value="&!">' + prefix + $.sanga.texts[$.sanga.lang].not + '</option>' +
					'<option value="&<">' + prefix + '<</option>' +
					'<option value="&>">' + prefix + '></option>';

		if (addOptGroups) {
			prefix = $.sanga.texts[$.sanga.lang].or + ' ';
			select += 	'</optgroup>' +
						'<optgroup label="---' + $.sanga.texts[$.sanga.lang].or + '---">' +
							'<option value="|%">' + prefix + $.sanga.texts[$.sanga.lang].contains + '</option>' +
							'<option value="|=">' + prefix + '=</option>' +
							'<option value="|!">' + prefix + $.sanga.texts[$.sanga.lang].not + '</option>' +
							'<option value="|<">' + prefix + '<</option>' +
							'<option value="|>">' + prefix + '></option>' +
						'</optgroup>';
		}

		select += '</select>';
		return select;
	};

	createInput = function(name){
		var input = '<input type="text" ' +
						'name="field_' + name + '[]" ' +
					'>';
		return input;
	};

	addedDivs = 0;

	$('#query-select-box span').click(function(event){
		if ($(this).hasClass('tag-default')) {
			$(this).removeClass('tag-default');
			$(this).addClass('tag-viewable');

			var imgPlus, imgAndOr, connectAndOr, label, select, input;
			imgAndOr = connectAndOr = '';
			if (addedDivs) {
				imgAndOr = '<img ' +
						'src="' +  $.sanga.baseUrl + '/img/and.png" ' +
						'title="*' + $.sanga.texts[$.sanga.lang].and + '* ' + $.sanga.texts[$.sanga.lang].click2change + '"' +
						'class="fl">';
				connectAndOr = '<input type="hidden" ' +
									'name="connect_' + $(this).data('name') + '" ' +
									'value="&"' +
								'>';
			}
			imgPlus = '<img ' +
						'src="' +  $.sanga.baseUrl + '/img/plus.png" ' +
						'data-name="' + $(this).data('name') + '"' +
						'class="fl">';
			label = '<label for="' + $(this).data('name') + '"' +
						'id="l' + $(this).data('name').replace(/\./g, '_') + '" ' +		//there are .-s in the id what we should replace for jQuery
						'>' +
						$(this).text() +
					'</label>';
			select = createSelect($(this).data('name'), false);
			input = createInput($(this).data('name'));
			$('#where').append('<div data-name="' + $(this).data('name') + '">' +
									imgAndOr +
									connectAndOr +
									imgPlus +
									label +
									select +
									input +
								'</div>');
			addedDivs++;
		} else {
			$(this).removeClass('tag-viewable');
			$(this).addClass('tag-default');
			$('div[data-name="' + $(this).data('name') + '"]').remove();
		}
	});

	$('#where').on('click', 'img', function(event){
		if ($(this).data('name')) {	//this is the "plus" img
			var img, selet, input;
			select = createSelect($(this).data('name'), true);
			input = createInput($(this).data('name'));
			$('div[data-name="' + $(this).data('name') + '"]').append(select + input);
		} else {	//this is the "and" / "or" image
			if ($(this).attr('src').search(/and\.png/) !== -1) {
				$(this).attr('src', $(this).attr('src').replace('and.png', 'or.png'));
				$(this).attr('title', '*' + $.sanga.texts[$.sanga.lang].or + '* ' + $.sanga.texts[$.sanga.lang].click2change);
				$(this).next().val('|');		//change value of the hidden input
			} else {
				$(this).attr('src', $(this).attr('src').replace('or.png', 'and.png'));
				$(this).attr('title', '*' + $.sanga.texts[$.sanga.lang].and + '* ' + $.sanga.texts[$.sanga.lang].click2change);
				$(this).next().val('&');
			}
		}
	});

	$('#dialog').dialog({
		autoOpen: false,
		closeText: '⊗',
		modal: true
	});

	$('#savequery').click(function(event){
		//offer an input a save and a canel button in a popup
		$('#dialog').dialog('open');
		//save query via ajax
		//add this to saved queries
		event.preventDefault();
	});

	$('#querySaveForm').submit(function(event){
		$('#dialog').dialog('close');
		event.preventDefault();
		var queryData = {
			name : 'Contacts/searchquery',
			value : $.param({qName : $('#queryname').val()}) + '&' + $('#queryForm').serialize()
		}
		$.ajax({
			url : $.sanga.baseUrl + '/Settings/add',
			data : queryData,
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
				$('#savedqueries').append(
					'<li>'+
						'<a href="' + $.sanga.baseUrl + '/Contacts/searchquery/' + jqXHR.responseJSON.id + '">' + $('#queryname').val() + '</a>'+
					'</li>'
					);
			}
		});
	});

	$('.ajaxremove').mouseenter(function(event){
		var src = $(event.target).attr('src');
		$(event.target).attr('src', src.replace(/remove.png/, 'remove_r.png'));
	});
	$('.ajaxremove').mouseleave(function(event){
		var src = $(event.target).attr('src');
		$(event.target).attr('src', src.replace(/remove_r.png/, 'remove.png'));
	});
	$('.ajaxremove').click(function(event){
		$.ajax({
			url : $.sanga.baseUrl + '/Settings/delete/' + $(location).attr('href').split('/').pop(),
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
			}
		});
	});

	$('#csvButton').click(function(event) {
		var form = $(this).parents('form:first');
		var action = form.attr('action');
		if (action.search('.csv') == -1) {
			if (action.search(/\?/) == -1) {
				form.attr('action', action + '.csv');
			} else {
				form.attr('action', action.replace(/\?/, '.csv?'));
			}
		}
	});

	$('#sButton').click(function(event) {
		var form = $(this).parents('form:first');
		var action = form.attr('action');
		if (action.search('.csv')) {
			form.attr('action', action.replace('.csv', ''));
		}
	});
});
