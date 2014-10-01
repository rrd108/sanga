<?php
$config = [
    'autocomplete' => '<div class="input text autocomplete">
                            <label for="{{name}}" title="{{title}}">{{label}}</label>
                            <input id="{{name}}" type="text" name="{{name}}"{{attrs}}>
                        <script>
                            $("#{{name}}").autocomplete({source : "{{source}}", minLength : 2});
                        </script>
                        </div>'
];
?>