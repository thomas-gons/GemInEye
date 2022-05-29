<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!isset($_SESSION['referrer']) || empty($_SESSION['referrer'])) {
        $_SESSION['referrer'] = $current_uri;
    } else {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart - Gem In Eye</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_cart.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
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
            <div id="order-title">
                <h1>Your cart</h1>
                <p>Thank you for trusting Gem In Eye !</p>
            </div>
            <div id='order-content'>
            <?php $jsonOrder = file_get_contents("data/order.json");
            $order = json_decode($jsonOrder, true)[strval($_SESSION['customerID'])]; ?>
            <!-- empty cart if order.json is empty -->
            <?php
                if ($order != array()) {
                    $jsonStock = file_get_contents("data/stock.json");
                    $stock = json_decode($jsonStock, true); ?>
                <table>
                    <thead>
                        <th>Photo</th>
                        <th style='display: none'>Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                    <!-- display stock if customer is an admin -->
                    <?php 
                        if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
                            <th>Stock</th>
                    <?php 
                        } else { ?> 
                        <th style='display: none;'>Stock</th>
                    <?php 
                        }?>
                    <th>Price</th>
                    </thead>
                    <tbody>
                <!-- search main data about each item (img path, name, quantity) -->
                <?php 
                    for($i = 0; $i < count($order); $i++) {
                        $id = $order[$i]["id"];
                        $stockQuantity = $stock[strval($id[0])][$id[1] - 1]["quantity"]; ?>
                        <tr>
                            <td style='width: 30%;'><img style='padding: 5px 0;' src='<?=$order[$i]['img']?>' width='225' height='225'></td>
                            <td style='display: none' class='gem-id'><?=$order[$i]['id']?></td>
                            <td style='width: 35%;'><?=$order[$i]['name']?></td>
                            <td style='width: 25%;' class='quantity'>
                                <div class='quantity-div'>
                                    <p id="quantity-span"><?=$order[$i]['quantity']?></p>
                                    <button class='quantity-btn quantity-less'>-</button>
                                    <button class='quantity-btn quantity-more'>+</button>
                                </div>
                                <button class='remove-item'>Remove item</button>
                            </td>
                        <?php 
                            if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
                            <td class='stock'><?=$stockQuantity?></td>
                        <?php 
                            } else { ?> 
                            <td class='stock' style='display: none'><?=$stockQuantity?></td>
                        <?php
                            } ?>
                        <td  style='width: 20%;'>$<?=$order[$i]['price']?></td>
                    </tr>
                <?php
                    } ?>
                    </tbody>
                </table>
                <a href="<?php if(!empty($_SESSION["login"]) && $_SESSION["login"] == true){
                                echo "/resume_cart.php";
                            } else {
                                echo "/sign.php?page=signin&status=1";
                            } ?>" class='order-button' id='continue-order'><div>Continue</div></a>
                <button class='order-button' id='remove-order' >Remove Order</button>
            <?php 
                } else { ?>
                    <h1 style='margin: 8% auto;'>Your cart is empty</h1>
                    <div id="div-btn-journey" style="margin-bottom: 40px">
                        <a href="/category.php">Visit our shop !</a>
                    </div>
            <?php } ?>
            </div>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>