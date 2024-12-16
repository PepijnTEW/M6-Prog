"use strict";
let getForm = document.getElementById('getForm');

getForm.addEventListener("submit", (event) => {
    event.preventDefault();
    toPhpWithGet(event);
});

function toPhpWithGet() {
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

