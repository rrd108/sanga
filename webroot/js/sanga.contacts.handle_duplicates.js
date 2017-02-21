$(function() {
    $('.setChange').click(function (event) {
        //hide coloumn
        var tdIndex = $(this).parent().index() + 1;
        $(this).parent().parent().parent().parent().find('td:nth-child(' + tdIndex + ')').hide();

        //TODO save id pairs to non-duplicates
        /*$.ajax({
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
                $('#subject').val('');
                $('#message').val('');
            }
        });*/

    });

    //this is not the right selector, as this just excludes the very first td
    $('table.duplicates tr td').not(':first').click(function (event) {
        var td = this;
        $(this).parent().children().each(function (index, element) {
            if (element == td) {
                $(element).toggleClass('setKeep');
            } else {
                $(element).removeClass('setKeep');
            }
        });
        //$(this).toggleClass('setKeep');
        //remove this class from others in this tr
    });
});