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
    <link href="/css/styles_log_in.css" rel="stylesheet" type="text/css">
    <title>Log In</title>
</head>
<body>
    <?php 
        include "misc.php";
        headerHTML();
    ?>
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
                    <a href="/sign_up.php">Create an account</a>
                </div>
            </div>
    </main>
    <?php footerHTML(); ?>
</body>
</html>