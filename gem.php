<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gem In Eye</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/stylesGem.css" rel="stylesheet" type="text/css">
    <link href="/css/stylesCategories.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
    <script src="/js/cart.js" defer></script>
</head>

<body>
    <header>
        <!-- Section haute du header -->
        <div id="top-container">
            <div id="top-logo-content">
                <div id="top-logo-img">
                    <!-- Lien a changer quand on changera en index.php -->
                    <a href="/index.php">
                        <img id="top-logo" src="/img/logo.png" alt="logo_Gem_In_Eye">
                    </a>
                </div>
            </div>
            <div id="header-container">
                <div id="header-title">
                    <h1>Gem In Eye</h1>
                </div>
                <div id="header-login">
                    <!-- TODO : PHP : afficher Sign in + Sign up, si pas connecté -->
                    <button class="log-btn">Sign in</button>
                    <button class="log-btn">Sign up</button>
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
            <a href="/index.php">Home</a>
            <button class="dropdown-btn">Products</button>
            <div class="dropdown-container">
                <a href="/category.php?geodes">Geodes</a>
                <a href="/category.php?roughGems">Rough Gems</a>
                <a href="/category.php?crystals">Crystals</a>
            </div>
            <a href="">About</a>
            <a href="">Contact</a>
        </nav>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            <div id="gem">
                <?php 
                    $indexQuestMark = strpos($_SERVER["REQUEST_URI"], "&");
                    $gem = urldecode(substr($_SERVER["REQUEST_URI"], $indexQuestMark + 1));
                    
                    $jsonStr = file_get_contents("data/stock.json");
                    $data = json_decode($jsonStr, true)[$_SESSION["category"]];

                    $gemIndexInJSON = array_search($gem, array_column($data, "name"));

                    $sep = str_contains($data[$gemIndexInJSON]["name"], "(") ? ' ': ',';
                    $gemName = strtolower(explode($sep, trim($data[$gemIndexInJSON]["name"]))[0]);
                    echo "<div id='gem-container'>
                            <img src='/img/".$_SESSION['category']."/".$gemName.".png' width=400 height=400/>
                            <div id='gem-data'>
                                <p class='gem-name'>".$data[$gemIndexInJSON]["name"]."</p>
                                <p>Origin:</p>
                                <p>".$data[$gemIndexInJSON]["origin"]."</p>
                                <div id='gem-info'>
                                    <span>Price : </span>
                                    <span class='gem-price'>$".$data[$gemIndexInJSON]["price"]."</span>
                                </div>
                                <div id='gem-buy'>
                                    <input type='hidden' id='stock' value=".$data[$gemIndexInJSON]["quantity"].">";
                    if (intval($data[$gemIndexInJSON]["quantity"]) === 0) {
                        echo "<p class='not-available'>Out of Stock</p>";
                    } else {
                        echo "<p class='available'>In Stock</p>";
                    }
                    echo "          <div id='select-quantity'>
                                        <div style='width:100%;'>
                                            <span>Quantity : </span><span id='quantity-span'>0</span>
                                            
                                        </div>
                                        <div style='width:50%;'>
                                            <button class='quantity-btn' id='quantity-less'>-</button>
                                            <button class='quantity-btn' id='quantity-more'>+</button>
                                        </div>
                                    </div>
                                    <button type='submit' name='addCart' id='add-to-cart'>Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <div id='gem-descr'>
                            <p>Description:</p>
                            <p>".$data[$gemIndexInJSON]["description"]."</p>
                        </div>";
                ?>
            </div>
        </div>
    </main>
    <footer>
        <ul id="footer-list">
            <li class="footer-list-item"><a href="/index.php">Home</a></li>
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