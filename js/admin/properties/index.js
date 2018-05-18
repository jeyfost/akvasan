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

function deleteProperty() {
    if(confirm("Вы действительно хотите удалить эту характеристику? Эта характеристика будет удалена у всех существующих товаров, если она в них прописана.")) {
        const id = $("#propertySelect").val();

        if(id !== '') {
            $.ajax({
                type: "POST",
                data: {"id": id},
                url: "/scripts/admin/properties/ajaxDeleteProperty.php",
                beforeSend: function () {
                    $.notify("Характиристика удаляется...", "info");
                },
                success: function (response) {
                    switch(response) {
                        case "ok":
                            $.notify("Характеристика была успешно удалена.", "success");
                            setTimeout(function () {
                                window.location.href = "/admin/properties";
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("При удалении характеристики произошла ошибка. Попробуйте снова.", "error");
                            break;
                        default:
                            $.notify(response, "warn");
                            break;
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        } else {
            $.notify("Вы не выбрали свойство.", "error");
        }
    }
}