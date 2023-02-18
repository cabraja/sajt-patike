$(document).ready(function (){

    // SET SEARCH RESULTS DIV HEIGHT
    const searchDiv = document.getElementById("search-container");
    const searchResults = document.getElementById("search-results");
    searchResults.style.top = searchDiv.clientHeight + 'px';

    // SEARCH FUNCTION
    $("#search-btn").on('click', function (){
        const keyword = document.getElementById("search").value;

        $.ajax({
            url: 'models/products/search.php',
            method: 'GET',
            dataType: 'json',
            data: {
                keyword: keyword
            },
            success: (res) => {
                displaySearchResults(res)
            },
            err: (error) => {
                console.log(error)
            }
        });
    })

    // SIZE PICK FUNCTION
    $(".size-div").on('click', function (event){
        console.log('yes')
    });

//     -------------------------
//     FUNCTIONS
//     -----------------------------
    const displaySearchResults = (arr) => {
        let searchDiv = document.getElementById("search-results-list");
        searchDiv.innerHTML = "";
        searchResults.style.display = "block";

        if(arr.length > 0){
            arr.forEach(item => {
                searchDiv.innerHTML += `
                <li>
                    <a class="text-dark" href="model.php?id=${item.id}">
                        <div class="py-1 d-flex flex-row justify-content-between align-items-center position-relative">
                            <div class="search-result-overlay"></div>                        
                        
                            <img height="50px" src="${item.image_url}" class="ms-2"/>
                            <h6 class="me-3">${item.model_name}</h6>
                        </div>
                    </a>
                </li>
            `;
            })
        }else{
            searchDiv.innerHTML = `
                <li class="ms-3">Nema rezultata</li>
            `;
        }
    }

});