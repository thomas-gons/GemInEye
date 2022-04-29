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
    <link href="/css/styles_gem.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_categories.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
    <script src="/js/stock.js" defer></script>
    <script src='/js/order.js' defer></script>
</head>

<body>
    <?php 
        include "php/misc.php";
        headerHTML();
    ?>
    <main>
        <?php sideBarHTML(); ?>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            <div id="gem">
                <?php 
                    $indexAmpersand = strpos($_SERVER["REQUEST_URI"], "&");
                    $gem = urldecode(substr($_SERVER["REQUEST_URI"], $indexAmpersand + 1));
                    
                    $jsonStr = file_get_contents("data/stock.json");
                    $data = json_decode($jsonStr, true)[$_SESSION["category"]];

                    $gemIndexInJSON = array_search($gem, array_column($data, "name"));

                    $gemName = strtolower(explode(" ", trim($data[$gemIndexInJSON]["name"]))[0]);
                    echo "<div id='gem-container'>
                            <img src='/img/".$_SESSION['category']."/".$gemName.".png' id='gem-img' width=375 height=375/>
                            <div id='gem-data'>
                                <p class='gem-name'>".$data[$gemIndexInJSON]["name"]."</p>
                                <p>Origin:</p>
                                <p class='gem-origin'>".$data[$gemIndexInJSON]["origin"]."</p>
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
                                        <div style='width:80%; display: flex; flex-direction: row'>
                                            <div style='width:50%;'>
                                                <button class='quantity-btn' id='quantity-less'>-</button>
                                                <button class='quantity-btn' id='quantity-more'>+</button>
                                            </div>
                                            <i style='width: 70%; text-align: center' id='info-quantity'></i>
                                        </div>
                                    </div>
                                    <form method='post' action='/php/order.php' onSubmit='return check()'>
                                        <input type='hidden' id='cartContent' name='cartContent'>
                                        <input type='submit' onclick='addCart()'id='add-to-cart' value='Add to Cart'>
                                    </form>
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
    <?php footerHTML(); ?>
</body>

</html>