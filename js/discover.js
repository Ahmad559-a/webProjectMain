const tempDisplay = document.querySelector(".tempDisplay");
const feelsDisplay = document.querySelector(".feelsDisplay");
const humidityDisplay = document.querySelector(".humidityDisplay");
const descDisplay = document.querySelector(".descDisplay");
const weatherEmoji = document.querySelector(".weatherEmoji");
const updateBtn = document.querySelector("#update");

const apiKey = "163499a6403d1e5fd412f8dc92aab14c";

updateBtn.addEventListener("click", async event => {
    try {
        const weatherData = await getWeatherData();
        displayWeatherInfo(weatherData);
    } catch (error){
        console.error(error);
    }
});

async function getWeatherData(){
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=33.51&lon=36.28&appid=${apiKey}`;

    const response = await fetch(apiUrl);

    if(!response.ok){
        throw new Error("Could not fetch weather data");
    }else {
        return await response.json();
    }
}

function displayWeatherInfo(data){
    const {
        main: {temp, humidity, feels_like},
        weather: [{description, id}]
        } = data;

    tempDisplay.textContent = `Temperature: ${(temp - 273.15).toFixed(1)}°C`;
    feelsDisplay.textContent = `Feels Like: ${(feels_like - 273.15).toFixed(1)}°C`;
    humidityDisplay.textContent = `Humidity: ${humidity}%`;
    descDisplay.textContent = description;

    weatherEmoji.textContent = getWeatherEmoji(id);
}

function getWeatherEmoji(weatherId){
    switch(true){
        case(weatherId >= 200 && weatherId < 300):
            return "⛈️";
        case(weatherId >= 300 && weatherId < 400):
            return "🌧️";
        case(weatherId >= 500 && weatherId < 600):
            return "🌧️";
        case(weatherId >= 600 && weatherId < 700):
            return "❄️";
        case(weatherId >= 700 && weatherId < 800):
            return "🌫️";
        case(weatherId === 800):
            return "☀️";
        case(weatherId >= 801 && weatherId < 810):
            return "☁️";
        default:
            return "❓";
    }
}