/* Please ❤ this if you like it! */

(function ($) {
    "use strict";

    $(function () {
        var header = $(".start-style");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass("start-style").addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass("start-style");
            }
        });
    });

    //Animation

    $(document).ready(function () {
        $("body.hero-anime").removeClass("hero-anime");
    });

    //Menu On Hover


    // $(document).ready(function () {
    //     $("#menubtn").click(function (e) {
    //         if ($(window).width() <= 750) {
    //             $(".nav-item").toggleClass("show");
    //         }
    //     });
    // });

    $(document).ready(function () {
        // Attach click event handler to the burger icon button
        $("#menubtn").click(function () {
            // Check if the window width is less than or equal to 750 pixels (phone-sized screen)
            if ($(window).width() <= 750) {
                // Toggle the collapse class of the navigation menu
                $("#navbarSupportedContent").collapse('toggle');
            }
        });
    });
    

    //Switch light/dark

    $("#switch").on("click", function () {
        if ($("body").hasClass("dark")) {
            $("body").removeClass("dark");
            $("#switch").removeClass("switched");
        } else {
            $("body").addClass("dark");
            $("#switch").addClass("switched");
        }
    });
})(jQuery);
