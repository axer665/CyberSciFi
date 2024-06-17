import  axios from 'axios';
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

let callback = async (event) => {
    //if (!isValid) {
    event.preventDefault(); // stop form from submitting
    console.log("nice!");
    let name = $('.form-population-name')[0].value;
    let data = await $.post(
        "/users/addPopulation",
        { populationName: name},
        function (data) {
            console.log(data);
            $('#populations_list').append("<p>"+data.name+"</p>");
        }
    );

    console.log(data);
    //}
}

let form = document.getElementById("form-population");
if (form.addEventListener) {
    form.addEventListener("submit", callback, false); // Modern browsers
} else if (form.attachEvent) {
    form.attachEvent("onsubmit", callback); // old IE! WHY?!?!
}

const getRaces = async () => {
    let sendInfo = await axios.get("http://127.0.0.1:81/api/getRaces", {
        headers: { Authorization: 'Basic bWlraGFpbDoxMjM0NTY='}
    })
    let dataAxios = sendInfo.data
    let races = Object.keys(dataAxios);
    await console.log((races));

    for (let i=0; i<races.length; i++) {
        const option = document.createElement('OPTION')
        option.setAttribute("value", races[i]);
        let optionText = document.createTextNode(races[i]);
        option.appendChild(optionText);
        document.getElementById("raceList").appendChild(option);
    }
}



$(document).ready(function() {
    let formVision = () => {
        $('#form-population').css({'display': "block"});
        getRaces();
    }

    $('#form_vision').on("click", formVision);
});