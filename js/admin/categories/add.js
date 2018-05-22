function addCategory() {
    const name = $("#categoryNameInput").val();
    const url = $("#categoryURLInput").val();

    if(name !== "") {
        if(url !== "") {
            $.ajax({
                type: "POST",
                data: {
                    "name": name,
                    "url": url
                },
                url: "/scripts/admin/categories/ajaxAddCategory.php",
                beforeSend: function () {
                    $.notify("Раздел добавляется...", "info");
                },
                success: function (response) {
                    switch(response) {
                        case "ok":
                            $.notify("Раздел успешно добавлен.", "success");

                            setTimeout(function () {
                                window.location.href = "/admin/categories";
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("Во время добавления раздела произошла ошибка. Попробуйте снова.", "error");
                            break;
                        case "name duplicate":
                            $.notify("Раздел с таким названием уже существует.", "error");
                            break;
                        case "url format":
                            $.notify("Идентификатор не может состоять из одних цифр.", "error");
                            break;
                        case "url duplicate":
                            $.notify("Раздел с таким идентификатором уже существует.", "error");
                            break;
                        default:
                            $.notify(response, "warn");
                            break;
                    }
                }
            });
        } else {
            $.notify("Вы не ввели идентификатор раздела.", "error");
        }
    } else {
        $.notify("Вы не ввели название раздела.", "error");
    }
}

function addSubcategory() {
    const category = $("#categorySelect").val();
    const name = $("#subcategoryNameInput").val();
    const url = $("#subcategoryURLInput").val();

    if(name !== "") {
        if(url !== "") {
            $.ajax({
                type: "POST",
                data: {
                    "id": category,
                    "name": name,
                    "url": url
                },
                src: "/scripts/admin/categories/ajaxAddSubcategory.php",
                beforeSend: function () {
                    $.notify("Подраздел добавляется...", "info");
                },
                success: function (response) {
                    switch(response) {
                        case "ok":
                            $.notify("Подраздел успешно добавлен.", "success");

                            setTimeout(function () {
                                window.location.href = "/admin/categories";
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("Во время добавления подраздела произошла ошибка. Попробуйте снова.", "error");
                            break;
                        case "name duplicate":
                            $.notify("Подраздел с таким названием уже существует в выбранном разделе.", "error");
                            break;
                        case "url format":
                            $.notify("Идентификатор не может состоять из одних цифр.", "error");
                            break;
                        case "url duplicate":
                            $.notify("Подраздел с таким идентификатором уже существует.", "error");
                            break;
                        default:
                            $.notify(response, "warn");
                            break;
                    }
                }
            });
        } else {
            $.notify("Вы не ввели идентификатор подраздела.", "error");
        }
    } else {
        $.notify("Вы не ввели название подраздела.", "error");
    }
}