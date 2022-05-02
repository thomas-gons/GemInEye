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
                echo "<div class='container'>
                <div id='top-title'>
                    <h1>Sign in to Gem In Eye</h1>    
                </div>
                <div class='auth-container'>
                    <form method='post' action='/php/check_auth.php'>
                        <div class='contain' id='username-email-container'>
                            <label for='username-email'>Username or email address</label>
                            <input type='text' name=username-email>
                        </div>
                        <div class='contain' id='password-container'>
                            <label for='password'>Password</label>
                            <input type='password' name=password>
                        </div>
                        <input type='submit' class='sign-button' value='Sign in'>
                    </form>
                    <div id='sign-up-container'>
                        <br>
                        <span>New to Gem In Eye ?</span>
                        <a id='sign-up-link' href='/sign.php?page=signup'> Create an account</a>
                    </div>
                </div>
            </div>";
            }



            #Page d'inscription
            elseif ($page === "signup") {
                echo "<div class='container'>
                <div id='top-title'>
                    <h1>Sign up to Gem In Eye</h1>    
                </div>
                <div class='auth-container'>
                    <form method='post' action=''>
                        <div class='contain' id='username-container'>
                            <label for='username'>Username</label>
                            <input type='text' name=username-email>
                        </div>

                        <div class='contain' id='email-container'>
                            <label for='email'>Email address</label>
                            <input type='text' name=username-email>
                        </div>

                        <div class='contain' id='password-container'>
                            <label for='password'>Password</label>
                            <input type='password' name=password>
                        </div>
                        <div class='contain' id='password-verif-container'>
                            <label for='password'>Confirm password</label>
                            <input type='password' name=password>
                        </div>
                        <input type='submit' class='sign-button' value='Sign up'>
                    </form>
                    </div>
                </div>
            </div>";
                
            }
        ?>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>