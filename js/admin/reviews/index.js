function showReview(id, button) {
    var checked = 0;

    if(document.getElementById(button).checked) {
        checked = 1;
    }

    $.ajax({
        type: "POST",
        data: {
            "id": id,
            "checked": checked
        },
        url: "/scripts/admin/reviews/ajaxShowReview.php",
        success: function (response) {
            switch(response) {
                case "on":
                    $.notify("Отображение отзыва включено.", "success");
                    break;
                case "off":
                    $.notify("Отображение отзыва отключено.", "info");
                    break;
                case "failed":
                    $.notify("Произошла ошибка. Попробуйте снова.", "error");
                    break;
                default:
                    $.notify(response, "warn");
                    break;
            }
        }
    });
}

function edit(id) {
    const name = $('#nameInput').val();
    const text = $('#textInput').val();

    if(name !== '') {
        if(text !== '') {
            $.ajax({
                type: "POST",
                data: {
                    "id": id,
                    "name": name,
                    "text": text
                },
                url: "/scripts/admin/reviews/ajaxEditReview.php",
                beforeSend: function () {
                    $.notify("Данные отправлены...", "info");
                },
                success: function (response) {
                    switch(response) {
                        case "ok":
                            $.notify("Отзыв успешно изменён.", "success");
                            setTimeout(function () {
                                window.location.href = "/admin/reviews";
                            }, 2000);
                            break;
                        case "failed":
                            $.notify("Во время редактирования отзыва произошла ошибка. Попробуйте снова.", "error");
                            break;
                        default:
                            $.notify(response, "warn");
                            break;
                    }
                }
            });
        } else {
            $.notify("Вы не ввели текст отзыва.", "error");
        }
    } else {
        $.notify("Вы не ввели имя.", "error");
    }
}

function deleteReview(id) {
    if(confirm("Вы действительно хотите удалить этот отзыв?")) {
        $.ajax({
            type: "POST",
            data: {"id": id},
            url: "/scripts/admin/reviews/ajaxDeleteReview.php",
            beforeSend: function () {
                $.notify("Отзыв удаляется...", "info");
            },
            success: function(response) {
                switch(response) {
                    case "ok":
                        $.notify("Отзыв был успешно удалён", "success");
                        setTimeout(function () {
                            window.location.href = "/admin/reviews";
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("Во время удаления отзыва произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "review":
                        $.notify("Отзыва с таким идентификатором не существут.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}