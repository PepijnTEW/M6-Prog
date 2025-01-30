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
    .then(response => response.json())
    .then(data => {
        console.log("Upload success:", data);
        alert("File uploaded successfully!");
    })
    .catch(error => {
        console.error("Error:", error);
        alert("File upload failed!");
    });
}