<div>
    <form id="form-login" action="/authOk" method="post">
        <input type="text" placeholder="name" name="name" />
        <input type="password" placeholder="password" name="password" />
        <input type="submit" value="send" />
    </form>
</div>

<script>
    // Шлем тестовыый запрос к себе же
    $(() => {
        $("#form-login").submit(function (e) { // Устанавливаем событие отправки для формы с id=form
            e.preventDefault();
            const form_data = $(this).serialize(); // Собираем все данные из формы
            $.ajax({
                type: "POST", // Метод отправки
                url: "/auth", // Путь до php файла отправителя
                data: form_data,
                success: function (res) {
                    // Код в этом блоке выполняется при успешной отправке сообщения
                    let data = JSON.parse(res)
                    console.log(data);
                    $("#menu-header").html(data.header);
                    $("#main_content").html(data.main);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>