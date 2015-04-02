$(function() {
	
	$('.editbox').hide();
	
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
			$(this).addClass("highlight");
			$(this).children('div').addClass('delete-open').removeClass("delete-close");
		},
		out : function(event, ui){
			$(this).removeClass("highlight");
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
					$(event.target).removeClass("highlight");
				}
			});
		}
	});

	//groups
	$("#member").droppable({
		accept: ".notmember",
		over : function(event, ui){
			$(this).addClass("highlight");
		},
		out : function(event, ui){
			$(this).removeClass("highlight");
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
					$(event.target).removeClass("highlight");
				}
			});
		}
	});

	$("#notmember").droppable({
		accept: ".member",
		over : function(event, ui){
			$(this).addClass("highlight");
		},
		out : function(event, ui){
			$(this).removeClass("highlight");
		},
		drop : function(event, ui) {
			$.ajax({
				url : $(location).attr('href').replace(/view\/(\d+)/, 'removegroup/$1'),
				data : {
							'group_id' : [ui.draggable.data('id')]
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
					$(event.target).removeClass("highlight");
				}
			});
		}
	});
	
	//personal data, workplace
	$('p.ed').hover(
		function(){		//handlerIn
			if ($(this).find('#ajaxsave').length) {	//if ajaxsave is there we do not needmeditlink
				$('#editlink').hide();
			} else {
				$(this).append($('#editlink').show());
			}
		},
		function(){		//handlerOut
			$('#editlink').hide();
		}
	);

	$(document).on('click', '.removeable', function(){
		//remove skills (span removed by sanga.contacts.add.js) but on edit we should do some ajax
		$.ajax({
			url : $.sanga.baseUrl + '/Contacts/removeSkill',
			data : {contact_id : $('#contact-id').val(),
					skill_id : $(this).data('id')},
			type : 'post',
			dataType : 'json',
			error : function(jqXHR, textStatus, errorThrown){
				noty({
					text: textStatus,
					type: 'error',
					timeout: 3500,
					});
				theSpan.text(oldData);
			},
			success : function(data, textStatus, jqXHR){
				noty({
					text: textStatus + ' ' + jqXHR.responseJSON.message,
					type: 'success',
					timeout: 3500,
					});
			}
		});
	});

	
	$('#editForm').submit(function(event){
		event.preventDefault();
	});
	
	$('.editbox').keypress(function(event){
		//hide editlink and show ajaxsave
		$('#editlink').hide();
		$(this).parent().append($('#ajaxsave').show());
		if (event.keyCode == 27) {		// escape key maps to keycode `27`
			$(this).hide();
			$(this).parent().find('.dta').show();
			$('#ajaxsave').hide();
		}   
	});

	$('#ajaxsave').click(function(event){
		var editboxes = $(this).parent().find('.editbox');
		var editedData = {}, oldData = {}, theSpan, addSpan;
		
		editboxes.each(function(index){
			var newData;
			var editbox = $(this);
			
			if (editbox.attr('class').search(/zip/) != -1) {
				if (editbox.attr('id').search(/workplace/) != -1) {
					theSpan = editbox.parent().find('.workplace_zip-zip');
					newData = $('#xworkplace-zip').val().split(' ');
					newData = newData[0];
					editedData['workplace_zip_id'] = $('#workplace-zip-id').val();
				} else {
					theSpan = editbox.parent().find('.zip-zip');
					newData = $('#xzip').val().split(' ');
					newData = newData[0];
					editedData['zip_id'] = $('#zip-id').val();
				}
			} else if (editbox.attr('class').search(/family/) != -1) {
				theSpan = editbox.parent().find('.dta');
				editedData['family_member_id'] = $('#family-member-id').val();
				addSpan = $('#xfamily').val();
			} else if (editbox.attr('class').search(/addr/) != -1) {
				if (editbox.attr('id').search(/workplace/) != -1) {
					theSpan = editbox.parent().find('.workplace_address');
					newData = editedData['workplace_address'] = $('#workplace-address').val();
				} else {
					theSpan = editbox.parent().find('.address');
					newData = editedData['address'] = $('#address').val();
				}
			} else if (editbox.attr('id') == 'skills-ids'){
				theSpan = editbox.parent().find('.dta');
				editedData['skills[_ids]'] = [];
				$('[name=skills\\[_ids\\]\\[\\]]').each(function(){
					(editedData['skills[_ids]']).push($(this).val());
				});
			} else {
				theSpan = editbox.parent().find('.dta');
				if (editbox.is(':checkbox')) {
					newData = + editbox.is(':checked');		// + converts bool to int
				} else if (editbox.is('span')) {		//sex
					newData = editbox.parent().find(':checked').val();
				} else {
					newData = editbox.val();
				}
				editedData[editbox.attr('name')] = newData;
			}
			oldData[editbox.attr('name')] = theSpan.text();		//editbox.attr('name') = pl legalname
			theSpan.text(newData);
		});

		$('#editlink').hide();
		var theP = $(editboxes[0]).parent();
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
				noty({
					text: textStatus,
					type: 'error',
					timeout: 3500,
					});
				theSpan.text(oldData[this.data.substr(0, this.data.indexOf('='))]);		//this.data.substr(0, this.data.indexOf('=')) = pl legalname
			},
			success : function(data, textStatus, jqXHR){
				$('#ajaxloader').hide();
				theP.append($('#okImg').show().hide(12500));
				if (addSpan) {
					theP.append('<span class="tag tag-viewable draggable">' + addSpan + '</span> ');
				}
			}
		});
		editboxes.hide();
		theSpan.show();
		event.preventDefault();
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
	
	$('#sendmail').click(function(event){
		var container = $(this).parent();
		container.append($('#ajaxloader').css('float', 'none').show());
		$.ajax({
			url : $.sanga.baseUrl + '/Contacts/sendmail',
			type : 'post',
			data : {
				subject : $('#subject').val(),
				message : $('#message').val()
				},
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
		
	});
	
	$( "#dialog" ).dialog({
		autoOpen: false,
		closeText: '⊗',
		position: {
			of: $('#settings'),
			my: 'top+20',
			at: 'right+300'
		},
		width: '600',
		show: {
			effect: "slideDown"
		},
		hide: {
			effect: "slideUp"
		}
	});

	$( "#settings" ).click(function() {
		$( "#dialog" ).dialog( "open" );
	});
	
	$('#settingsForm').submit(function(event){
		event.preventDefault();
		$.ajax({
			url : $.sanga.baseUrl + '/Settings/edit',
			data : $('#settingsForm').serialize(),
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
				location.reload();
			}
		});
	});
});