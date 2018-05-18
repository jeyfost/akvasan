function edit() {
    const id = $("#propertySelect").val();
    const name = $("#propertyInput").val();

    if(id !== "") {
        if(name !== "") {
            $.ajax({
                type: "POST",
                data: {
                    "id": id,
                    "name": name
                },
                url: "/scripts/admin/properties/ajaxEditProperty.php",
                beforeSend: function() {
                    $.notify("Характеристика обновляется...", "info");
                },
                success: function (response) {
                    switch (response) {
                        case "ok":
                            $.notify("Характеристика успешно обновлена.", "success");
                            setTimeout(function () {
                                window.location.href = "/admin/properties/?id=" + id;
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("Во время обновления характеристики произошла ошибка. Поробуйте снова.", "error");
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
    } else {
        $.notify("Вы не выбрали характеристику.", "error");
    }
}