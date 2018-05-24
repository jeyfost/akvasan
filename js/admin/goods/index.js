function loadGoodText(id) {
    $.ajax({
        type: "POST",
        data: {"id": id},
        url: "/scripts/admin/goods/ajaxLoadGoodText.php",
        success: function (response) {
            CKEDITOR.instances["textInput"].setData(response);
        }
    });
}

function editGood() {
    const category = $("#categorySelect").val();
    const subcategory = $("#subcategorySelect").val();
    const good = $("#goodSelect").val();
    const name = $("#nameInput").val();
    const url = $("#urlInput").val();
    const price = $("#priceInput").val();
    const code = $("#codeInput").val();
    const checkboxes = document.getElementsByClassName("checkbox");
    const inputs = document.getElementsByClassName("propertyInput");
    const text = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;
    const formData = new FormData($('#goodForm').get(0));

    var propertyID = [];
    var propertyValue = [];

    var j = 0;
    var countID = 0;
    var countValue = 0;

    if(checkboxes.length > 0) {
        for(var i = 0; i < checkboxes.length; i++) {
            if(checkboxes[i].checked) {
                propertyID[j] = checkboxes[i].getAttribute("id").substr(8);
                countID++;

                var inputID = inputs[i].getAttribute("id");

                if($('#' + inputID).val() !== "") {
                    propertyValue[j] = $("#" + inputID).val();
                    countValue++;
                }

                j++;
            }
        }
    }

    formData.append("text", text);
    formData.append("propertyID", propertyID);
    formData.append("propertyValue", propertyValue);

    if(countID > 0) {
        if(countID == countValue) {
            if(name !== "") {
                if(url !== "") {
                    if(price !== "") {
                        if(code !== "") {
                            if(text !== "" && text !== "<p><br></p>") {
                                $.ajax({
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    dataType: "json",
                                    url: "/scripts/admin/goods/ajaxEditGood.php",
                                    beforeSend: function () {
                                        $.notify("Товар обновляется...", "info");
                                    },
                                    success: function(response) {
                                        switch (response) {
                                            case "ok":
                                                $.notify("Товар был успешно отредактирован.", "success");

                                                setTimeout(function () {
                                                    window.location.href = "/admin/goods/?c=" + category + "&s=" + subcategory + "&id=" + good;
                                                }, 2000);
                                                break;
                                            case "failed":
                                                $.notify("Во время добавления товара произошла ошибка. Попробуйте снова.", "error");
                                                break;
                                            case "name duplicate":
                                                $.notify("Такое название товара уже существует в выбранном подразделе.", "error");
                                                break;
                                            case "url duplicate":
                                                $.notify("Такой идентификатор товара уже существует.", "error");
                                                break;
                                            case "url format":
                                                $.notify("Идентификатор не может состоять из одних цифр.", "error");
                                                break;
                                            case "preview":
                                                $.notify("Выбранная фотография товара имеет недопустимый формат.", "error");
                                                break;
                                            case "preview upload":
                                                $.notify("Во время загрузки фотографии товара произошла ошибка. Попробуйте снова.", "error");
                                                break;
                                            case "photos":
                                                $.notify("Одна или несколько дополнительных фотографий имеют недопустимый формат.", "error");
                                                break;
                                            case "photos upload":
                                                $.notify("Некоторые дополнительные фотографии не были загружены.", "error");
                                                break;
                                            case "code":
                                                $.notify("Введённый вами артикул уже существует.", "error");
                                                break;
                                            default:
                                                $.notify(response, "warn");
                                                break;
                                        }
                                    }
                                });
                            } else {
                                $.notify("Вы не ввели краткое описание товара.", "error");
                            }
                        } else {
                            $.notify("Вы не ввели код товара.", "error");
                        }
                    } else {
                        $.notify("Вы не ввели цену товара.", "error");
                    }
                } else {
                    $.notify("Вы не ввели идентификатор товара.", "error");
                }
            } else {
                $.notify("Вы не ввели название товара.", "error");
            }
        } else {
            $.notify("Значения некоторых выбранных характеристик товара пусты. Заполните значения всех выбранных характеристик.", "error");
        }
    } else {
        $.notify("Вы не выбрали ни одной характеристики товара. Выберите хотя бы одну.", "error");
    }
}

function deleteGoodPhoto(id, goodID) {
    if(confirm("Вы действительно хотите удалить фотографию?")) {
        $.ajax({
            type: "POST",
            data: {"id": id},
            url: "/scripts/admin/goods/ajaxDeletePhoto.php",
            beforeSend: function () {
                $.notify("Фотография удаляется...", "info");
            },
            success: function (response) {
                switch (response) {
                    case "ok":
                        $.notify("Фотография была успешно удалена.", "success");

                        $.ajax({
                            type: "POST",
                            data: {"id": goodID},
                            url: "/scripts/admin/goods/ajaxReloadPhotosContainer.php",
                            success: function (photos) {
                                $(".goodPhotos").css("opacity", 0);

                                setTimeout(function () {
                                    $(".goodPhotos").html(photos);
                                    $(".goodPhotos").css("opacity", 1);
                                }, 300);
                            }
                        });
                        break;
                    case "failed":
                        $.notify("Во время удаления фотографии произошла ошибка. Попробуйте снова.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}