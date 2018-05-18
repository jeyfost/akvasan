function add() {
    const name = $("#propertyInput").val();
    console.log(name);
    if(name !== "") {
        $.ajax({
            type: "POST",
            data: {"name": name},
            url: "/scripts/admin/properties/ajaxAddProperty.php",
            beforeSend: function () {
                $.notify("Характеристика добавляется...", "info");
            },
            success: function (response) {
                switch(response) {
                    case "ok":
                        $.notify("Характеристика была успешно добавлена.", "success");
                        setTimeout(function () {
                            window.location.href = "/admin/properties/add.php";
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("Во время добавления характеристики произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "duplicate":
                        $.notify("Такая характеристика уже существует.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    } else {
        $.notify("Вы не ввели название характеристики.", "error");
    }
}