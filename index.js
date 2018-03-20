$(document).ready(function() {

    //animate arrow for menu//

    $("#menuarrow").click(function() {

        $("#weblinks").animate({
            width: "toggle"
        }, 600);
    });

    //quick scroll to div on page//

    $('a[href^="#"]').click(function () {
        var target = this.hash,
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 100
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
        return false;
    });

    //autohide navbar at certain width//

    var $window = $(window);

    function checkWidth() {
        var windowsize = $window.width();
        if(windowsize <= 768) {
            $(".navbar-fixed-top").autoHidingNavbar();
        } else {
            $(".navbar-fixed-top").autoHidingNavbar("setDisableAutohide", true);
            $(".navbar-fixed-top").autoHidingNavbar("show");
        }
    }

    checkWidth();

    $(window).resize(checkWidth);

    //font grow when mouse on project boxes//

    $(".projectbox").mouseenter(function() {
        $(this).animate({
          fontSize: "1.2em"
        }, 350);
    });

    $(".projectbox").mouseleave(function() {
        $(this).animate({
          fontSize: "1em"
        }, 350);
    });

    //highlight project boxes when clicked//

    $(".projectbox").click(function () {
        $(this).effect("highlight", {color: "#1671b2"}, 500);

        //delay link open//

        var href = $(this).closest("a").attr("href");
        setTimeout(function() {window.location.href = href}, 600);
        return false;
    });

    //strong ext links on hover//

    $("#menuarrow").mouseenter(function() {
        $(this).animate({
          opacity: 1
        }, 200);
    });

    $("#menuarrow").mouseleave(function() {
        $(this).animate({
          opacity: 0.8
        }, 200);
    });

    $(".extlogos img").mouseenter(function() {
        $(this).animate({
          opacity: 1
        }, 200);
    });

    $(".extlogos img").mouseleave(function() {
        $(this).animate({
          opacity: 0.8
        }, 200);
    });

    $(".contactlink").mouseenter(function() {
        $(this).animate({
          opacity: 1
        }, 200);

    });

    $(".contactlink").mouseleave(function() {
        $(this).animate({
          opacity: 0.8
        }, 200);
    });

    //fade ext links when clicked//

    $(".extlogos img").click(function() {
        $(this).effect("fade", 300);

        //delay link open//

        var href = $(this).closest("a").attr("href");
        setTimeout(function() {window.location.href = href}, 300);
        return false;
    });

    $(".contactlink").click(function() {
        $(this).effect("fade", 300);

        //delay link open//

        var href = $(this).closest("a").attr('href');
        setTimeout(function() {window.location.href = href}, 300);
        return false;
    });

});
