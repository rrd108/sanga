$(function () {
    $('.editlink').click(function (event) {
        var tds = $(this).parent().parent().children();
        var groupId = $(this).attr('href').split('/').pop();
        //hide other inputs if they are opened
        $('#gname').parent().html($('#gname').val());
        $('#gdescription').parent().html($('#gdescription').val());
        //add 2 new inputs
        var gname = $($(tds[2]).children()[0]).text();
        var input = '<input type="text" value="' + gname + '" id="gname" data-gid="' + groupId + '">';
        $($(tds[2]).children()[0]).html(input);
        var gdescription = $(tds[4]).text();
        input = '<input type="text" value="' + gdescription + '" id="gdescription" data-gid="' + groupId + '">';
        $(tds[4]).html(input);

        event.preventDefault();
    });

    $(document.body).on('change', '#gname, #gdescription', function (event) {
        var data = {};
        data[$(this).attr('id').replace('g', '')] = $(this).val();
        $.ajax({
            url: $.sanga.baseUrl + '/Groups/edit/' + $(this).data('gid'),
            data: data,
            type: 'post',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                noty({
                    text: textStatus + (jqXHR && jqXHR.responseJSON ? ' : ' + jqXHR.responseJSON : ''),
                    type: 'error',
                    timeout: 3500,
                });
            },
            success: function (data, textStatus, jqXHR) {
                noty({
                    text: jqXHR.responseJSON.name + ' saved',
                    type: 'success',
                    timeout: 3500,
                });
                $(this).parent().html($(this).val());
            }
        });
    });
});