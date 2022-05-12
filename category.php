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
    <title>Gem In Eye - Categories</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_categories.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src='/js/order.js' defer></script>
</head>

<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            if (!empty($_GET)) {
                include "php/side_bar.php";
            }
        ?>
        <!-- Contenu principal de la page -->
        <div id='page-content'>
        <?php
            if (!empty($_GET)) {
                echo "<div class='content-title'>
                        <h1>";
                $categoryID = $_GET['cat'];
                // parse CSV file ==> result: an array of the file lines
                // get the elements of the columns (separated by commas ==> 'str_getcsv')
                $csv = array_map('str_getcsv', file("data/categories.csv"));
                for ($i = 0; $i < count($csv); $i++){
                    if ($csv[$i][1] == $categoryID){
                        $categoryIndex = $i;
                        break;
                    }
                }
                $categoryName = array_column($csv, 0)[$categoryIndex];
                // get a more readable name of the category by replacing the underscore with space and uppercasing the first letter
                $title = implode(' ', explode('_', $categoryName));
                $title = ucwords($title);
                echo $title."</h1>";
                // display a short description of the category
                if ($categoryName === "geodes") {
                    echo "<p>Geodes are rounded rocks that have hollow spaces in their centers. These voids are filled with crystals and other minerals.<br><br>
                    From the outside, a geode looks like an ordinary, round rock. There’s nothing special or particularly attractive about it. They are lumpy and actually quite ugly looking. It’s only when they are broken apart that their inner beauty is revealed.</p>";
                }
                if ($categoryName === "rough_gems") {
                    echo "<p>A rough gemstone is un uncut unshaped gemstone. It is the stone in its natural form, often found in the ground, just as mother nature made. They are often called raw gems but the proper name is rough.</p>";
                }
                if ($categoryName === "crystals") {
                    echo "<p>For thousands of years crystals and gemstones have been used by native healers. Crystals can be held, placed in your environment or used in crystal healing to promote energetic balance and healing.</p>";
                }
                echo "</div>
                      <div id='gems'>";
                // parse JSON file
                $jsonStr = file_get_contents("data/stock.json");
                // transform the json string into an array of objects
                $gems = json_decode($jsonStr, true)[$categoryID];
                foreach($gems as $gem) {
                    // display item only if there is stock for it
                    $stock = intval($gem["quantity"]);
                    $first_word = explode(' ',trim($gem["name"]));
                    if ($stock !== 0) {
                        echo "<div class='gem'>
                            <a href='/gem.php?cat=".$categoryID."&item=".$gem["id"][1]."'>
                                <img class='gem-img' src=".$gem["img"]." alt=".$first_word[0].">
                                <p class='gem-name'>".$gem["name"]."</p>
                                <i class='gem-origin'>".$gem["origin"]."</i>
                                <p class='gem-price'>$".$gem["price"]."</p>
                            </a>
                        </div>";
                    }
                }
                echo "</div>";
            } else {
                echo "<div class='categ-img' id='geode-img'>
                        <div class='index-img-button'><a href='/category.php?cat=G'>Geodes</a></div>
                    </div>
                    <div class='categ-img' id='rough-gems-img'>
                        <div class='index-img-button'><a href='/category.php?cat=R' >Rough Gems</a></div>
                    </div>
                    <div class='categ-img' id='crystals-img'>
                        <div class='index-img-button'><a href='/category.php?cat=C' >Crystals</a></div>
                    </div>";
            }
        ?>
        </div>
    </main>
    <?php 
        include "commons/footer.html";
    ?>
</body>

</html>