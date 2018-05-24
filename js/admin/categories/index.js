function editCategory() {
    const id = $("#categorySelect").val();
    const name = $("#categoryNameInput").val();
    const url = $("#categoryURLInput").val();

    if(name !== "") {
        $.ajax({
            type: "POST",
            data: {
                "id": id,
                "name": name,
                "url": url
            },
            url: "/scripts/admin/categories/ajaxEditCategory.php",
            beforeSend: function () {
                $.notify("Раздел редактируется...", "info");
            },
            success: function (response) {
                switch(response) {
                    case "ok":
                        $.notify("Название раздела было успешно изменено.", "success");

                        setTimeout(function () {
                            window.location.href = "/admin/categories/?c=" + id;
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("При редактировании раздела произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "duplicate":
                        $.notify("Раздел с таким названием уже существует.", "error");
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
        $.notify("Вы не ввели название раздела.", "error");
    }
}

function editSubcategory() {
    const subcategory = $("#subcategorySelect").val();
    const category = $("#categorySelect").val();
    const name = $("#subcategoryInput").val();
    const url = $("#subcategoryURLInput").val();

    if(name !== "") {
        $.ajax({
            type: "POST",
            data: {
                "category": category,
                "subcategory": subcategory,
                "name": name,
                "url": url
            },
            url: "/scripts/admin/categories/ajaxEditSubcategory.php",
            beforeSend: function () {
                $.notify("Подраздел редактируется...", "info");
            },
            success: function (response) {
                switch(response) {
                    case "ok":
                        $.notify("Название подраздела было успешно изменено.", "success");

                        setTimeout(function () {
                            window.location.href = "/admin/categories/?c=" + category + "&s=" + subcategory;
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("При редактировании подраздела произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "duplicate":
                        $.notify("Подраздел с таким названием уже существует в выбранном разделе.", "error");
                        break;
                    case "url duplicate":
                        $.notify("Подраздел с таким идентификатором уже существует.", "error");
                        break;
                    case "url format":
                        $.notify("Идентификатор не может состоять из одних цифр.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    } else {
        $.notify("Вы не ввели название подраздела.", "error");
    }
}

function deleteCategory() {
    if(confirm("Вы действительно хотите удалить этот раздел? Раздел будет удалён вместе со всеми подразделами и товарами.")) {
        const id = $("#categorySelect").val();

        $.ajax({
            type: "POST",
            data: {"id": id},
            url: "/scripts/admin/categories/ajaxDeleteCategory.php",
            beforeSend: function () {
                $.notify("Раздел удаляется...", "info");
            },
            success: function (response) {
                switch (response) {
                    case "ok":
                        $.notify("Раздел был успешно удалён.", "success");

                        setTimeout(function () {
                            window.location.href = "/admin/categories";
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("Во время удаления раздела произошла ошибка. Попробуйте снова.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}

function deleteSubcategory() {
    if(confirm("Вы действительно хотите удалить этот подраздел? Подраздел будет удалён вместе со всеми товарами.")) {
        const id = $("#subcategorySelect").val();
        const category = $("#categorySelect").val();

        $.ajax({
            type: "POST",
            data: {"id": id},
            url: "/scripts/admin/categories/ajaxDeleteSubcategory.php",
            beforeSend: function () {
                $.notify("Подраздел удаляется...", "info");
            },
            success: function (response) {
                switch (response) {
                    case "ok":
                        $.notify("Подраздел был успешно удалён.", "success");
                        setTimeout(function () {
                            window.location.href = "/admin/categories?c=" + category;
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("Во время удаления подраздела произошла ошибка. Попробуйте снова.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}