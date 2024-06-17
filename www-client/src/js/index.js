import example from './../img/grass.png';
import styles from './../styles/main.scss';

import  axios from 'axios';
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

function getPromise(URL) {
    let promise = new Promise(function (resolve, reject) {
        $.ajax({
            headers: {
                'Authorization': 'Basic bWlraGFpbDoxMjM0NTY='
            },
            url: URL, //'http://127.0.0.1:81/api/data',
            type: 'GET',
            dataType: 'json',
            success: function(results){
                let data = JSON.parse(results);
                resolve(data);
            },
            error: function (jqXHR, exception) {
                let msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                //$('#post').html(msg);
                reject(msg);
            },
        });
    });
    return promise;
}

function getData(ajaxurl) {
    return $.ajax({
        headers: {
            'Authorization': 'Basic bWlraGFpbDoxMjM0NTY='
        },
        url: ajaxurl,
        type: 'GET',
        dataType: 'json',
    });
};

function makeRequest(method, url) {
    return new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open(method, url);
        xhr.setRequestHeader('Authorization','Basic bWlraGFpbDoxMjM0NTY=');
        xhr.responseType = 'json';
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                resolve(xhr.response);
            } else {
                reject({
                    status: this.status,
                    statusText: xhr.statusText
                });
            }
        };
        xhr.onerror = function () {
            reject({
                status: this.status,
                statusText: xhr.statusText
            });
        };
        xhr.send();
    });
};

async function test() {
    try {
        const data = await getPromise("http://127.0.0.1:81/api/data");
        let oneResult = data[0];
        await console.log(oneResult);

        const res = await getData('http://127.0.0.1:81/api/data');
        await console.log(JSON.parse(res));

        //const resAxios = getDataAxios();
        //await console.log(resAxios);

        let sendInfo = await axios.get("http://127.0.0.1:81/api/data", {
            headers: { Authorization: 'Basic bWlraGFpbDoxMjM0NTY='}
        })

        let dataAxios = sendInfo.data
        await console.log(JSON.parse(dataAxios));

        let xhr = await makeRequest("GET", "http://127.0.0.1:81/api/data");
        await console.log(JSON.parse(xhr));



    } catch (err) {
        console.log(err);
    }
}

$(document).ready(function() {
    $('h2').html("Измененный заголовок");

        test();

        //const DATA = 'http://127.0.0.1:81/api/data';
        //let promise = getPromise(DATA);

        //promise.then(result => {
        //    console.log(result)
        //    let oneResult = result[0];
        //    return oneResult;
        //}).then(oneResultData => {
         //   console.log(oneResultData);
        //})
    $("#submit").click(function () {
        let username = $("#username").val();
        let password = $("#password").val();
        $.post(
            "/login",
            { username: username, password: password },
            function (data) {
                if (data === "success") {
                    window.location.href = "/";
                }
            }
        );
    });
});


// создание свойства класса без конструктора
class Game {
    name = 'Violin Charades'
}
const myGame = new Game()

// создаем параграф
const p = document.createElement('p')
p.textContent = `I like ${myGame.game}.`

// создаем элемент заголовка
const heading = document.createElement('h5')
heading.textContent = 'Как интересно!'

// добавляем заголовок в DOM
const root = document.querySelector('#root')
root.append(heading)