function edit() {
    const text = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;
    const formData = new FormData($('#textForm').get(0));
    formData.append("text", text);

    if(text !== '' && text !== '<p><br></p>') {
        $.ajax({
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            url: "/scripts/admin/text/ajaxEditText.php",
            beforeSend: function () {
                $.notify("Текст редактируется...", "info");
            },
            success: function (response) {
                switch (response) {
                    case "ok":
                        $.notify("Текст успешно изменён.", "success");
                        break;
                    case "failed":
                        $.notify("Во время редактирования текста произошла ошибка. Попробуйте снова.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    } else {
        $.notify("Вы не ввели текст.", "error");
    }
}