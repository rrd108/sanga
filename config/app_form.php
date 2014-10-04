<?php
$config = [
    'autocompletechecker' => '<div class="input text autocomplete">
                            <label for="{{name}}">{{label}}</label>
                            <input id="{{name}}" type="text" name="{{name}}" {{attrs}}>
                        <script>
                            $("#{{name}}").autocomplete(
                                            {source : "{{source}}",
                                            minLength : 2,
                                            html : true,
                                            });
                        </script>
                        </div>',
    'autocompleteselect' => '<div class="input text autocomplete">
                            <label for="{{name}}">{{label}}</label>
                            <input id="_{{name}}" type="text" name="_{{name}}" {{attrs}}>
                            <input id="{{name}}" type="hidden" name="{{name}}">
                        <script>
                            $("#_{{name}}").autocomplete(
                                            {source : "{{source}}",
                                            minLength : 2,
                                            html : true,
                                            select : function(event, ui){
                                                $("#{{name}}").val(ui.item.value);
                                                event.target.value =  $("<div/>").html(ui.item.label).text();
                                                event.preventDefault();
                                            },
                                            focus : function(event, ui){
                                                event.preventDefault();
                                            }
                                            });
                        </script>
                        </div>'
];
?>