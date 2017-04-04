$(function() {
	
	//for filter
	
	autocompleteBuilder = function(params){
		$(params.selector).autocomplete({
			minLength : 2,
			html: true,
			source : $.sanga.baseUrl + params.url,
			focus: function() {
				return false;
			},		
			select : function(event, ui) {	//when we select something from the dropdown
				this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
				$(params.target).val(ui.item.value);
				return false;
			},
			change : function(event, ui) {
				if (ui.item) {
					this.value = ui.item.label.replace(/(<([^>]+)>)/ig,'');		//remove highlight html code;
					$(params.target).val(ui.item.value);
				}
				return false;
			}
		});
	};

});