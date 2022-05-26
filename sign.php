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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_log.css" rel="stylesheet" type="text/css">
    <script src="/js/order.js" defer></script>
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
</head>
<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            include "php/side_bar.php";
        ?>
        <div id="page-content">
        <?php
            $page = $_GET['page'];
            /* Page de connexion */
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
                            <input type='password' id='password' name='password'>
                        </div>
                        <input type='submit' class='sign-button' value='Sign in'>";
                if (isset($_SESSION["connect_error"]) && $_SESSION["connect_error"] !== ""){
                    echo "<p style='color:red; padding-top: 15px'>"; echo $_SESSION['connect_error'] ; echo "</p>";
                    $_SESSION["connect_error"] = "";
                }
                if (isset($_SESSION['success_sign_up']) && $_SESSION['success_sign_up'] !== ""){
                    echo "<p style='color:red; padding-top: 15px;'>"; echo $_SESSION['success_sign_up'] ; echo "</p>";
                    $_SESSION['success_sign_up'] = "";
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
                            <input type='text' name=name  minlength='2' maxlength='25' required>
                        </div>
                        <div class='contain' id='lastname-container'>
                            <label for='lastname'>Last name</label>
                            <input type='text' name=lastname  minlength='2' maxlength='25' required>
                        </div>
                        <div class='contain' id='bdate-container'>
                            <label for='lastname'>Birth date</label>
                            <input type='date' name=bdate required>
                        </div>
                        <div class='contain' id='username-container'>
                            <label for='username'>Username</label>
                            <input type='text' name=username  minlength='2' maxlength='10' required>
                        </div>
                        <div class='contain' id='email-container'>
                            <label for='email'>Email address</label>
                            <input type='email' name=email required>
                        </div>
                        <div class='contain' id='gender'>
                            <label>Gender</label>
                            <div>
                                <input type='radio' name='Genre' id='Woman' value='Woman' style='margin-right:5px' required>
                                <label for='Woman' style='margin-right:20px' >Woman</label>
                                <input type='radio' name='Genre' id='Man' value='Man' style='margin-right:5px' required>
                                <label for='Man'>Man</label>
                            </div>
                        </div>
                        <div class='contain' id='adress-container'>
                            <label for='adress'>Adress</label>
                            <input type='text' name=adress required>
                        </div>
                        <div class='contain' id='password-container'>
                            <label for='password'>Password</label>
                            <input type='password' name=password minlength='8' maxlength='25' required>
                        </div>
                        <div class='contain' id='password-verif-container'>
                            <label for='password'>Confirm password</label>
                            <input type='password' name=c_password  minlength='8' maxlength='25' required>
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
        </div>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>