<?php
    session_start();
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true)
        header("Location: ".$_SESSION["referrer"]);
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>Gem In Eye - Sign</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_log.css" rel="stylesheet" type="text/css">
    <script src="/js/order.js" defer></script>
    <script src="/js/connected.js" defer></script>
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
                        <input type='submit' class='sign-button' value='Sign in'>";
                if (isset($_SESSION["connect_error"]) && $_SESSION["connect_error"] != ""){
                    echo "<p style='color:red'>"; echo $_SESSION['connect_error'] ; echo "</p>";
                    $_SESSION["connect_error"] = "";
                }
                echo "    
                    </form>
                    <div id='sign-up-container'>
                        <br>
                        <span >New to Gem In Eye ?</span>
                        <a id='sign-up-link' href='/sign.php?page=signup'> Create an account</a>
                    </div>
                </div>
            </div>";
            }
            /* Page d'inscription */
            elseif ($page === "signup") {
                echo "<div class='container'>
                <div id='top-title'>
                    <h1>Sign up to Gem In Eye</h1>    
                </div>
                <div class='auth-container'>
                    <form method='post' action='/php/check_sign_up.php'>
                        <div class='contain' id='name-container'>
                            <label for='name'>Name</label>
                            <input type='text' name=name>
                        </div>
                        <div class='contain' id='lastname-container'>
                            <label for='lastname'>Last name</label>
                            <input type='text' name=lastname>
                        </div>
                        <div class='contain' id='username-container'>
                            <label for='username'>Username</label>
                            <input type='text' name=username>
                        </div>
                        <div class='contain' id='email-container'>
                            <label for='email'>Email address</label>
                            <input type='text' name=email>
                        </div>
                        <div class='contain' id='password-container'>
                            <label for='password'>Password</label>
                            <input type='password' name=password>
                        </div>
                        <div class='contain' id='password-verif-container'>
                            <label for='password'>Confirm password</label>
                            <input type='password' name=c_password>
                        </div>
                        <input type='submit' class='sign-button' value='Sign up'>";
                        if (isset($_SESSION["empty_error"]) && $_SESSION["empty_error"] != ""){
                            echo "<p style='color:red'>"; echo $_SESSION['empty_error'] ; echo "</p>";
                            $_SESSION["empty_error"] = "";
                        }
                        if (isset($_SESSION["already_exist_error"]) && $_SESSION["already_exist_error"] != ""){
                            echo "<p style='color:red'>"; echo $_SESSION['already_exist_error'] ; echo "</p>";
                            $_SESSION["already_exist_error"] = "";
                        }
                        if (isset($_SESSION["mdp_error"]) && $_SESSION["mdp_error"] != ""){
                            echo "<p style='color:red'>"; echo $_SESSION['mdp_error'] ; echo "</p>";
                            $_SESSION["mdp_error"] = "";
                        }
                    echo "</form>
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