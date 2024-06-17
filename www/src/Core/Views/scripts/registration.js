const form = document.getElementById("form__registration");
const xhr = new XMLHttpRequest();

xhr.addEventListener('readystatechange', () => {
    if (xhr.readyState === xhr.DONE) {
        console.log(xhr.response);
        const data = JSON.parse(xhr.response);
        console.log(data);
        if (data.success === true) {
            $("#menu-header").html(data?.pageData?.header);
            $("#main_content").html(data?.pageData?.main);
        }
    }
})

form.addEventListener("submit", (e) => {
    e.preventDefault();

    let formData = new FormData(form);

    xhr.open('POST', '/registration/send');
    xhr.send(formData);


    /*fetch("/registration/send", {
        method: "post",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        //make sure to serialize your JSON body
        body: JSON.stringify({
            name: "myName",
            password: "myPassword"
        })
    }).then(
            function(response) {
                if (response.status !== 200) {
                    console.log('Looks like there was a problem. Status Code: ' +
                        response.status);
                    return;
                }

                // Examine the text in the response
                response.json().then(function(data) {
                    console.log(data);
                });
            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });



    $.ajax({
        type: "POST",
        url: "/registration/send",
        data: {id:1},
        success: function (res) {
            console.log(res)
        },
        error: function(data) {
            console.log(data);
        }
    });
    */
});