$(function () {
    $('.editlink').click(function (event) {
        var tds = $(this).parent().parent().children();
        var groupId = $(this).attr('href').split('/').pop();
        //hide other inputs if they are opened
        $('#groupName').parent().html($('#groupName').val());
        $('#groupDescription').parent().html($('#groupDescription').val());
        //add 2 new inputs
        var groupName = $($(tds[2]).children()[0]).text();
        var input = '<input type="text" value="' + groupName + '" id="groupName" data-gid="' + groupId + '">';
        $($(tds[2]).children()[0]).html(input);
        var groupDescription = $(tds[4]).text();
        input = '<input type="text" value="' + groupDescription + '" id="groupDescription" data-gid="' + groupId + '">';
        $(tds[4]).html(input);

        $('#groupName').on('blur', function (event) {
            console.log($(this).data('gid'));
            //send ajax
        });

        event.preventDefault();
    });
/*    $('#members').on('click', '.ajaxremove', function (event) {
        $.ajax({
            url: $.sanga.baseUrl + '/Contacts/removegroup/' + $(this).prev().attr('href').split('/').pop(),
            data: {
                'group_id': $(location).attr('href').split('/').pop()
            },
            type: 'post',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                noty({
                    text: textStatus + ((jqXHR && jqXHR.responseJSON && jqXHR.responseJSON.message) ? ' : ' + jqXHR.responseJSON - message : ''),
                    type: 'error',
                    timeout: 3500,
                });
            },
            success: function (data, textStatus, jqXHR) {
                noty({
                    text: jqXHR.responseJSON.message,
                    type: 'success',
                    timeout: 3500,
                });
                $(event.target).parent().fadeOut();
            }
        });
    });
*/
});