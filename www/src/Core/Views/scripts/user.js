import CharacterCart from "./CharacterCart.js";
$(() => {
    $.ajax({
        type: "GET",
        url: "/user/command",
        success: function (res) {
            console.log(res);
            const demoCharacter = new CharacterCart("Human", "John", "Male", 18);
            demoCharacter.createDOM("#character_list")
            //let data = JSON.parse(res);
            //console.log(data);
            //$("#menu-header").html(data.header);
            //$("#main_content").html(data.main);
            //sessionStorage.clear();
        },
        error: function(data) {
            console.log(data);
        }
    });
});