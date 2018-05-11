function sendReview() {
    const inst = $('[data-remodal-id=modal]').remodal();

    const name = $('#nameInput').val();
    const email = $('#emailInput').val();
    const text = $('#textInput').val();

    const formData = new FormData($('#modalForm').get(0));

    if(name !== '') {
        if(email !== '') {
            $.ajax({
                type: "POST",
                data: {"email": email},
                url: "/scripts/ajaxEmailValidation.php",
                success: function (validity) {
                    if(validity === "ok") {
                        if(text !== '') {
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                processData: false,
                                contentType: false,
                                data: formData,
                                url: "/scripts/ajaxAddReview.php",
                                beforeSend: function () {
                                    $.notify("Ваш отзыв отправляется...", "info");
                                },
                                success: function (response) {
                                    switch(response) {
                                        case "ok":
                                            $.notify("Спасибо! Отзыв был успешно отправлен.", "success");
                                            inst.close();
                                            break;
                                        case "failed":
                                            $.notify("Во время отправления отзыва произошла ошибка. Попробуйте снова.", "error");
                                            break;
                                        default:
                                            $.notify(response, "warn");
                                            break;
                                    }
                                }
                            });
                        } else {
                            $.notify("Вы не ввели текст отзыва", "error");
                        }
                    } else {
                        $.notify("Вы ввели email неверного формата", "error");
                    }
                }
            });
        } else {
            $.notify("Вы не ввели email", "error");
        }
    } else {
        $.notify("Вы не ввели имя", "error");
    }
}