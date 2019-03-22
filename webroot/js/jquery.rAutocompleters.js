/*
* if the input has data-ac="url/for/search" attribute in the given form
*
* creates a copy of the input what will be an autocompleter,
* and makes the original input hidden
*
* the original input will receive the selected items id from the
* autocompleters dropdown
*
* $.createAutocompleters('FormId'); shold be called
*
* You can change cache name and have baseUrl set
*
* $.createAutocompleters('FormId',
*   {cacheName : 'MyApplicationName', baseUrl : 'https://example.com/'}
*   );
*
* */

$.rAutocompleteCacheName = 'rAutocompleteCache';

$.createAutocompleters = function (formId, options) {
    options = $.extend({
        cacheName : $.rAutocompleteCacheName,
        baseUrl : ''
    }, options);

    function setValForHiddenPair(element) {
        var elementId = element.attr('id').replace('ac-', '');
        if (element.data('selectedId')) {
            $('#' + elementId).val(element.data('selectedId'));
            element.removeClass('callout alert');
        }
    }

    var blurHandler = function () {
        var element = $(this);
        var v = element.val();
        //handling fast typers in autocompleters
        //if there is no space in the value the user blured the input without waiting for the answer
        if (v && v.indexOf(' ') == -1) {
            //lets check if the data is already in the cache
            var key = element.data('ac') + '/' + v;
            var cache = $.localStorage(options.cacheName + '.' + key);
            if (cache) {
                element.val(cache[0].label);
                element.data('selectedId', cache[0].value);
                setValForHiddenPair(element);
            } else {
                //if not start another ajax call
                //as this happens async we should set values in success
                element.addClass('loading');
                //prevent submits during ajax call
                $(':input[data-type="submit"]').prop('disabled', true);
                $.ajax(
                    {
                        dataType : 'json',
                        url : options.baseUrl + element.data('ac') + '?term=' + v,
                        success : function (data) {
                            element.removeClass('loading');
                            if (data[0]) {
                                $.localStorage(options.cacheName + '.' + key, data);   //add to the cache
                                element.val(data[0].label);
                                element.data('selectedId', data[0].value);
                                setValForHiddenPair(element);
                                $(':input[data-type="submit"]').prop('disabled', false);
                            } else {
                                element.effect('shake');
                                element.val('???');
                                noty({
                                    layout: 'topRight',
                                    type: 'error',
                                    timeout: 5000,
                                    closeWith: ['click'],
                                    text: 'Data error'
                                });
                            }
                        }
                    }
                );
            }
        } else {
            setValForHiddenPair(element);
        }
    };

    $.createAutocompleters.blurHandler = blurHandler;

    var autocompleters = $('#' + formId + ' input[data-ac]');
    autocompleters.each(function () {
        //change id and name
        var originalId = $(this).attr('id');
        var name = originalId.replace(/-/, '_');
        $(this).attr('id', 'ac-' + originalId);
        $(this).attr('name', 'ac-' + name);
        $(this).attr('autocomplete', 'off');

        //add hidden couple
        var hiddenInput = '<input ' +
            'name="' + name + '" ' +
            'id="' + originalId + '" ' +
            'value="' + $(this).val() + '" ' +
            'type="hidden">';
        $(this).after(hiddenInput);

        //copy value from data-val attribute
        $(this).val($(this).data('val'));

        //add autocompleter
        $(this).autocomplete(
            $.autocompletefactory(
                {
                    url : options.baseUrl + $(this).data('ac'),
                    cacheName : options.cacheName
                }
            )
        );

        $(this).blur(blurHandler);
    });

    $('body').append('<div id="dialog"></div>');
    $('#dialog').dialog(
        {
            autoOpen : false,
            width : 500
        }
    );

    $('#dialog').on('click', function (event) {
        var acId = $(event.target).data('target');
        var inputId = acId.replace('ac-', '');
        $('#' + acId).val($(event.target).text());
        $('#' + acId).data('selectedId', $(event.target).data('id'));
        $('#dialog').dialog('close');
    });
};

