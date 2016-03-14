$(function() {
    $('._hd').mouseenter(function(event) {
        var detail = $(this).text();
        if (detail.substr(detail.length - 3) == '...') {
            $(this).css('cursor', 'pointer');
        }
    });
    $('._hd').mouseleave(function(event) {
        $(this).css('cursor', 'default');
    });

    $('._hd').click(function(event){
        //if the td has no ... at the end we do not have to do anything at all
        var detail = $(this).text();
        if (detail.substr(detail.length - 3) == '...') {
            $(this).append($('#ajaxloader').show());
            var elem = $(this);
            $.ajax({
                url : $.sanga.baseUrl + '/histories/get_detail/' + $(this).data('h-id'),
                type : 'get',
                dataType : 'json',
                error : function(jqXHR, textStatus, errorThrown){
                    $('#ajaxloader').hide();
                    noty({
                        text : textStatus,
                        type : 'error',
                        animation : $.sanga.animation
                    });
                },
                success : function(data, textStatus, jqXHR){
                    $('#ajaxloader').hide();
                    elem.text(jqXHR.responseJSON.detail);
                    elem.effect('highlight', {duration: 800});
                }
            });
        }
    });
});