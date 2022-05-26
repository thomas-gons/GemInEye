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
    <script src="/js/connected.js" defer></script>
</head>
<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php $page = $_GET['page'];
            if ($page === "signin") { ?>
                <div class='container'>
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
                            <input type='submit' class='sign-button' value='Sign in'>
                            <?php 
                                if (isset($_SESSION["connect_error"]) && $_SESSION["connect_error"] != "") { ?>
                                    <p style='color:red; padding-top: 15px'><?=$_SESSION['connect_error']?></p>
                                    <?php $_SESSION["connect_error"] = "";
                                } ?>
                            <?php 
                                if (isset($_SESSION['success_sign_up']) && $_SESSION['success_sign_up'] != "") { ?>
                                    <p style='color:red; padding-top: 15px;'><?=$_SESSION['success_sign_up']?></p>
                                    <?php $_SESSION['success_sign_up'] = "";
                                } ?>
                        </form>
                        <div id='sign-up-container'>
                            <br>
                            <span >New to Gem In Eye ?</span>
                            <a id='sign-up-link' href='/sign.php?page=signup'>Create an account</a>
                        </div>
                    </div>
                </div>
                <!-- Sign Up page -->
                <?php 
                    } elseif ($page === "signup") { ?>
                        <div class='container'>
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
                                    <input type='submit' class='sign-button' value='Sign up'>
                                    <?php
                                        if (isset($_SESSION["empty_error"]) && $_SESSION["empty_error"] != "") { ?>
                                            <p style='color:red'><?=$_SESSION['empty_error']?><p>
                                            <?php $_SESSION["empty_error"] = "";
                                        } ?>
                                    <?php 
                                        if (isset($_SESSION["already_exist_error"]) && $_SESSION["already_exist_error"] != "") { ?>
                                            <p style='color:red'><?=$_SESSION['already_exist_error']?></p>
                                            <?php $_SESSION["already_exist_error"] = "";
                                        } ?>
                                    <?php 
                                        if (isset($_SESSION["mdp_error"]) && $_SESSION["mdp_error"] != ""){ ?>
                                            <p style='color:red'><?=$_SESSION['mdp_error']?></p>
                                            <?php $_SESSION["mdp_error"] = "";
                                        } ?>
                                </form>
                            </div>
                        </div>
                <?php 
                    } ?>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>