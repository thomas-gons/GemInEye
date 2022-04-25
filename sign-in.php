<?php
    session_start();
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true)
        header("Location: ".$_SESSION["referrer"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/stylesLogIn.css" rel="stylesheet" type="text/css">
    <title>Log In</title>
</head>
<body>
    <header>
        <!-- Section haute du header -->
        <div id="top-container">
            <div id="top-logo-content">
                <div id="top-logo-img">
                    <!-- Lien a changer quand on changera en index.php -->
                    <a href="/index.html">
                        <img id="top-logo" src="/img/logo.png" alt="logo_Gem_In_Eye">
                    </a>
                </div>
            </div>
            <div id="header-container">
                <div id="header-title">
                    <h1>Gem In Eye</h1>
                </div>
                
            </div>
        </div>
    </header>
    <main>
            <h1>Sign in to Gem In Eye</h1><br><br>
            <div id="auth-container">
                <form method="post" action="/php/check_auth.php">
                    <div id="username-email-container">
                        <label for="username-email">Username or email address</label>
                        <input type="text" name=username-email>
                    </div>
                    <div id="password-container">
                        <label for="password">Password</label>
                        <input type="text" name=password>
                    </div>
                    <input type="submit" id="sign-in" value="Sign in">
                    <br><br>
                </form>
                <div id="sign-up-container">
                    <i>New to Gem In Eye?</i>
                    <a href="/sign-up.php">Create an account</a>
                </div>
            </div>
    </main>
    <footer>
        <ul id="footer-list">
            <li class="footer-list-item"><a href="/index.php">Home</a></li>
            <li class="footer-list-item"><a href="">About</a></li>
            <li class="footer-list-item"><a href="/contact.php">Contact</a></li>
            <li class="footer-list-item"><a href="">Privacy Policy</a></li>
        </ul>
        <div id="footer-logo-img">
            <img id="footer-logo" src="/img/logo.png" alt="logo_Gem_In_Eye">
        </div>
        <div id="copyright">Gem In Eye © 2022</div>
    </footer>
</body>
</html>