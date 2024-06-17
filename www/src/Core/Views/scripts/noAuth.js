import {contentController, updateLogin} from "./ContentController.js";
/*const element = document.querySelector(".menu-header-login");
element.addEventListener("click", () => {
    updateLogin({
        url: "/login/auth",
        urlForBrowserHistory: "/login",
        data: {

        },
        history: "/login"
    })
})*/



$(".header-block-menu").on("click", '.menu-header-login', function (event) {

    updateLogin({
        url: "/login/auth",
        urlForBrowserHistory: "/login",
        data: {

        },
        history: "/login"
    })
});


$(".header-block-menu").on("click", '.menu-header-logout', function () {
    updateLogin({
        url: "/login/registration",
        urlForBrowserHistory: "/registration",
        data: {

        },
        history: "/registration"
    })
});
