$(function() {
	var urlbase = (location.pathname.search(/view/) != -1) ? '../..' : '..';
	
	var n = $.localStorage('sanga.userViewActiveTab') ? $.localStorage('sanga.userViewActiveTab') : 0;
	$("#tabs").tabs({active : n}).addClass("ui-tabs-vertical ui-helper-clearfix");
	$("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");

	$(window).on('beforeunload', function(){
		var n = $(".ui-tabs-active")[0]["id"].replace(/tabnav-/, '');	//number of active tab
		$.localStorage('sanga', {userViewActiveTab : parseInt(n) - 1});
	});

	$(".draggable").draggable({
		revert : "invalid",
		opacity : 0.7,
		zIndex : 100
	});
	
	//family
	$("#notfamilymember").droppable({
		over : function(event, ui){
			$(this).addClass("ui-state-highlight");
			$(this).children('div').addClass('delete-open').removeClass("delete-close");
		},
		out : function(event, ui){
			$(this).removeClass("ui-state-highlight");
			$(this).children('div').addClass('delete-close').removeClass("delete-open");
		},
		drop : function(event, ui){
			var aLink = $(ui.draggable).find('a');
			aLink = $(aLink[0]);
			$.ajax({
				url : aLink.attr('href').replace(/view\/(\d+)/, 'remove_family/$1'),
				type : 'get',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					alert(jqXHR.responseJSON.message);
				},
				success : function(data, textStatus, jqXHR){
					ui.draggable.hide();
					$(event.target).removeClass("ui-state-highlight");
				}
			});
		}
	});

	//groups
	$("#member").droppable({
		accept: ".notmember",
		over : function(event, ui){
			$(this).addClass("ui-state-highlight");
		},
		out : function(event, ui){
			$(this).removeClass("ui-state-highlight");
		},
		drop : function(event, ui) {
			$.ajax({
				url : $(location).attr('href').replace(/view\/(\d+)/, 'editgroup/$1'),
				data : {
							'groups[_ids][]' : [ui.draggable.data('id')]
						},
				type : 'post',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					alert(textStatus);
				},
				success : function(data, textStatus, jqXHR){
					var d = ui.draggable;
					d.appendTo(event.target);
					d.attr('style', 'position:relative');
					d.removeClass("tag-default notmember");
					d.addClass("member");
					d.addClass(ui.draggable.data('css'));
					$(event.target).removeClass("ui-state-highlight");
				}
			});
		}
	});

	$("#notmember").droppable({
		accept: ".member",
		over : function(event, ui){
			$(this).addClass("ui-state-highlight");
		},
		out : function(event, ui){
			$(this).removeClass("ui-state-highlight");
		},
		drop : function(event, ui) {
			$.ajax({
				url : $(location).attr('href').replace(/view\/(\d+)/, 'removegroup/$1'),
				data : {
							'groups[_ids][]' : [ui.draggable.data('id')]
						},
				type : 'post',
				dataType : 'json',
				error : function(jqXHR, textStatus, errorThrown){
					alert(textStatus);
				},
				success : function(data, textStatus, jqXHR){
					var d = ui.draggable;
					d.appendTo(event.target);
					d.attr('style', 'position:relative');
					d.removeClass(ui.draggable.data('css'));
					d.removeClass("member");
					d.addClass("tag-default notmember");
					$(event.target).removeClass("ui-state-highlight");
				}
			});
		}
	});
	
	//personal data, workplae
	$('p.ed').hover(
		function(){		//handlerIn
			$(this).append($('#editlink').show());
		},
		function(){		//handlerOut
			$('#editlink').hide();
		}
	);
	
	$('#editForm').submit(function(event){
		event.preventDefault();
	});
	$('.editbox').change(function(event){
		var theSpan, newData;
		var editedData = {};
		if ($(this).attr('class').search(/zip/) != -1) {
			theSpan = $(this).parent().find('.zip-zip');
			newData = $('#xzip').val().split(' ');
			newData = newData[0];
			editedData['zip_id'] = $('#zip-id').val();
		} else if ($(this).attr('class').search(/family/) != -1) {
			theSpan = $(this).parent().find('.dta');
			editedData['family_member_id'] = $('#family-member-id').val();
			var addSpan = $('#xfamily').val();
		} else {
			theSpan = $(this).parent().find('.dta');
			if ($(this).is(':checkbox')) {
				newData = + $(this).is(':checked');		// + converts bool to int
			} else if ($(this).is('span')) {		//sex
				newData = $(this).parent().find(':checked').val();
			} else {
				newData = $(this).val();
			}
			editedData[$(this).attr('id')] = newData;
		}
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
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				theP.append($('#okImg').show().hide(12500));
				if (addSpan) {
					theP.append('<span class="tag tag-viewable draggable">' + addSpan + '</span> ');
				}
			}
		});
		$(this).hide();
		theSpan.show();
	});
	$('#editlink').click(function(event){
		//if there is any other open input we should close it
		$('.editbox').hide();
		$('span.dta').show();
		//and open exactly this one
		$(this).parent().find('.editbox').show();
		$(this).parent().find('span.dta').hide();
		event.preventDefault();
	});
	
	$('#gSave').click(function(event){
		var container = $(this);
		container.append($('#ajaxloader').css('float', 'none').show());
		$.ajax({
			url : $(this).attr('href'),
			type : 'get',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				$('#ajaxloader').hide();
				container.append($('#errorImg').css('float', 'none').show());
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				container.append($('#okImg').css('float', 'none').show().hide(12500));
				var imgSrc = $('#gImg').attr('src');
				$('#gImg').attr('src', imgSrc.replace(/-inactive/, ''));
			}
		});
		event.preventDefault();
	});
	
	//history
	$('#date').datepicker();
	
	$('#xgroup-id').autocomplete({
		minLength : 2,
		source : urlbase + '/Groups/search',
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
		source : urlbase + '/Events/search',
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
	
	$('#detail').blur(function(event){
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
				quantity : null,
				unit_id : null,
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
					animation : $.animation
				});
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				inf.append($('#okImg').show().hide(12500));
				noty({
					text : jqXHR.responseJSON.message,
					type : jqXHR.responseJSON.save ? 'success' : 'error',
					animation : $.animation
				});
				var newRow = $("<tr>");
				var cols = "";
				cols += '<td>' + $('#date').val() + '</td>';
				cols += '<td>' + $('#uName').text() + '</td>';
				cols += '<td>' + $('#xgroup-id').val() + '</td>';
				cols += '<td>' + $('#xevent-id').val() + '</td>';
				cols += '<td>' + $('#detail').val() + '</td>';
				cols += '<td class="r"></td>';
				cols += '<td></td>';
				newRow.append(cols);
				$('#hTable > tbody').children('tr:first').after(newRow);
				
				$('#xgroup-id').val("");
				$('#group-id').val("");
				$('#xevent-id').val("");
				$('#event-id').val("");
				$('#detail').val("");
			}
		});
	});

});