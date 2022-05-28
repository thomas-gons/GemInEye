<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!isset($_SESSION['referrer'])) {
        $_SESSION['referrer'] = $current_uri;
    } else {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
    }
    if (!empty($_GET['cat'])) {
        $categoryID = $_GET['cat'];
        // parse CSV file ==> result: an array of the file lines
        // get the elements of the columns (separated by commas ==> 'str_getcsv')
        $csv = array_map('str_getcsv', file("data/categories.csv"));
        $redirect = 0;
        for ($i = 1; $i < count($csv); $i++) {
            if ($csv[$i][1] == $categoryID){
                $categoryIndex = $i;
                $redirect = 0;
                break;
            } else {
                $redirect++;
            }
        }
        //redirect to error_page if given unknown categoryID in url
        if ($redirect !== 0){
            header("Location: php/error_page.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gem In Eye - Categories</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_categories.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src='/js/order.js' defer></script>
</head>
<body>
    <?php include "php/header.php"; ?>
    <main>
        <?php include "php/side_bar.php"; ?>
        <!-- Contenu principal de la page -->
        <div id='page-content'>
        <?php
            if (empty($_GET)) { ?>
                <!-- Category homepage with a carousel to select the catergory -->
                <div id="slider-container">
                    <div class="slider-btn">
                        <img class="left-arrow" src="/img/slider_arrow.png" data-prev>
                        <div class="extend-bg" data-prev></div>
                    </div>
                    <div id="slider-all">
                    <?php
                        // Read all categories from the csv file to make the sliders images
                        for ($i = 1; $i < count($csv); $i++) { 
                            $categoryName = implode(' ', explode('_', $csv[$i][0]));
                            $categoryName = ucwords($categoryName); ?>
                            <div class="slider-single-center-column <?php if ($i != 1) echo "disabled"; else echo "enabled" ?>"data-slide-<?=$i?>>
                                <div class="slider-single-title">
                                    <img class='slider-single-title-img' src='/img/sideBar/product.png'>
                                    <div class="single-title"><?=$categoryName?></div>
                                </div>
                                <div class="slider-single-img">
                                    <a href='/category.php?cat=<?=$csv[$i][1]?>'><img class="single-img" src="/img/<?=$csv[$i][0]?>.jpg" alt="<?=$categoryName?>"></a>
                                </div>
                            </div>
                    <?php } ?>
                    </div>
                    <div class="slider-btn">
                        <img class="right-arrow rotate180deg" src="/img/slider_arrow.png" data-next/>
                        <div class="extend-bg" data-next></div>
                    </div>
                </div>
                <script src="/js/carousel.js" defer></script>
        <?php }
            if (!empty($_GET) && $redirect === 0) { ?>
                <div class='content-title'>
                    <?php 
                    $categoryName = array_column($csv, 0)[$categoryIndex]; ?>
                    <!-- get a more readable name of the category by replacing the underscore with space and uppercasing the first letter -->
                    <?php $title = implode(' ', explode('_', $categoryName)); ?>
                    <?php $title = ucwords($title); ?>
                    <h1><?=$title?></h1>
                    <!-- display a short description of the category -->
                    <?php 
                        if ($categoryName === "geodes") { ?>
                            <p>Geodes are rounded rocks that have hollow spaces in their centers. These voids are filled with crystals and other minerals.<br><br>
                            From the outside, a geode looks like an ordinary, round rock. There’s nothing special or particularly attractive about it. They are lumpy and actually quite ugly looking. It’s only when they are broken apart that their inner beauty is revealed.</p>
                    <?php 
                        } elseif ($categoryName === "rough_gems") { ?>
                            <p>A rough gemstone is un uncut unshaped gemstone. It is the stone in its natural form, often found in the ground, just as mother nature made. They are often called raw gems but the proper name is rough.</p>
                    <?php 
                        } elseif ($categoryName === "crystals") { ?>
                            <p>For thousands of years crystals and gemstones have been used by native healers. Crystals can be held, placed in your environment or used in crystal healing to promote energetic balance and healing.</p>
                    <?php
                        } ?>
                </div>
                <div id='gems'>
                <!-- parse JSON file -->
                <?php $jsonStr = file_get_contents("data/stock.json");
                // transform the json string into an array of objects
                $gems = json_decode($jsonStr, true)[$categoryID]; ?>
                <?php 
                    foreach($gems as $gem) {
                        // display item only if there is stock for it
                        $stock = intval($gem["quantity"]);
                        $first_word = explode(' ',trim($gem["name"]));
                        if ($stock !== 0) { ?>
                            <div class='gem'>
                                <a href='/gem.php?cat=<?=$categoryID?>&item=<?=$gem["id"][1]?>'>
                                    <img class='gem-img' src='<?=$gem["img"]?>' alt="<?=$first_word[0]?>">
                                    <p class='gem-name'><?=$gem["name"]?></p>
                                    <i class='gem-origin'><?=$gem["origin"]?></i>
                                    <p class='gem-price'>$<?=$gem["price"]?></p>
                                </a>
                            </div>
                        <?php }
                    } ?>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>

</html>