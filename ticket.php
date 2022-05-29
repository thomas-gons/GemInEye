<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if(!isset($_SESSION['referrer']) || $_SESSION['referrer'] !== "/resume_cart.php") {
        header("Location: php/error_page.php");
    } else {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gem In Eye - Ticket</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_cart.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
    <script src="/js/cart.js" defer></script>
</head>
<body>
    <?php include "php/header.php"; ?>
    <main>
        <?php include "php/side_bar.php"; ?>
        <div id="page-content">
            <div id="all-ticket-container">
            <?php 
                $jsonOrder = file_get_contents("data/order.json");
                $order = json_decode($jsonOrder, true)[strval($_SESSION['customerID'])]; 
                $jsonStock = file_get_contents("data/stock.json");
                $stock = json_decode($jsonStock, true);
            ?>
                <div id="ticket-title-container">
                    <h1 id='ticket-title'>Thank you for your purchase!</h1>
                    <h2 id='ticket-title2'>Summary of your purchase</h2>
                </div>
                <div id="ticket-container">
            <?php
                for($i = 0; $i < count($order); $i++) {
                    $id = $order[$i]["id"];?>
                    <div><?=$order[$i]['name']?>...............<?=$order[$i]['quantity']?> X $<?=$order[$i]['price']?>
                    </div>
            <?php }
                $totalprice = 0;
                for($i = 0; $i < count($order); $i++) {
                    $totalprice += $order[$i]['price'];
                }
                // FAIRE : afficher TVA ?
                echo "Total price : $";
                echo strval($totalprice);
                // FAIRE : supprimer la commande du fichier order.json
            ?>
                </div>
                <div id="div-btn-journey" style="margin: 40px">
                    <a href="/index.php">Back to Home Page</a>
                </div>
            </div>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>