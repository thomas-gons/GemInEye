<?php
    session_start();
    if (!isset($_SESSION['login'])){
        $xml = simplexml_load_file("data/customers.xml");
        $_SESSION['customerID'] = ($xml != null) ? $xml->children()[count($xml->children()) - 1]->id + 1: 1; 
    }

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
    <title>Gem In Eye - Home</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>

<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            include "php/side_bar.php"
        ?>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            <div class="black-bg-div">
                <div class="main-container">
                    <div class="main-title">Welcome to Gem In Eye !</div>
                    <div class="main-content-text">
                        Discover our selection of the best quality geodes, rough gemstones and crystals, at the best price. 
                    </div>
                    <div id="div-btn-journey">
                        <a href="/category.php">START YOUR JOURNEY</a>
                    </div>
                </div>
            </div>
            <div class="black-bg-div">
                <div class="main-container">
                    <div class="main-title">Gemstones to Heal the Mind</div>
                    <p class="main-content-subtitle">HEALING THROUGH GEMSTONES</p>
                    <div class="main-content-text">
                        Gem In Eye is providing all individuals worldwide an healthy solution to master their emotions and heal their mind through the usage of healing gemstones.
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include "commons/footer.html";
    ?>
</body>

</html>