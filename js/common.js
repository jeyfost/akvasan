$(window).on("load", function() {
    initialise();
});

$(window).on("resize", function () {
    initialise()
});

$(window).on("scroll", function () {
    if($(window).scrollTop() > 45 && $('.topMenu').attr("name") !== "fixed") {
        $(".topMenu").attr("name", "fixed");

        $(".topMenu").css("position", "fixed");
        $(".topMenu").css("top", "-1000px");
        $(".topMenu").css("left", "0");
        $(".topMenu").css("opacity", "0");
        $(".topMenu").css("z-index", "201");
        $(".topMenu").css("transition", ".3s");
        $(".topMenu").css("box-shadow", "0 5px 6px -4px rgba(0, 0, 0, 0.17)");

        setTimeout(function () {
            $(".topMenu").css("top", "0");
            $(".topMenu").css("opacity", "1");
        }, 1);
    }

    if($(window).scrollTop() <= 45) {
        $(".topMenu").attr("name", "");

        $(".topMenu").css("position", "relative");
        $(".topMenu").css("z-index", "1");
        $(".topMenu").css("box-shadow", "none");
    }

    scrollFunction();
});

$(document).on("mouseup", function (e) {
    const container = $(".mobileMenu");
    if (container.has(e.target).length === 0){
        container.hide('fast');
    }

    const sl = $(".searchList");
    if (sl.has(e.target).length === 0){
        sl.hide('fast');
    }
});

$(document).on("keyup", function(e) {
    if (e.keyCode === 27) {
        hideSearch();
    }
});

function initialise() {
    $("#searchInput").width(parseInt($("#searchSection").width() - 10));

    $(".searchList").width(parseInt($("#searchInput").width() - 10));
    $(".searchList").offset({top: parseInt($("#searchInput").offset().top + 40), left: $("#searchInput").offset().left});
}

function menuPoint(container, line, action) {
    if(action === 1) {
        $("#" + line).css("background-color", "#fff");
        $("#" + container).css("background-color", "#9ecfff");
    } else {
        $("#" + line).css("background-color", "transparent");
        $("#" + container).css("background-color", "transparent");
    }
}

function showMobileMenu() {
    $('.mobileMenu').css("display", "block");

    setTimeout(function () {
        $('.mobileMenu').css("top", "45px");
        $('.mobileMenu').css("z-index", "202");
    }, 1);
}

function closeMobileMenu() {
    $('.mobileMenu').css("top", "-1000px");

    setTimeout(function () {
        $('.mobileMenu').css("display", "none");
        $('.mobileMenu').css("z-index", "1");
    }, 300);
}

function siteSearch() {
    const query = $("#searchInput").val();

    if(query !== "Поиск...") {
        if(query.length > 1) {
            $.ajax({
                type: "POST",
                data: {"query": query},
                url: "/scripts/ajaxSearch.php",
                success: function (response) {
                    $(".searchList").html(response);

                    if($(".searchList").css("display") === "none") {
                        $(".searchList").css("display", "block");
                    }
                }
            });
        } else {
            hideSearch();
        }
    }
}

function hideSearch() {
    $(".searchList").hide("300");

    setTimeout(function () {
        $(".searchList").html("");
    }, 300);
}

function scrollToTop() {
    $('html, body').animate({scrollTop: 0}, 500);
}

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        $("#scroll").fadeIn(200);
    } else {
        $("#scroll").fadeOut(200);
    }
}

$(function() {
    $("body").css({padding:0,margin:0});

    const f = function() {
        $(".ndra-container").css({position:"relative"});

        const h1 = $("body").height();
        const h2 = $(window).height();
        const d = h2 - h1;
        const ruler = $("<div>").appendTo(".ndra-container");

        let h = $(".ndra-container").height() + d;

        h = Math.max(ruler.position().top, h);

        ruler.remove();

        $(".ndra-container").height(h);
    };

    setInterval(f, 1000);

    $(window).resize(f);

    f();
});