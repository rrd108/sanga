<?php
$config = [
    'autocomplete' => '<div class="input text autocomplete">
                            <label for="{{name}}" title="{{title}}">{{label}}</label>
                            <input id="{{name}}" type="text" name="{{name}}"{{attrs}}>
                        <script>
                            $("#{{name}}").autocomplete(
                                            {source : "{{source}}",
                                            minLength : 2,
                                            html : true,
                                            select : function(event, ui){
                                                event.target.dataset.id = ui.item.value;
                                                event.target.value =  $("<div/>").html(ui.item.label).text();
                                                event.preventDefault();
                                            },
                                            focus : function(){
                                                event.preventDefault();
                                            }
                                            });
                        </script>
                        </div>'
];
?>