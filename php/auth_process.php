<?php

session_start();

require 'db.php';

$action = $_POST['action'];
$username = $_POST['username'];
$password = $_POST['password'];

if( $action == "register"){
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");

        $stmt->execute([$username, $hashedpassword]);

        echo "Registration successful! <a href='login.php'>Go back to login</a>";
    } catch (PDOException $e) {
        if($e->getCode() == 23000) {
            echo "Error: Username already exists. <a href='login.php'>Try a different one</a>";
        } else {
            echo "Database error " . $e->getMessage() . "";
        }
    }
}else if ( $action == "login"){
    $stmt = $pdo->prepare("SELECT id ,username, password_hash FROM users WHERE username = ?");

    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if($user && password_verify($password, $user["password_hash"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: dashboard.php");
        exit();
    }else {
        echo "invalid username or password. <a href='login.php'>Try again</a>";
    }
}