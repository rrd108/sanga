$(function() {	
	$('#date').datepicker();
	
	$('#xgroup-id').autocomplete({
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
	
	$('#xevent-id').autocomplete({
		minLength : 2,
		source : $.sanga.baseUrl + '/Events/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label;
			$('#event-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label;
			$('#event-id').val(ui.item.value);
			return false;
		}
	});
	
	$('#xunit-id').autocomplete({
		minLength : 1,
		source : $.sanga.baseUrl + '/Units/search',
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label;
			$('#unit-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label;
			$('#unit-id').val(ui.item.value);
			return false;
		}
	});

	var sendForm = function(event){
		var inf = $('#hInfo');
		inf.append($('#ajaxloader').show());
		$.ajax({
			url : $('#hForm').attr('action'),
			data : {
				contact_id : $('#contact-id').val(),
				date : $('#date').val(),
				group_id : $('#group-id').val(),
				event_id : $('#event-id').val(),
				detail : $('#detail').val(),
				quantity : $('#quantity').val(),
				unit_id : $('#unit-id').val(),
				family : null
			},
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				$('#ajaxloader').hide();
				inf.append($('#errorImg').show());
				noty({
					text : textStatus,
					type : 'error',
					animation : $.sanga.animation
				});
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				inf.append($('#okImg').show().hide(12500));
				noty({
					text : jqXHR.responseJSON.message,
					type : jqXHR.responseJSON.save ? 'success' : 'error',
					animation : $.sanga.animation
				});
				var newRow = $("<tr>");
				var cols = "";
				
				if(location.pathname.search(/Histories/) != -1){	//if we are at History index we have an extra coloumn
					cols += '<td>' + $('#xcontact-id').val() + '</td>';
				}
				cols += '<td>' + $('#date').val() + '</td>';
				cols += '<td>' + $('#uName').text() + '</td>';
				cols += '<td>' + $('#xgroup-id').val() + '</td>';
				cols += '<td>' + $('#xevent-id').val() + '</td>';
				cols += '<td>' + $('#detail').val() + '</td>';
				cols += '<td class="r">' +
							$('#quantity').val() + ' ' +
							$('#xunit-id').val() +
						'</td>';
				cols += '<td></td>';
				newRow.append(cols);
				$('#hTable > tbody').children('tr:first').after(newRow);
				
				$(':input', '#hForm').not('.dontdel').val("");
			}
		});
	}
	
	$('#xunit-id').blur(sendForm);

});