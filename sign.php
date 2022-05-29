<?php
    session_start();
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true)
        header("Location: ".$_SESSION["referrer"]);
    $page = $_GET['page'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo(($page === "signin") ? "Sign In": "Sign Up");?> - Gem In Eye</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_log.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/order.js" defer></script>
    <script src="/js/connected.js" defer></script>
</head>
<body>
    <?php include "php/header.php"; ?>
    <main>
        <?php include "php/side_bar.php"; ?>
        <div id="page-content">
        <!-- Sign In page -->
        <?php if ($page === "signin") { ?>
                <div class='container'>
                    <div id='top-title'>
                        <h1>Sign in to Gem In Eye</h1>
                        <h3><?php if ($_GET["status"] === "1") echo "You first need to be logged before buying on Gem In Eye!" ?></h3>   
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
            <?php } elseif ($page === "signup") { ?>
                <div class='container'>
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
            <?php } ?>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>