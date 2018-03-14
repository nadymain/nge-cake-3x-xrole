$(function() {
    // topbar dropdown
    $(document).on('click', '.dropdown>a', function (e) {
        e.preventDefault();
    });
    $(document).on('click', '.dropdown', function (e) {
        e.stopPropagation();
        $(".dropdown").not(this).removeClass("active");
        $(this).toggleClass("active");
    });
    $(document).click(function () {
        $(".dropdown").removeClass("active");
    });
    
    // navmenu btn toggle
	$('.navmenu_btn').click(function (e) {
		e.preventDefault();
		$('.navmenu_btn').toggleClass('active');
		$('.navmenu').toggleClass('show');
    });
});
