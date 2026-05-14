<?php
session_start();
require './php/db.php'; // Connect to the database

// Fetch all places from the database
try {
    $stmt = $pdo->query("SELECT * FROM places");
    $all_places = $stmt->fetchAll();
} catch(PDOException $e) {
    die("Error fetching places: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/header-footer.css">
    <link rel="stylesheet" href="./style/places.css">
    <title>Places - Damascus</title>
    <style>
        .fav-btn {
            background-color: #C5A059;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }
        .fav-btn:hover { background-color: #8B0000; }
    </style>
</head>
<body>
    <img src="assets/branch.png" alt="branch.png" id="branch1" class="branch">
    <header>
        <h1 id="logo">Damascus</h1>
        <nav>
            <a href="home.html">Home</a>
            <a href="places.php">Places</a>
            <a href="details.html">Place Details</a>
            <a href="discover.html">Discover</a>
            <a href="contact.html">Contact</a>
            <a href="./php/dashboard.php">Dashboard</a>
        </nav>
    </header>
    <main>
        <section class="title">
            <h1>PLACES</h1>
            <p>Discover the timeless beauty, history, and vibrant culture of our ancient city.</p>
        </section>
        
        <section class="search">
            <div class="searchBar">
                <input type="text" id="searchBar" placeholder="Search for historic sites, museums, and landmarks....">
            </div>
        </section>

        <section class="cards">
            <?php foreach($all_places as $place): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($place['image_url']); ?>" alt="<?php echo htmlspecialchars($place['name']); ?>">
                    <article>
                        <h3><?php echo htmlspecialchars(strtoupper($place['name'])); ?></h3>
                        <p class="category"><?php echo htmlspecialchars($place['category']); ?></p>
                        <p class="description"><?php echo htmlspecialchars($place['description']); ?></p>
                        
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <button class="fav-btn" onclick="addToFavorites(<?php echo $place['id']; ?>)">
                                Add to Favorites
                            </button>
                        <?php else: ?>
                            <p style="font-size: 0.8em; color: #888; margin-top: 10px;">
                                <a href="./php/login.php" style="color: #4A7C59;">Log in</a> to save this place.
                            </p>
                        <?php endif; ?>

                    </article>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        © Web Project Team
    </footer>
    <img src="assets/branch.png" alt="branch.png" id="branch2" class="branch">
    
    <script src="./js/main.js"></script>
    <script src="./js/add-favorite.js"></script>
</body>
</html>