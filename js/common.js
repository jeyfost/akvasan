$(window).on("load", function() {
    $(".search").width(parseInt($("#searchSection").width() - 10));
});

$(window).on("resize", function () {
    $(".search").width(parseInt($("#searchSection").width() - 10));
});

$(window).on("scroll", function () {
    if($(window).scrollTop() > 45 && $('.topMenu').attr("name") !== "fixed") {
        $(".topMenu").attr("name", "fixed");

        $(".topMenu").css("position", "fixed");
        $(".topMenu").css("top", "-1000px");
        $(".topMenu").css("left", "0");
        $(".topMenu").css("z-index", "201");
        $(".topMenu").css("transition", ".3s");
        $(".topMenu").css("box-shadow", "0 5px 6px -4px rgba(0, 0, 0, 0.17)");

        setTimeout(function () {
            $(".topMenu").css("top", "0");
        }, 1);
    }

    if($(window).scrollTop() <= 45) {
        $(".topMenu").attr("name", "");

        $(".topMenu").css("position", "relative");
        $(".topMenu").css("z-index", "1");
        $(".topMenu").css("box-shadow", "none");
    }
});

$(document).on("mouseup", function (e) {
    const container = $(".mobileMenu");
    if (container.has(e.target).length === 0){
        container.hide('fast');
    }
});

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