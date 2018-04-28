function menuPoint(container, line, action) {
    if(action === 1) {
        $("#" + line).css("background-color", "#fff");
        $("#" + container).css("background-color", "#9ecfff");
    } else {
        $("#" + line).css("background-color", "transparent");
        $("#" + container).css("background-color", "#54a9fc");
    }
}