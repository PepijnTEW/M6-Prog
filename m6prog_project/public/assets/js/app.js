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
    });

}