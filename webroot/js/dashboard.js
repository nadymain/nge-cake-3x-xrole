$(function() {
    // topbar dropdown
    $(document).on('click', '.topbar_dropdown>a', function (e) {
        e.preventDefault();
    });
    $(document).on('click', '.topbar_dropdown', function (e) {
        e.stopPropagation();
        $(".topbar_dropdown").not(this).removeClass("active");
        $(this).toggleClass("active");
    });
    $(document).click(function () {
        $(".topbar_dropdown").removeClass("active");
    });
    // menu slide
    $('.topbar_menu').click(function (e) {
        e.preventDefault();
        $('.topbar_menu-a').toggleClass('active');
        if ($(window).outerWidth() <= 768) {
            $('body').toggleClass('menu_on');
            $('body').removeClass('menu_off');
            if ($('body').hasClass('menu_on')) {
                $('.menu').animate({
                    'left': '0'
                }, 'fast')
            } else {
                $('.menu').animate({
                    'left': '-10rem'
                }, 'fast', function () {
                    $(this).removeAttr('style')
                })
            }
        } else {
            $('body').toggleClass('menu_off');
            $('body').removeClass('menu_on');
            if ($('body').hasClass('menu_off')) {
                $('.menu').animate({
                    'left': '-10rem'
                }, 'fast');
                $('.main').animate({
                    'margin-left': '0'
                }, 'fast')
            } else {
                $('.menu').animate({
                    'left': '0'
                }, 'fast', function () {
                    $(this).removeAttr('style')
                });
                $('.main').animate({
                    'margin-left': '10rem'
                }, 'fast', function () {
                    $(this).removeAttr('style')
                })
            }
        }
    });
});
