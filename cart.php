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
    <title>Gem In Eye - Cart</title>
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
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            include "php/side_bar.php";
            echo "<div id='order-content'>";
            $jsonOrder = file_get_contents("data/order.json");
            $order = json_decode($jsonOrder, true)[$_SESSION['customerID']];
            // empty cart if order.json is empty
            if ($order != array()){
                $jsonStock = file_get_contents("data/stock.json");
                $stock = json_decode($jsonStock, true);
                echo "<table>
                        <thead>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Quantity</th>";
                // display stock if customer is an admin
                if (isset($_SESSION['admin']) && $_SESSION['admin'])
                    echo "<th>Stock</th>";
                else 
                    echo "<th style='display: none;'>Stock</th>";
                echo "<th>Price</th>
                        </thead>
                        <tbody>";
                // search main data about each item (img path, name, quantity)
                $ids = explode(" ", $_GET['id']);
                for($i = 0; $i < count($order); $i++){
                    foreach($stock[strval($ids[$i][0])] as $item){
                        if ($item['id'] == $ids[$i])
                            $stock = $item['quantity'];
                    }
                    echo " <tr>
                                <td style='width: 30%;'><img style='padding: 5px 0;' src='".$order[$i]['img']."' width='225' height='225'></td>
                                <td style='width: 35%;'>".$order[$i]['name']."</td>
                                <td style='width: 25%;' class='quantity'>
                                    <div class='quantity-div'>
                                        <div>".$order[$i]['quantity']."</div>
                                        <button class='quantity-btn quantity-less'>-</button>
                                        <button class='quantity-btn quantity-more'>+</button>
                                    </div>
                                    <button class='remove-item'>Remove item</button>
                                </td>";
                        if (isset($_SESSION['admin']) && $_SESSION['admin'])
                            echo "<td class='stock'>".$stock."</td>";
                        else 
                            echo "<td class='stock' style='display: none'>".$stock."</td>";
                        echo "    <td style='width: 20%;'>$ ".$order[$i]['price']."</td>
                            </tr>";
                }
                echo "  </tbody>
                    </table>
                    <button id='remove-order'>Remove Order</button>";
            } else {
                echo "<h1 style='margin: 10% auto;'>Your cart is empty</h1>";
            }
        ?>
        </div>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>