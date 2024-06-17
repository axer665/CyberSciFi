export class contentController {
    #HEADER_LOGIN;
    #MAIN_PAGE;

    constructor() {
        return (async () => {
            // Call async functions here
            let res = await $.ajax({
                url: '/login/getDefaultPages',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    //console.log(data);
                },
            });
            this.#HEADER_LOGIN = res.login
            this.#MAIN_PAGE = res.main;
            // Constructors return `this` implicitly, but this is an IIFE, so
            // return `this` explicitly (else we'd return an empty object).
            return this;
        })();
    }

    getMainPage() {
        return this.#MAIN_PAGE;
    }
    getHeaderLoginPage() {
        return this.#HEADER_LOGIN;
    }
}

function processAjaxData(response, urlPath){
    window.history.pushState({
        "contentHeader": response.contentHeader,
        "contentMain": response.contentMain,
    },"", urlPath);
}

export const updateLogin = (params) => {
    $.ajax({
        type: "get",
        url: params.url,
        data: params.data,
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);



            //$("#block-login").html(data.header);
            $("#menu-header").html(data.header);
            $("#main_content").html(data.main);

            let page = {
                contentHeader: data.header,
                contentMain: data.main
            }

            processAjaxData(page, params.history);
        }
    });
}