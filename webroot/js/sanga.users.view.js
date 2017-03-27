$(function() {
    $('#groups span').hide();

    $('#groups a').click(function(event, element){
        $('span#g' + $(this).attr('id')).show();
        event.preventDefault();
    });
});