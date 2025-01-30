const imgForm = document.getElementById("imageForm");

imgForm.addEventListener("submit", (event) => {
    event.preventDefault();
    uploadFormFile(event);
});

function FormToDictionary(form)
{
    const data = new FormData(form);
    let formKeyValue={};
    for (const [name,value] of data)
    {
        formKeyValue[name] = value;
    }
    return formKeyValue;
}
function uploadFormFile(event)
{
    let form = event.target;
    let options = 
    {
        method: "POST",
        body: new FormData(form)
    }

    fetch("imageRecieve.php", options)
    .then(async (response)=>
    {
        console.log(response);
        let json = await response.json();
        console.log(json);
        showLink(json);
    })
}

function showLink(json) {
    // Ensure `downloadLink` is selected correctly
    const Link = document.getElementById("link");

    if (json.downloadlink) {
        Link.setAttribute("href", json.downloadlink);
        Link.textContent = "Download File";
        Link.style.display = "block"; // Ensure the link is visible
    } else {
        Link.textContent = "No link available";
        Link.removeAttribute("href");
    }
}