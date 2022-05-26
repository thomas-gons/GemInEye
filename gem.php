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
    <title>Gem In Eye - Product</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_gem.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_categories.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/stock.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src='/js/order.js' defer></script>
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
            <div id="gem">
                <?php 
                    $catID = $_GET['cat'];
                    $itemIndexInJSON = intVal($_GET['item']) - 1;
                    
                    $jsonStr = file_get_contents("data/stock.json");
                    $data = json_decode($jsonStr, true)[$catID]; ?>
                    <div id='gem-container'>
                        <div id='gem-data'>
                            <div>
                                <div class='data-name'>Category:</div>
                                <div class='data-value'><?=$data[$itemIndexInJSON]['category']?></div>
                            </div>
                            <div>
                                <div class='data-name'>Crystal system:</div>
                                <div class='data-value'><?=$data[$itemIndexInJSON]['crystal system']?></div>
                            </div>
                            <div>
                                <div class='data-name'>Density:</div>
                                <div class='data-value'><?=$data[$itemIndexInJSON]['density']?></div>
                            </div>
                            <div>
                                <div class='data-name'>Diaphaneity:</div>
                                <div class='data-value'><?=$data[$itemIndexInJSON]['diaphaneity']?></div>
                            </div>
                            <div>
                                <div class='data-name'>Formula:</div>
                                <div class='data-value'>
                                <?php 
                                    foreach(str_split($data[$itemIndexInJSON]['formula']) as $char)
                                        echo is_numeric($char) ? "<sub>$char</sub>": $char; 
                                ?>
                            </div><br>
                        </div>
                        <div>
                            <div class='data-name'>Fracture:</div>
                            <div class='data-value'><?=$data[$itemIndexInJSON]['fracture']?></div>
                        </div>
                        <div>
                            <div class='data-name'>Hardness:</div>
                            <div class='data-value'><?=$data[$itemIndexInJSON]['hardness']?></div>
                        </div>
                        <div>
                            <div class='data-name'>IMA symbol:</div>
                            <div class='data-value'><?=$data[$itemIndexInJSON]['ima symbol']?></div>
                        </div>
                        <div>
                            <div class='data-name'>Luster:</div>
                            <div class='data-value'><?=$data[$itemIndexInJSON]['luster']?></div>
                        </div>
                    </div>
                    <div id='gem-img-general'>
                        <img src='<?=$data[$itemIndexInJSON]['img']?>' id='gem-img' width=375 height=375ph/>
                        <div id='gem-general'>
                            <p class='gem-name'><?=$data[$itemIndexInJSON]["name"]?></p><br>
                            <p class='gem-id' style='visibility: hidden;'><?=$data[$itemIndexInJSON]["id"]?></p><br>
                            <div id='gem-origin'>
                                <span>Origin : </span>
                                <span><?=$data[$itemIndexInJSON]["origin"]?></span>
                            </div>
                            <div id='gem-info'>
                                <span>Price : </span>
                                <span id='gem-price'>$<?=$data[$itemIndexInJSON]["price"]?></span>
                            </div>
                            <div id='gem-buy'>
                                <input type='hidden' id='stock' value=<?=$data[$itemIndexInJSON]["quantity"]?>>
                            <?php 
                                if (intval($data[$itemIndexInJSON]["quantity"]) === 0) { ?>
                                    <p class='not-available'>Out of Stock</p>
                            <?php 
                                } else { ?>
                                    <p class='available'>In Stock</p>
                            <?php
                            } ?>
                            <div id='select-quantity'>
                                <div style='width:100%;'>
                                    <span>Quantity :</span><span id='quantity-span'>1</span>
                                    
                                </div>
                                    <div style='width:80%; display: flex; flex-direction: row'>
                                        <div style='width:50%;'>
                                            <button class='quantity-btn' id='quantity-less'>-</button>
                                            <button class='quantity-btn' id='quantity-more'>+</button>
                                        </div>
                                        <i style='width: 70%; text-align: center' id='info-quantity'></i>
                                    </div>
                                </div>
                                <form method='post' action='/php/order.php'>
                                    <input type='hidden' id='cartContent' name='cartContent'>
                                    <input type='submit' onclick='addCart()'id='add-to-cart' value='Add to Cart'>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            <div id='gem-descr-container'>
                <div id='gem-descr'>
                    <h2>Description:</h2><br>
                    <p><?=$data[$itemIndexInJSON]["description"]?></p>
                </div>
            </div>
        </div>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>