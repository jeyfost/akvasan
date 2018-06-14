function edit() {
    const id = $("#manufacturerSelect").val();
    const name = $("#manufacturerInput").val();

    if(id !== "") {
        if(name !== "") {
            $.ajax({
                type: "POST",
                data: {
                    "id": id,
                    "name": name
                },
                url: "/scripts/admin/manufacturers/ajaxEditManufacturer.php",
                beforeSend: function() {
                    $.notify("Производитель обновляется...", "info");
                },
                success: function (response) {
                    switch (response) {
                        case "ok":
                            $.notify("Производитель успешно обновлён.", "success");
                            setTimeout(function () {
                                window.location.href = "/admin/manufacturers/?id=" + id;
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("Во время обновления производителя произошла ошибка. Поробуйте снова.", "error");
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
    } else {
        $.notify("Вы не выбрали производителя.", "error");
    }
}

function deleteManufacturer() {
    if(confirm("Вы действительно хотите удалить этого производителя? Производитель будет удалён у всех смесителей, где именно он указан. Такие смесители нельзя будет отсортировать по производителю.")) {
        const id = $("#manufacturerSelect").val();

        if(id !== '') {
            $.ajax({
                type: "POST",
                data: {"id": id},
                url: "/scripts/admin/manufacturers/ajaxDeleteManufacturer.php",
                beforeSend: function () {
                    $.notify("Производитель удаляется...", "info");
                },
                success: function (response) {
                    switch(response) {
                        case "ok":
                            $.notify("Производитель был успешно удалён.", "success");
                            setTimeout(function () {
                                window.location.href = "/admin/manufacturers";
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("При удалении производителя произошла ошибка. Попробуйте снова.", "error");
                            break;
                        default:
                            $.notify(response, "warn");
                            break;
                    }
                }
            });
        } else {
            $.notify("Вы не выбрали производителя.", "error");
        }
    }
}