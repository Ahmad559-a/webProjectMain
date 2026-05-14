<?php
// Start the session to know WHICH user is making the request
session_start();

// Tell the browser that this file outputs JSON, not HTML
header('Content-Type: application/json');

// If the user isn't logged in, stop immediately and return an error
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // 401 means "Unauthorized"
    echo json_encode(["error" => "You must be logged in to view or edit favorites."]);
    exit();
}

require 'db.php';
$user_id = $_SESSION['user_id'];

// Determine what action the frontend is trying to do based on the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

try {
    // ==========================================
    // 1. READ (GET): Fetch all favorites for this user
    // ==========================================
    if ($method === 'GET') {
        // We join the 'places' table and 'favorites' table to get the actual details of the liked places
        $stmt = $pdo->prepare("
            SELECT places.id, places.name, places.category, places.description, places.image_url 
            FROM places 
            JOIN favorites ON places.id = favorites.place_id 
            WHERE favorites.user_id = ?
        ");
        $stmt->execute([$user_id]);
        $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array
        
        echo json_encode($favorites); // Send the data back to React
    } 
    
    // ==========================================
    // 2. CREATE (POST): Add a new favorite
    // ==========================================
    elseif ($method === 'POST') {
        // React will send the data as a JSON string, so we need to decode it
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (isset($input['place_id'])) {
            $place_id = $input['place_id'];
            
            $stmt = $pdo->prepare("INSERT IGNORE INTO favorites (user_id, place_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $place_id]);
            
            echo json_encode(["message" => "Successfully added to favorites."]);
        } else {
            http_response_code(400); // 400 means "Bad Request"
            echo json_encode(["error" => "No place_id provided."]);
        }
    } 
    
    // ==========================================
    // 3. DELETE (DELETE): Remove a favorite
    // ==========================================
    elseif ($method === 'DELETE') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (isset($input['place_id'])) {
            $place_id = $input['place_id'];
            
            $stmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND place_id = ?");
            $stmt->execute([$user_id, $place_id]);
            
            echo json_encode(["message" => "Successfully removed from favorites."]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "No place_id provided."]);
        }
    }

} catch(PDOException $e) {
    http_response_code(500); // 500 means "Server Error"
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}