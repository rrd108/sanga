$(function() {
	
	createSelect = function(name, addOptGroups){
		var prefix = '';
		var select = '<select ' +
					'id="s' + name.replace(/\./g, '_') + '"' +
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
						'name="' + name + '[]" ' +
						'id="' + name + '" ' +
						'class="thin" ' +
					'>';
		return input;
	};
	
	$('#query-select-box span').click(function(event){
		if ($(this).hasClass('tag-default')) {
			$(this).removeClass('tag-default');
			$(this).addClass('tag-viewable');
			
			var img, label, select, input;
			img = '<img ' + 
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
			$('#where').append('<div data-name="' + $(this).data('name') + '">' + img + label + select + input + '</div>');
		} else {
			$(this).removeClass('tag-viewable');
			$(this).addClass('tag-default');
			$('#l' + $(this).data('name').replace(/\./g, '_')).remove();		//label
			$('#s' + $(this).data('name').replace(/\./g, '_')).remove();		//select
			$('[name="' + $(this).data('name') + '[]"]').remove();	//inputs
		}
	});
	
	$('#where').on('click', 'img', function(event){
		var selet, input;
		select = createSelect($(this).data('name'), true);
		input = createInput($(this).data('name'));
		$('div[data-name="' + $(this).data('name') + '"]').append(select + input);
	});

	$('#xzip').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Zips/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label;
			$('#zip-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label;
			$('#zip-id').val(ui.item.value);
			return false;
		}
	});
	
	$('#xgroup').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Groups/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label;
			$('#group-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label;
			$('#group-id').val(ui.item.value);
			return false;
		}
	});
});