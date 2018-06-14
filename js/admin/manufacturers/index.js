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