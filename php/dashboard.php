<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Damascus</title>
    
    <link rel="stylesheet" href="../style/header-footer.css">
    <link rel="stylesheet" href="../style/places.css">

    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    
    <style>
        .logout-btn {
            background-color: #8B0000;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            float: right;
            margin: 20px;
        }
    </style>
</head>
<body>
    <img src="assets/branch.png" alt="branch.png" id="branch1" class="branch">
    
    <header>
        <h1 id="logo">Damascus</h1>
        <nav>
            <a href="../home.html">Home</a>
            <a href="../places.php">Places</a>
            <a href="details.html">Place Details</a>
            <a href="../discover.html">Discover</a>
            <a href="../contact.html">Contact</a>
            <a href="dashboard.php">Dashboard</a>
        </nav>
    </header>
    <main>
        <a href="logout.php" class="logout-btn">Logout</a>

        <div id="root"></div>

        <script type="text/babel">

            // COMPONENT 1: The individual favorite card (using Props)
            function FavoriteCard(props) {
                return (
                    <div className="card">
                        <img src={"." + props.place.image_url} alt={props.place.name} />
                        <article>
                            <h3>{props.place.name.toUpperCase()}</h3>
                            <p className="category">{props.place.category}</p>
                            <p className="description">{props.place.description}</p>
                            
                            <button 
                                style={{ backgroundColor: "#8B0000", color: "white", border: "none", padding: "8px 12px", borderRadius: "4px", cursor: "pointer", marginTop: "10px", width: "100%", fontWeight: "bold" }}
                                onClick={() => props.onRemove(props.place.id)}
                            >
                                Remove from Favorites
                            </button>
                        </article>
                    </div>
                );
            }

            // COMPONENT 2: The Main Application
            function App() {
                // State to store the dynamic list of favorites
                const [favorites, setFavorites] = React.useState([]);

                // useEffect to fetch data from your PHP API when the page loads
                React.useEffect(() => {
                    fetch("favorites.php")
                        .then(res => res.json())
                        .then(data => {
                            // Ensure data is an array before setting state
                            if(Array.isArray(data)) {
                                setFavorites(data);
                            }
                        });
                }, []);

                // Function to handle the removal of a favorite
                const handleRemove = (placeId) => {
                    fetch("favorites.php", {
                        method: "DELETE",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ place_id: placeId })
                    })
                    .then(res => res.json())
                    .then(() => {
                        // Update state to remove the item from the screen without reloading
                        const updatedFavorites = favorites.filter(place => place.id !== placeId);
                        setFavorites(updatedFavorites);
                    });
                };

                return (
                    <main>
                        <section className="title">
                            <h1>YOUR FAVORITES</h1>
                            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! Here are your saved locations.</p>
                        </section>
                        
                        <section className="cards">
                            {favorites.length === 0 ? (
                                <div style={{ textAlign: "center", width: "100%", marginTop: "20px" }}>
                                    <h3>No favorites saved yet.</h3>
                                    <p>Head over to the Places page to add some!</p>
                                </div>
                            ) : (
                                // Dynamic rendering using map() function
                                favorites.map(place => (
                                    <FavoriteCard 
                                        key={place.id} 
                                        place={place} 
                                        onRemove={handleRemove} 
                                    />
                                ))
                            )}
                        </section>
                    </main>
                );
            }

            // Render the App component into the root div
            const root = ReactDOM.createRoot(document.getElementById("root"));
            root.render(<App />);

        </script>
    </main>
    <footer>
        &copy; Web Project Team
    </footer>

    <img src="assets/branch.png" alt="branch.png" id="branch2" class="branch">
</body>
</html>