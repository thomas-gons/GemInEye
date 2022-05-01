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
    <link href="/css/styles_log.css" rel="stylesheet" type="text/css">
    <script src="/js/order.js" defer></script>
    <title>Log In</title>
</head>
<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            $page = $_GET['page'];
            if ($page === "signin") {
                echo "<div id='container'>
                <div id='top-title'>
                    <h1>Sign in to Gem In Eye</h1>    
                </div>
                <div id='auth-container'>
                    <form method='post' action='/php/check_auth.php'>
                        <div id='username-email-container'>
                            <label for='username-email'>Username or email address</label>
                            <input type='text' name=username-email>
                        </div>
                        <div id='password-container'>
                            <label for='password'>Password</label>
                            <input type='text' name=password>
                        </div>
                        <input type='submit' id='sign-in' value='Sign in'>
                        <br><br>
                    </form>
                    <div id='sign-up-container'>
                        <span>New to Gem In Eye ?</span>
                        <a href='/sign.php?page=signup'> Create an account</a>
                    </div>
                </div>
            </div>";
            }
            elseif ($page === "signup") {
                //
            }
        ?>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>