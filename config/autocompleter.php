<?php
$config = [
    'autocompletechecker' => '<div class="input text autocomplete">
                            <label for="{{name}}">{{label}}</label>
                            <input id="{{name}}" type="text" name="{{name}}" value="{{value}}" {{attrs}}>
                        <script>
                            $("#{{safeName}}").autocomplete(
                                            {source : "{{source}}",
                                            minLength : 2,
                                            html : true,
                                            });
                        </script>
                        </div>',
    'autocompleteOnSelectValue' => '<div class="input text autocomplete">
                            <label for="{{name}}">{{label}}</label>
                            <input id="_{{name}}" type="text" name="_{{name}}" value="{{value}}" {{attrs}}>
                            <input id="{{name}}" type="hidden" name="{{name}}">
                        <script>
                            $("#_{{safeName}}").autocomplete(
                                            {
												source : "{{source}}",
												minLength : 2,
												html : true,
												select : function(event, ui){
													$("#{{safeName}}").val(ui.item.value);
													event.target.value =  $("<div/>").html(ui.item.label).text();
													event.preventDefault();
												},
												focus : function(event, ui){
													{{focus}}
												},
												change : function(event, ui){
													{{change}}
												}
                                            }
										);
                        </script>
                        </div>'
];
?>