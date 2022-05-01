<?php
    session_start();
    if (!isset($_SESSION['login'])){
        $xml = simplexml_load_file("data/customers.xml");
        $_SESSION['customerID'] = $xml != null ? $xml->children()[count($xml->children()) - 1]->id + 1: 1; 
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
    <title>Gem In Eye</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>

<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            include "php/side_bar.php";
        ?>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, odio repellendus. Aut, doloribus? Laudantium
            error atque obcaecati consequuntur quibusdam doloremque consectetur quas nemo nisi! Magnam adipisci alias
            odio totam ab.
        </div>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>