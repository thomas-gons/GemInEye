<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!isset($_SESSION['referrer'])) {
        $_SESSION['referrer'] = $current_uri;
    } else {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
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
    <link href="/css/styles_categories.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
</head>

<body>
    <header>
        <!-- Section haute du header -->
        <div id="top-container">
            <div id="top-logo-content">
                <div id="top-logo-img">
                    <a href="/index.php">
                        <img id="top-logo" src="/img/logo.png" alt="logo_Gem_In_Eye">
                    </a>
                </div>
            </div>
            <div id="header-container">
                <div id="header-title">
                    <h1>Gem In Eye</h1>
                </div>
                <div id="header-log-cart">
                    <div id="header-log">
                    <?php if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                            echo "<a href='log_out.php' class='log-btn'>Log out</a>";
                        } else {
                            echo "<a href='sign_in.php' class='log-btn'>Sign in</a>
                                  <a href='sign_up.php' class='log-btn'>Sign up</a>";
                        }
                        ?>
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
        </div>
        <!-- Section basse du header -->
        <div id="nav-container">
            <nav id="head-nav">
                <ul id="head-list">
                    <li class="li-elem"><a href="/index.php">Home</a></li>
                    <li class="li-elem"><a href="/category.php">Products</a></li>
                    <li class="li-elem"><a href="">About</a></li>
                    <li class="li-elem"><a href="/contact.php">Contact</a></li>
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
                <a href="/category.php?rough_gems">Rough Gems</a>
                <a href="/category.php?crystals">Crystals</a>
            </div>
            <a href="">About</a>
            <a href="/contact.php">Contact</a>
        </nav>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            <div class="content-title">
                <h1>
                    <?php
                        $indexQuestMark = strpos($_SERVER["REQUEST_URI"], "?");
                        $category = substr($_SERVER["REQUEST_URI"], $indexQuestMark + 1);
                        $title = implode(' ', explode('_', $category));
                        $title = ucwords($title);
                        echo $title;
                    ?>
                </h1>
            </div>
            <div id="gems">
                <?php
                    $_SESSION["category"] = $category;
                    $jsonStr = file_get_contents("data/stock.json");
                    $data = json_decode($jsonStr, true)[$category];
                    foreach($data as $d){
                        echo "<div class='gem'>
                                <a href='/gem.php?$category&".$d["name"]."'>
                                    <img class='gem-img' src='$d[img]' alt=".$d["name"].">
                                </a>
                                <p class='gem-name'>$d[name]</p>
                                <i style='font-weight: 600;'>$d[origin]</i>
                            </div>";
                    }
                ?>
            </div>
        </div>
    </main>
    <footer>
        <ul id="footer-list">
            <li class="footer-list-item"><a href="/index.php">Home</a></li>
            <li class="footer-list-item"><a href="">About</a></li>
            <li class="footer-list-item"><a href="/contact.php">Contact</a></li>
            <li class="footer-list-item"><a href="">Privacy Policy</a></li>
        </ul>
        <div id="footer-logo-img">
            <img id="footer-logo" src="/img/logo.png" alt="logo_Gem_In_Eye">
        </div>
        <div id="copyright">Gem In Eye © 2022</div>
    </footer>
</body>