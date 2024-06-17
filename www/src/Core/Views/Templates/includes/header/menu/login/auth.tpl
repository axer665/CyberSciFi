<div class="menu-header-user">
    <div class="menu-header-login">
        <a> user </a>
    </div>
    <div class="menu-header-logout">
        <a> logout </a>
    </div>
</div>

<script>
    $(() => {
        $(".menu-header-logout").on("click", function (e) {
            $.ajax({
                type: "GET",
                url: "/logout",
                success: function (res) {
                    let data = JSON.parse(res);
                    $("#menu-header").html(data.header);
                    $("#main_content").html(data.main);
                    sessionStorage.clear();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>