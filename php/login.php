<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Damascus</title>
    <link rel="stylesheet" href="../style/header-footer.css">
    <style>
        .auth-container { 
            display: flex; 
            justify-content: center; 
            gap: 40px; 
            padding: 50px 20px; 
            flex-wrap: wrap; 
        }
        .auth-box { 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            border-top: 5px solid #C5A059;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            width: 350px; 
        }
        .auth-box h2 { color: #4A7C59; margin-bottom: 20px; }
        .auth-box input { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0 20px 0; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }
        .auth-box button { 
            width: 100%; 
            padding: 12px; 
            background-color: #4A7C59; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold;
            transition: 0.3s;
        }
        .auth-box button:hover { background-color: #8B0000; }
    </style>
</head>
<body>
    <header>
        <h1 id="logo">Damascus</h1>
        <nav>
            <a href="../home.html">Home</a>
            <a href="../places.php">Places</a>
            <a href="../details.html">Place Details</a>
            <a href="../discover.html">Discover</a>
            <a href="../contact.html">Contact</a>
            <a href="login.php">Login / Register</a>
        </nav>
    </header>

    <div class="auth-container">
        <div class="auth-box">
            <h2>Login</h2>
            <form action="auth_process.php" method="POST">
                <input type="hidden" name="action" value="login">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required pattern="[A-Za-z]{6,}\d*">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required pattern="\w{4,}[-#@].+">
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="auth-box">
            <h2>Create Account</h2>
            <form action="auth_process.php" method="POST">
                <input type="hidden" name="action" value="register">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required pattern="[A-Za-z]{6,}\d*">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required pattern="\w{4,}[-#@].+">
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; Web Project Team
    </footer>
</body>
</html>