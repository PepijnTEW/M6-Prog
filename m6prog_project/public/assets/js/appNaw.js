const nawForm = document.getElementById("nawForm");

nawForm.addEventListener("submit", (event) => {
    event.preventDefault();
    addPerson(event);
})

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

function addPerson(event){
    let form = event.target;
    let jsonForm = FormToDictionary(form);
    console.log(jsonForm);

    let options = {
        method: "POST",
        cache: "no-cache",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(jsonForm)
    }

    fetch("nawOpslaan.php",options)
    .then(async(response)=>
    {
        console.log(response);
        let json = await response.json();
        console.log(json);
    });
}

fetch("nawopslaan.php", options)
    .then(response => response.json())
    .then(data => {
        if (false === data.success) {
            alert('niet goed');
            return false;
        }
        console.log( 'Je data is toegevoegd met id:' + data.id );
    })
    .catch(error => console.error(error));