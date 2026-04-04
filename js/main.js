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

const searchBar = document.querySelector("#searchBar");
const umayyad = document.querySelector(".umayyad");
const hamidiyya = document.querySelector(".hamidiyya");
const citadel = document.querySelector(".citadel");
const azem = document.querySelector(".azem");
const takiyya = document.querySelector(".takiyya");
const medhat = document.querySelector(".medhat");
const qasioun = document.querySelector(".qasioun");
const dna = document.querySelector(".dna");

searchBar.addEventListener("input", (event) => { //event.target.value
    if(event.target.value.toUpperCase() == "UMAYYAD MOSQUE") {
        umayyad.style.display = "flex";
        hamidiyya.style.display = "none";
        citadel.style.display = "none";
        azem.style.display = "none";
        takiyya.style.display = "none";
        dna.style.display = "none";
        medhat.style.display = "none";
        qasioun.style.display = "none";
    }else if (event.target.value.toUpperCase() == "SOUK AL-HAMIDIYYA") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "flex";
        citadel.style.display = "none";
        azem.style.display = "none";
        takiyya.style.display = "none";
        dna.style.display = "none";
        medhat.style.display = "none";
        qasioun.style.display = "none";
    }else if (event.target.value.toUpperCase() == "CITADEL OF DAMASCUS") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "none";
        citadel.style.display = "flex";
        azem.style.display = "none";
        takiyya.style.display = "none";
        dna.style.display = "none";
        medhat.style.display = "none";
        qasioun.style.display = "none";
    }else if (event.target.value.toUpperCase() == "AZEM PALACE") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "none";
        citadel.style.display = "none";
        azem.style.display = "flex";
        takiyya.style.display = "none";
        dna.style.display = "none";
        medhat.style.display = "none";
        qasioun.style.display = "none";
    }else if (event.target.value.toUpperCase() == "TAKIYYA MOSQUE COMPLEX") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "none";
        citadel.style.display = "none";
        azem.style.display = "none";
        takiyya.style.display = "flex";
        dna.style.display = "none";
        medhat.style.display = "none";
        qasioun.style.display = "none";
    }else if (event.target.value.toUpperCase() == "MIDHAT PASHA SOUQ") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "none";
        citadel.style.display = "none";
        azem.style.display = "none";
        takiyya.style.display = "none";
        dna.style.display = "none";
        medhat.style.display = "flex";
        qasioun.style.display = "none";
    }else if (event.target.value.toUpperCase() == "MOUNT QASIOUN VIEWPOINT") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "none";
        citadel.style.display = "none";
        azem.style.display = "none";
        takiyya.style.display = "none";
        dna.style.display = "none";
        medhat.style.display = "none";
        qasioun.style.display = "flex";
    }else if (event.target.value.toUpperCase() == "NATIONAL MUSEUM") {
        umayyad.style.display = "none";
        hamidiyya.style.display = "none";
        citadel.style.display = "none";
        azem.style.display = "none";
        takiyya.style.display = "none";
        dna.style.display = "flex";
        medhat.style.display = "none";
        qasioun.style.display = "none";
    } else {
        umayyad.style.display = "flex";
        hamidiyya.style.display = "flex";
        citadel.style.display = "flex";
        azem.style.display = "flex";
        takiyya.style.display = "flex";
        dna.style.display = "flex";
        medhat.style.display = "flex";
        qasioun.style.display = "flex";
    }
})