/*
 * returns an object for jQuery's autocomplete
 * usage: $input.autocomplete({url : http://example.com});
 * require: jQuery, jQuery.rStorage
 *
 * the server should response with an array like this:
 * [
 *  { label: "Label 1", value: 15 },
 *  { label: "Label 2", value: "radha" }
 * ];
*/

$.autocompletefactory = function (options) {
    var settings = $.extend({
        resultCount : 5,        //this is the limit parameter for cake find all method
        minLength : 2
    }, options);

    if (settings.cacheName) {
        $.rAutocompleteCacheName = settings.cacheName;
    }

    if (!settings.url) {
        throw new Error("autocompelete factory called without url parameter");
        return null;
    }

    if($.localStorage(settings.cacheName) === null) {
        $.localStorage(settings.cacheName, {});
    }

    var now = new Date();
    //invalidate cache if it is older than 12 hours
    if ($.localStorage(settings.cacheName + '.time')
        && $.localStorage(settings.cacheName + '.time') < (now - 1000*60*60*12)) {
        $.localStorage.remove(settings.cacheName);
    }
    $.localStorage(settings.cacheName, {'time' : now.getTime()});

    return {
        resultCount : settings.resultCount,        //this is the limit parameter for cake find all method
        minLength : settings.minLength,

        //order of callback calls: create, search, source, GET, response, open, focus, select, close, change

        source : function (request, response) {    //the data to use
            var key = settings.url + '/' + request.term;
            var dataResp;
            if(key in $.localStorage(settings.cacheName) ) {        //if the query is already in the cache
                dataResp = $.localStorage(settings.cacheName)[key];
            } else {
                $.ajax(
                    {
                        async : false,
                        dataType : 'json',
                        url : settings.url,
                        data : request,
                        success : function (data, status, xhr) {    //if there is no cached version
                            //add to the cache only if there is result
                            if (data.length != 0) {
                                $.localStorage(settings.cacheName + '.' + key, data);
                            }
                            dataResp = data;
                        }
                    }
                );
            }
            if (dataResp.length == 0) {
                response({
                    label : 'Hiba: nincs talรฝlat!',
                    value : -1
                });
                return false;
            }
            if (request.term.indexOf('*') == -1) {
                dataResp.push(
                    {
                        label: request.term + ' ' + '*', //space is needed for autocompleter blur
                        value: 0
                    }
                );
            }
            response(dataResp);
            $(this.element).data('selectedId', dataResp[0].value);
        },

        open: function(event, ui) {
            if ($(this).val().indexOf('*') == -1) {
                $('.ui-autocomplete li:last div').html(
                    '<i class="fi-magnifying-glass"> ' + $(this).val() + ' * ' + '</i>'   //space is needed for autocompleter blur
                );
            }
        },

        focus : function (event, ui){        //callback for focus on an element
            $(this).val(ui.item.label);
            $(this).data('selectedId', ui.item.value);
            event.preventDefault();
        },

        select : function (event, ui){        //callback for select from the drop down
            $(this).val(ui.item.label);
            $(this).data('selectedId', ui.item.value);
            if (ui.item.value === 0) {
                $.ajax(
                    {
                        dataType : 'json',
                        url : settings.url,
                        data : {
                            term : ui.item.label.replace(' *', ''),
                            limit : 50
                        },
                        input : $(this),
                        success : function (data) {
                            // this.input
                            $('#dialog').dialog('option', 'title', ui.item.label);
                            var inputId = this.input.attr('id');
                            $.each(data, function (index, result) {
                                $('#dialog').append(
                                    '<li data-id="' + result.value + '" data-target="' + inputId + '">'
                                    + result.label
                                    + '</li>'
                                );
                            });
                            $('#dialog').dialog('open');
                        }
                    }
                );
            }
            event.preventDefault();
        }
    };
};
