<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];

        //Verification des erreurs
        if (empty($_POST['ContactDate'])) {
            $errors['cDate'] = 'Enter a Date please';
        }
        if (empty($_POST['firstName']) || preg_match("/\d+/",$_POST['firstName'])) {
            $errors['fName'] = 'Enter a valid firstName please';
        }
        if (empty($_POST['lastName']) || preg_match("/\d+/",$_POST['lastName'])) {
            $errors['lName'] = 'Enter a valid lastName please';
        }
        if (empty($_POST['Email']) || !preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['Email'])) {
            $errors['email'] = 'Enter a valid Email please';
        }
        if (empty($_POST['Genre'])) {
            $errors['genre'] = ' ';
        }
        if (empty($_POST['BirthDate'])) {
            $errors['bDate'] = ' ';
        }
        if (empty($_POST['job'])) {
            $errors['job'] = ' ';
        }
        if (empty($_POST['Object'])) {
            $errors['object'] = ' ';
        }
        if (empty($_POST['Content'])) {
            $errors['content'] = ' ';
        }

        if(empty($errors)) {
            $_SESSION['cDate'] = $_POST['ContactDate'];
            $_SESSION['fName'] = $_POST['firstName'];
            $_SESSION['lName'] = $_POST['lastName'];
            $_SESSION['email'] = $_POST['Email'];
            $_SESSION['genre'] = $_POST['Genre'];
            $_SESSION['bDate'] = $_POST['BirthDate'];
            $_SESSION['job'] = $_POST['job'];
            $_SESSION['object'] = $_POST['Object'];
            $_SESSION['content'] = $_POST['Content'];
            header("Location: mail.php");
            die();
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gem In Eye</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/stylesContact.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
    <script src="/js/FormVerif.js" defer></script>
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
                <div id="header-login">
                    <!-- TODO : PHP : afficher Sign in + Log in, si pas connecté -->
                    <button class="log-btn">Sign in</button>
                    <button class="log-btn">Log in</button>
                    <!-- TODO : PHP : afficher Log out, si connecté -->
                    <!-- <button class="log-btn">Log out</button> -->
                </div>
                <div id="header-cart">
                    <div id="header-cart-content">
                        <div id="cart-img-div">
                            <img id="cart-img" src="/img/cart.png" alt="cart_image">
                            <div id="cart-nbr">
                                <!-- nombre d'element dans le panier -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section basse du header -->
        <div id="nav-container">
            <nav id="head-nav">
                <ul id="head-list">
                    <li class="li-elem"><a href="/index.php">Home</a></li>
                    <li class="li-elem"><a href="/category.php">Products</a></li>
                    <li class="li-elem"><a href="">About</a></li>
                    <li class="li-elem"><a href="">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <!-- Barre de navigation gauche -->
        <nav id="side-nav">
            <a href="">Home</a>
            <button class="dropdown-btn">Products</button>
            <div class="dropdown-container">
                <a href="category.php?geodes">Geodes</a>
                <a href="category.php?rough_gems">Rough Gems</a>
                <a href="category.php?crystals">Crystals</a>
            </div>
            <a href="">About</a>
            <a href="">Contact</a>
        </nav>
        <!-- Contenu principal de la page -->
        <div class="FormContact">
            <!-- Formulaire de Contact -->
            <form method="post" id="contactForm">
                <div class="form-input">
                <label for="ContactDate">Contact Date</label>
                <input type="date" name="ContactDate" id="ContactDate" placeholder="dd/mm/yyyy" required/>
                <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                <label for="firstName">FirstName</label>
                <input type="text" name="firstName" id="firstName" placeholder="Enter your firstname"  minlength="1" maxlength="25" required/> 
                <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                <label for="lastName">LastName</label>
                <input type="text" name="lastName" id="lastName" placeholder="Enter your lastname" minlength="1" maxlength="25" required/> 
                <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                <label for="Email">Email</label>
                <input type="text" name="Email" id="Email" placeholder="Enter your email" required/>
                <small class="formContactError"></small> 
                </div>
                
                <div class="form-input">
                    <div class="Gender">
                        <div> <label>Gender :</label> </div>
                        <div>
                            <input type="radio" name="Genre" id="Woman" value="Woman" required>
                            <label for="Woman">Woman</label>
                        </div>
                        <div>
                            <input type="radio" name="Genre" id="Man" value="Man" required>
                            <label for="Man">Man</label>
                        </div>
                    </div>
                    <small id="GenderError" class="formContactError"></small> 
                </div>
                
                <div class="form-input">
                    <label for="BirthDate">BirthDate</label>
                    <input type="date" name="BirthDate" id="BirthDate" placeholder="dd/mm/yyyy" required/> 
                    <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                    <label for="job">job</label>
                    <select name="job" id="job" required>
                        <option value="Enseignant">Enseignant</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="SDF">SDF</option>
                    </select>
                </div>

                <div class="form-input">
                    <label for="Object">Object :</label>
                    <input type="text" name="Object" id="Object" placeholder="Enter the mail object" minlength="1" maxlength="50" required/>
                    <small class="formContactError"></small>  
                </div>

                <div class="form-input">
                    <label for="Content">Content :</label>
                    <textarea name="Content" id="Content" roww="5" cols="33" placeholder="Enter mail content" required></textarea>
                    <small class="formContactError"></small>  
                </div>
                <div class="form-input">
                    <input type="submit" name="submitContact" id="submitContact" value="Send Email"/>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <ul id="footer-list">
            <li class="footer-list-item"><a href="">Home</a></li>
            <li class="footer-list-item"><a href="">About</a></li>
            <li class="footer-list-item"><a href="">Contact</a></li>
            <li class="footer-list-item"><a href="">Privacy Policy</a></li>
        </ul>
        <div id="footer-logo-img">
            <img id="footer-logo" src="/img/logo.png" alt="logo_Gem_In_Eye">
        </div>
        <div id="copyright">Gem In Eye © 2022</div>
    </footer>
</body>