// Function triggered by the 'onclick' event on the buttons in places.php
function addToFavorites(placeId) {
    
    // Prepare the data to send
    const data = { place_id: placeId };
    console.log(data);

    // Use Vanilla JS fetch to send a POST request to our API
    fetch('./php/favorites.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.error) {
            // If the PHP script returned an error (like not logged in)
            alert("Error: " + result.error);
        } else {
            // Success! 
            alert("Successfully added to your dashboard!");
        }
    })
    .catch(error => {
        console.error('Error adding to favorites:', error);
        alert("Something went wrong connecting to the server.");
    });
}