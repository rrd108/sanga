$(function() {
	
	var urlbase = (location.pathname.search(/view/) != -1) ? '../..' : '..';
	
	$('#birth').datepicker();
	
	function addSkillSpanAndInput(event, ui){
		var t = $(event.target);
		var tag = "";
		var id = null;
		if (ui.item) {
			tag =  ui.item.label
			id = ui.item.value;
		}
		else{
			tag = $(event.target).val();
			id = "~" + tag;	//if the value starts with "~" that is a new skill
		}
		t.parent().append('<span class="tag tag-shared removeable">' + tag + '</span> ');
		t.parent().append('<input type="hidden" name="skills[_ids][]" value="' + id + '">');
		t.val("");
		t.focus();
	}
	
	$(document).on('click', '.removeable', function(){
		//remove acidently added skills
		$(this).next().remove();
		$(this).remove();
	});
	
	$('#skills-ids')
		.bind("keydown", function(event) {
			// don't navigate away from the field on tab when selecting an item
			if ((event.keyCode === $.ui.keyCode.TAB || event.keyCode === $.ui.keyCode.ENTER) && $(this).autocomplete("instance").menu.active) {
				event.preventDefault();
			}
			else if (event.keyCode === $.ui.keyCode.ENTER){
				addSkillSpanAndInput(event, {item : null});
				event.preventDefault();
			}
		})
		.autocomplete({
			minLength : 2,
			source : urlbase + '/Skills/search',
			focus: function() {
				// prevent value inserted on focus
				return false;
			},
			select : function(event, ui) {	//when we select something from the dropdown
				this.value = ui.item.label;
				addSkillSpanAndInput(event, ui);
				return false;
			},
			change : function(event, ui){	//when we blur the input or change its value
				addSkillSpanAndInput(event, ui);
				return false;
			}
		});
	
	$('#xzip').autocomplete({
		minLength : 2,
		source : urlbase + '/Zips/search',
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
	
	$('#xfamily').autocomplete({
		minLength : 2,
		source : urlbase + '/Contacts/search',
		html: true,
		focus: function() {
			return false;
		},		
		select : function(event, ui) {	//when we select something from the dropdown
			this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
			$('#family-member-id').val(ui.item.value);
			return false;
		},
		change : function(event, ui) {
			this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
			$('#family-member-id').val(ui.item.value);
			return false;
		}
	});

});