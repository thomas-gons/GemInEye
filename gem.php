<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!isset($_SESSION["referrer"]) || empty($_SESSION['referrer'])) {
        $_SESSION["referrer"] = $current_uri;
    } else {
        $previous_uri = $_SESSION["referrer"];
        $_SESSION["referrer"] = $current_uri;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product - Gem In Eye</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_gem.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/stock.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>
<body>
    <?php include "php/header.php"; ?>
    <main>
        <?php include "php/side_bar.php";
            // Check for valid uri for category and item
            $catID = $_GET["cat"];
            $itemIndexInJSON = intVal($_GET["item"]) - 1;
            $jsonStr = file_get_contents("data/stock.json");
            $data = json_decode($jsonStr, true)[$catID];
            if ($data[$itemIndexInJSON] === false || $data[$itemIndexInJSON] === null
            || $data == false || $data === null) {
                header("Location: php/error_page.php");
            }
        ?>
        <!-- Contenu principal de la page -->
        <div id="page-content">
            <div id="gem-container">
                <!-- Nom article + img + prix -->
                <div id="top-gem-container">
                    <div id="gem-header">
                        <h1 id="gem-name"><?=$data[$itemIndexInJSON]["name"]?></h1>
                        <p id="gem-id" style="visibility: hidden;"><?=$data[$itemIndexInJSON]["id"]?></p>
                        <div id="gem--origin">
                            <span>Origin : </span>
                            <span><?=$data[$itemIndexInJSON]["origin"]?></span>
                        </div>
                    </div>
                    <div class="flex-row-wrap-content">
                        <div id="gem-img-content">
                            <img id="gem-img" src="<?=$data[$itemIndexInJSON]["img"]?>"
                                alt="<?= explode(" ", trim($data[$itemIndexInJSON]["name"]))[0]?>">
                        </div>
                        <div id="gem-buy-content">
                            <div id="gem-buy-content-price">
                                <h1 id="gem-price">$<?=$data[$itemIndexInJSON]["price"]?></h1>
                                <span>Including TVA at 20%<span>
                            </div>
                            <div id="gem-buy-content-stock">
                                <input type="hidden" id="gem-stock" value=<?=$data[$itemIndexInJSON]["quantity"]?>>
                            <?php 
                                if (intval($data[$itemIndexInJSON]["quantity"]) === 0) { ?>
                                    <p class="not-available">Out of Stock</p>
                            <?php 
                                } else { ?>
                                    <p class="available">In Stock</p>
                            <?php } ?>
                                <span>Free shipping cost !</span>
                                <div id="select-quantity">
                                    <div id="quantity-indicator">
                                        <span>Quantity : </span><span id="quantity-span">1</span>
                                    </div>
                                    <div id="quantity-selector">
                                        <div id="quantity-selector-btns">
                                            <button class="quantity-btn" id="quantity-less">-</button>
                                            <button class="quantity-btn" id="quantity-more">+</button>
                                        </div>
                                        <i id="status-quantity"></i>
                                    </div>
                                </div>
                                <form method="post" action="/php/order.php">
                                    <input type="hidden" id="cartContent" name="cartContent">
                                    <input type="submit" onclick="addCart()" id="add-to-cart" class="cart-buy-btn" value="Add to Cart">
                                </form>
                                <form method="post" action="/php/order.php?buynow=1">
                                    <input type="hidden" id="cartContentBuyNow" name="cartContentBuyNow">
                                    <input type="submit" onclick="buyNow()" id="buy-now" class="cart-buy-btn" value="Buy Now">
                                </form>
                            </div>
                            <div id="shipping">
                                <span>Shipping available in every country !</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Infos + description -->
                <div id="bot-gem-container">
                    <div id="gem-description-content">
                        <div id="gem-descr">
                            <h2>Description :</h2>
                            <p><?=$data[$itemIndexInJSON]["description"]?></p>
                        </div>
                        <div id="gem-infobox">
                            <h2>Info Box :</h2>
                            <div class="flex-row-wrap-content">
                                <div class="spacer">
                                    <div class='data-name'>Category:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['category']?></div>
                                </div>
                                <div class="spacer">
                                    <div class='data-name'>Crystal system:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['crystal system']?></div>
                                </div>
                                <div class="spacer">
                                    <div class='data-name'>Density:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['density']?></div>
                                </div>
                                <!-- <div class="spacer">
                                    <div class='data-name'>Diaphaneity:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['diaphaneity']?></div>
                                </div> -->
                                <div class="spacer">
                                    <div class='data-name'>Formula:</div>
                                    <div class='data-value'>
                                    <?php 
                                        foreach(str_split($data[$itemIndexInJSON]['formula']) as $char)
                                            echo is_numeric($char) ? "<sub>$char</sub>": $char; 
                                    ?>
                                    </div>
                                </div>
                                <div class="spacer">
                                    <div class='data-name'>Fracture:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['fracture']?></div>
                                </div>
                                <div class="spacer">
                                    <div class='data-name'>Hardness:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['hardness']?></div>
                                </div>
                                <div class="spacer">
                                    <div class='data-name'>IMA symbol:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['ima symbol']?></div>
                                </div>
                                <div class="spacer">
                                    <div class='data-name'>Luster:</div>
                                    <div class='data-value'><?=$data[$itemIndexInJSON]['luster']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>