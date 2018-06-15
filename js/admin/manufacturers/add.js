function add() {
    const name = $("#manufacturerInput").val();

    if(name !== "") {
        $.ajax({
            type: "POST",
            data: {"name": name},
            url: "/scripts/admin/manufacturers/ajaxAddManufacturer.php",
            beforeSend: function () {
                $.notify("Производитель добавляется...", "info");
            },
            success: function (response) {
                switch(response) {
                    case "ok":
                        $.notify("Производитель был успешно добавлен.", "success");
                        setTimeout(function () {
                            window.location.href = "/admin/manufacturers/add.php";
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("Во время добавления производителя произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "duplicate":
                        $.notify("Такой производитель уже существует.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    } else {
        $.notify("Вы не ввели название производителя.", "error");
    }
}