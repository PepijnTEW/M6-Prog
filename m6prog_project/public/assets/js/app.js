let searchFormulier = document.getElementById("searchForm");

searchFormulier.addEventListener("submit", (event) => {
    searchPersoon(event);
});

function searchPersoon(event) {
    event.preventDefault();
    let form = event.target;
    const data = new FormData(form);
    let url = "searchNaw.php?search="+data.get("searchPersoon");
    console.log(url);

    fetch(url)
    .then(async (response)=>{
        console.log(response);
        let json = await response.json();
        console.log(json);
        showPersoon(json);
    });
}
function showPersoon(json){
    let person = json[0];
    document.getElementById("naam").textContent = person.naam;
    document.getElementById("id").textContent = person.id;
    document.getElementById("huisnummer").textContent = person.huisnummer;
    document.getElementById("postcode").textContent = person.postcode;
    document.getElementById("email").textContent = person.email;
}