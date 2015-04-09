$(function() {	
	
	$('#name').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Contacts/search',
		html : true,
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = '';
			
			$.ajax({
				url : $.sanga.baseUrl + '/Contacts/editgroup/' + ui.item.value,
				data : {
						'groups[_ids][]' : [$('#addMember').attr('action').split('/').pop()]
						},
				type : 'post',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					noty({
						text: textStatus + ((jqXHR && jqXHR.responseJSON &&jqXHR.responseJSON.message) ? ' : ' + jqXHR.responseJSON-message : ''),
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
					var member = '<li>' +
									'<a href="' + $.sanga.baseUrl + '/Contacts/view/' + ui.item.value + '">' + ui.item.label + '</a>' +
									'<img title="' + $.sanga.texts[$.sanga.lang].click2remove + '" src="' + $.sanga.baseUrl + '/img/remove.png" class="ajaxremove">' +
								'</li>';
					$('#members').append(member);
				}
			});
			return false;
		},
		change : function(event, ui) {
			this.value = '';
			
			$.ajax({
				url : $.sanga.baseUrl + '/Contacts/editgroup/' + ui.item.value,
				data : {
						'groups[_ids][]' : [$('#addMember').attr('action').split('/').pop()]
						},
				type : 'post',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					noty({
						text: textStatus + ((jqXHR && jqXHR.responseJSON &&jqXHR.responseJSON.message) ? ' : ' + jqXHR.responseJSON-message : ''),
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
					var member = '<li>' +
									'<a href="' + $.sanga.baseUrl + '/Contacts/view/' + ui.item.value + '">' + ui.item.label + '</a>' +
									'<img title="' + $.sanga.texts[$.sanga.lang].click2remove + '" src="' + $.sanga.baseUrl + '/img/remove.png" class="ajaxremove">' +
								'</li>';
					$('#members').append(member);
				}
			});
			return false;
		}
	});
	
	$('#members').on('mouseenter', '.ajaxremove', function(event){
		var src = $(event.target).attr('src');
		$(event.target).attr('src', src.replace(/remove.png/, 'remove_r.png'))
	});
	$('#members').on('mouseleave', '.ajaxremove', function(event){
		var src = $(event.target).attr('src');
		$(event.target).attr('src', src.replace(/remove_r.png/, 'remove.png'))
	});
	
	$('#members').on('click', '.ajaxremove', function(event){
		$.ajax({
			url : $.sanga.baseUrl + '/Contacts/removegroup/' + $(this).prev().attr('href').split('/').pop(),
			data : {
					'group_id' : $(location).attr('href').split('/').pop()
					},
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				noty({
					text: textStatus + ((jqXHR && jqXHR.responseJSON &&jqXHR.responseJSON.message) ? ' : ' + jqXHR.responseJSON-message : ''),
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
				$(event.target).parent().fadeOut();
			}
		});
	});

});