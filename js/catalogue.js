function catalogueMenu(action, id, text) {
    if($("#" + id).attr("class") !== "tdActive") {
        if(action === 1) {
            $("#" + id).css("background-color", "#f5f5f5");
            $("#" + text).css("color", "#54a9fc");
        } else {
            $("#" + id).css("background-color", "#fff");
            $("#" + text).css("color", "#000");
        }
    }
}