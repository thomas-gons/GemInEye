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
                $orderAll = json_decode($jsonOrder, true);
                $order = $orderAll[strval($_SESSION['customerID'])];
                putOrderInHistory($order, $_SESSION['customerID']);
                $jsonStock = file_get_contents("data/stock.json");
                $stock = json_decode($jsonStock, true);
            ?>
                <div id="ticket-title-container">
                    <h1 id='ticket-title'>Thank you for your purchase!</h1>
                    <h2 id='ticket-title2'>Summary of your purchase</h2>
                </div>
                <div id="ticket-container">
            <?php
                $totalprice = 0;
                for($i = 0; $i < count($order); $i++) {
                    $id = $order[$i]["id"];
                    $pr = $order[$i]['quantity'] * $order[$i]['price'];
                    $totalprice += $pr; ?>
                    
                    <div><?=$order[$i]['name']?>...............<?=$order[$i]['quantity']?> X <?=$order[$i]['price']?>$ (TVA = <?=0.20*$order[$i]['price']?>$) </div>
            <?php }
                $HT = $totalprice * 0.8;
                $TVA = $totalprice * 0.2;
                echo "<br>";
                echo "<div style='font-size:small'>HT = $HT$</div>";
                echo "<div style='font-size:small'>TVA = $TVA$</div>";
                echo "<div>Total price : $totalprice$</div>"; ?>
                </div>
                <div id="div-btn-journey" style="margin: 40px">
                    <a href="/index.php">Back to Home Page</a>
                </div>
                <?php 
                    if (count($orderAll) > 1) {
                        unset($orderAll[strval($_SESSION['customerID'])]);
                    }
                    else
                        $orderAll = (object) null;
                    
                    $jsonData = json_encode($orderAll, JSON_PRETTY_PRINT);
                    file_put_contents("data/order.json", $jsonData); 
                ?>
            </div>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>

<?php
    // add customer's order to the history file 
    function putOrderInHistory($order, $customerID) {
        $prev_data = file_get_contents('data/history.json');

        // if json file is
        if ($prev_data != false) {
            $history = json_decode($prev_data, true);
            // if the customer has already done an order
            if (isset($history[$customerID])) {
                array_push($history[$customerID], $order);
            } else {
                $initHistoryCustomer = array($order);
                $history = $history + array($customerID => $initHistoryCustomer);
            }
            $jsonData = json_encode($history, JSON_PRETTY_PRINT);         
        } else {
            $history = array($customerID => array($order));
            $jsonData = json_encode($history, JSON_PRETTY_PRINT);
        }
        file_put_contents("data/history.json", $jsonData);
    }
?>