<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gem In Eye</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
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
                    <li class="li-elem"><a href="">Home</a></li>
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
                <a href="category.php?roughGems">Rough Gems</a>
                <a href="category.php?crystals">Crystals</a>
            </div>
            <a href="">About</a>
            <a href="">Contact</a>
        </nav>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, odio repellendus. Aut, doloribus? Laudantium
            error atque obcaecati consequuntur quibusdam doloremque consectetur quas nemo nisi! Magnam adipisci alias
            odio totam ab.
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