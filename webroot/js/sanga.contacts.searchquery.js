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
		
		select += '<option value="&?">' + prefix + $.sanga.texts[$.sanga.lang].contains + '</option>' +
					'<option value="&=">' + prefix + '=</option>' +
					'<option value="&!">' + prefix + $.sanga.texts[$.sanga.lang].not + '</option>' +
					'<option value="&<">' + prefix + '<</option>' +
					'<option value="&>">' + prefix + '></option>';
					
		if (addOptGroups) {
			prefix = $.sanga.texts[$.sanga.lang].or + ' ';
			select += 	'</optgroup>' + 
						'<optgroup label="---' + $.sanga.texts[$.sanga.lang].or + '---">' + 
							'<option value="|?">' + prefix + $.sanga.texts[$.sanga.lang].contains + '</option>' +
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
						'title="' + $.sanga.texts[$.sanga.lang].and + ' ' + $.sanga.texts[$.sanga.lang].click2change + '"' + 
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
				$(this).attr('title', $.sanga.texts[$.sanga.lang].or);
				$(this).next().val('|');		//change value of the hidden input
			} else {
				$(this).attr('src', $(this).attr('src').replace('or.png', 'and.png'));
				$(this).attr('title', $.sanga.texts[$.sanga.lang].and);
				$(this).next().val('&');
			}
		}
	});
	
});
