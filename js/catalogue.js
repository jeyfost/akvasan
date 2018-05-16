$(window).on("load", function() {
    tableResize();
});

$(window).on("resize", function () {
    tableResize();
});

function tableResize() {
    if($("table").is(".propertiesTable")) {
        if($(window).width() >= 1200) {
            $(".propertiesTable").width(parseInt($(".catalogueContent").width() - $('.goodPhoto').width() - 20));
        } else {
            $(".goodProperties").css("float", "none");
            $(".goodProperties").css("margin-top", "20px");
            $(".goodProperties").css("width", "100%");
            $(".propertiesTable").css("width", "100%");
        }
    }
}

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

function pageBlock(action, block, text) {
    if(action === 1) {
        document.getElementById(block).style.backgroundColor = "#54a9fc";
        document.getElementById(text).style.color = "#fff";
    } else {
        document.getElementById(block).style.backgroundColor = "transparent";
        document.getElementById(text).style.color = "#000";
    }
}