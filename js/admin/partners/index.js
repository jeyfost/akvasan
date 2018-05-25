function addLogo() {
    const formData = new FormData($('#partnersForm').get(0));
    const logo = $("#logoInput").val();

    if(logo !== "") {
        $.ajax({
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            url: "/scripts/admin/partners/addLogo.php",
            beforeSend: function () {
                $.notify("Логотипы добавляются...", "info");
            },
            success: function (response) {
                switch (response) {
                    case "ok":
                        $.notify("Логотипы были успешно добавлены.", "success");

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("При добавлении логотипов произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "empty":
                        $.notify("Вы не выбрали ни одного логотипа.", "error");
                        break;
                    case "photo":
                        $.notify("Один или несколько выбранных логотипов имеют недопустимый формат.", "error");
                        break;
                    case "partly":
                        $.notify("Не все логотипы были загружены.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    } else {
        $.notify("Вы не выбрали ни одного логотипа.", "error");
    }
}