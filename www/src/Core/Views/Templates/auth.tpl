<div>
    <form action="/authOk" method="post">
        <input type="text" placeholder="name" name="name" />
        <input type="password" placeholder="password" name="password" />
        <input type="submit" value="send" />
    </form>
</div>

<script type="text/javascript" src="/src/Core/Views/scripts/jquery-3.6.3.min.js"></script>
<script>
    // Шлем тестовыый запрос к себе же
    $(document).ready(function() {
        $.ajax({
            beforeSend: ((xhr) => {
                xhr.setRequestHeader('Authorization', 'Basic bWlraGFpbDoxMjM0NTY=')
            }),
            url: 'http://127.0.0.1:81/api/data',
            type: 'get',
            dataType: 'json',
            success: function(results){
                let data = JSON.parse(results);
                console.log(data);
            }
        });
    });
</script>