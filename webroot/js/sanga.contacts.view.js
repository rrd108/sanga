$(function() {
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
});