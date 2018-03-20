$(document).ready(function() {

    //trainingbox grows when mouse on//

    $(".training-link").mouseenter(function() {
        $(".training-text").animate({
          fontSize: "13pt"
        }, 200);
        $(".training-logo").animate({
          height: "60px"
        }, 200);
    });

    $(".training-link").mouseleave(function() {
        $(".training-text").animate({
          fontSize: "12pt"
        }, 200);
        $(".training-logo").animate({
          height: "55px"
        }, 200);
    });

    //highlight trainingbox when clicked//

    $(".training-link").click(function () {
        $(".training-box").effect("highlight", {color: "#1671b2"}, 500);

        //delay link open//

        var href = $(this).attr("href");
        setTimeout(function() {window.location.href = href}, 600);
        return false;
    });

});
