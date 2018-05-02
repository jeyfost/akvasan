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
        $('.mobileMenu').css("top", "0");
    }, 1);
}

function closeMobileMenu() {
    $('.mobileMenu').css("top", "-1000px");

    setTimeout(function () {
        $('.mobileMenu').css("display", "none");
    }, 300);
}