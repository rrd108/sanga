$(document).foundation();

$(function () {
    $('#hamburger').click(function () {
        $(this).toggleClass('opened');
    });

    $('#menu > ul > li').click(function () {
        if ($(window).width() <= 540) {
            $(this).find('ul').toggle('350');
        }
    });

    $('ul.sf-menu').superfish({
        pathClass: 'current'
    });

    $.sanga = {};
    $.sanga.baseUrl = $($('script')[1]).attr('src').replace(/\/js\/.*/, '');
    $.sanga.animation = {
        open: 'animated bounceInDown', // Animate.css class names
        close: 'animated bounceOutUp', // Animate.css class names
        easing: 'swing', // unavailable - no need
        speed: 500 // opening & closing animation speed
    };
    $.sanga.texts = {
        en: {
            and: 'and',
            click2change: 'Click to change',
            click2remove: 'Click to remove',
            contains: 'contains',
            not: 'not',
            or: 'or',
            save: 'Save'
        },
        hu: {
            and: 'és',
            click2change: 'Kattints a módosításhoz!',
            click2remove: 'Kattints az eltávolításhoz!',
            contains: 'tartalmazza',
            not: 'nem',
            or: 'vagy',
            save: 'Mentés'
        }
    };
    $.sanga.lang = 'hu';

    $('#quickterm').autocomplete({
        minLength: 2,
        html: true,
        source: $('#qForm').attr('action'),
        focus: function () {
            // prevent value inserted on focus
            return false;
        },
        select: function (event, ui) {
            //when we select something from the dropdown
            this.value = ui.item.label.replace(/(<([^>]+)>)/gi, ''); //remove highlight html code
            var controller;
            if (ui.item.value.search(/g/) === 0) {
                controller = 'Groups';
            } else if (ui.item.value.search(/s/) === 0) {
                controller = 'Skills';
            } else {
                controller = 'Contacts';
            }
            var url = $('#qForm').attr('action').replace(/Search\/quicksearch/i, controller + '/view/');
            url = url + ui.item.value.substring(1);
            $(location).attr('href', url);
            return false;
        }
    });
});

$(document).ready(function () {
/*    if ($(window).width() <= 940) {
        $('nav.primary ul li ').click(function () {
            $('nav.primary ul > li ul li').toggle();
            icon = $(this).find('');
            icon.toggleClass('fa-angle-up fa-angle-down');
        });
    }*/
});

$(window).resize(function () {
    if ($(window).width() >= 940) {
        $('.none_menu').fadeIn();
        $('.side-nav').fadeIn();
        $('.sidebar-wrapper').fadeIn();
    } else {
        $('.none_menu').hide();
        $('.side-nav').hide();
        $('.sidebar-wrapper').hide();
    }
});
