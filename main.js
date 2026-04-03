// Filter by Category
const all = document.querySelector("#all");
const historic = document.querySelector("#historic");
const museum = document.querySelector("#museum");
const park = document.querySelector("#park");
const market = document.querySelector("#market");

// this is the cards
const museums = document.querySelectorAll(".museum");
const historics = document.querySelectorAll(".historic");
const markets = document.querySelectorAll(".markets");
const parks = document.querySelectorAll(".park");

let counter = 0;

function categoryFilter(category) {
    category.addEventListener("click", () =>{
        if(counter) {
            const selected = document.getElementById("selected");
            selected.id = `none${counter}`;
        }
        category.id = "selected";
        counter++;

        if (category == all) {
            for(let item of museums) item.style.display = "flex";
            for(let item of historics) item.style.display = "flex";
            for(let item of markets) item.style.display = "flex";
            for(let item of parks) item.style.display = "flex";
        }else if (category == historic) {
            for(let item of museums) item.style.display = "none";
            for(let item of historics) item.style.display = "flex";
            for(let item of markets) item.style.display = "none";
            for(let item of parks) item.style.display = "none";
        }else if (category == museum) {
            for(let item of museums) item.style.display = "flex";
            for(let item of historics) item.style.display = "none";
            for(let item of markets) item.style.display = "none";
            for(let item of parks) item.style.display = "none";
        }else if (category == park) {
            for(let item of museums) item.style.display = "none";
            for(let item of historics) item.style.display = "none";
            for(let item of markets) item.style.display = "none";
            for(let item of parks) item.style.display = "flex";
        }else if (category == market) {
            for(let item of museums) item.style.display = "none";
            for(let item of historics) item.style.display = "none";
            for(let item of markets) item.style.display = "flex";
            for(let item of parks) item.style.display = "none";
        }

    });
}


categoryFilter(all);
categoryFilter(historic);
categoryFilter(museum);
categoryFilter(park);
categoryFilter(market);