"use strict";
let getForm = document.getElementById('getForm');
let postForm = document.getElementById('postForm');

getForm.addEventListener("submit", (event) => {
    event.preventDefault();
    toPhpWithGet(event);
});

postForm.addEventListener("submit", (event) => {
    event.preventDefault();
    toPhpWithPost(event);
})

function toPhpWithGet(event) {
    let form = event.target;
    const data = new FormData(form);

    console.log(data.get("article"));
    console.log(data.get("maxPrice"));

    let url = "fetchGet.php?article=" + data.get("article") + "&maxPrice=" + data.get("maxPrice");
    fetch(url)
        .then((response) => {
            console.log(response);
        });
}
function toPhpWithPost(event) {
    let form = event.target;
    let jsonform = FromToDictionary(form);
    console.log(jsonform);
    
    let options = 
    {
        method: "POST",
        cache: "no-cache",
        headers: { "Content-Type": "application/json"},
        body: JSON.stringify(jsonform)
    }
    fetch("fetchPost.php",options)
    .then(async (response)=>
    {
        console.log(response);
    });
    console.log(options);
}
function FromToDictionary(form) {
    const data = new FormData(form);
    let formKeyValue = {};
    for (const [name, value] of data) {
        formKeyValue[name] = value;
    } return formKeyValue;
}