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
    <link href="/css/styles_categories.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
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
        <div id='page-content'>
            <div class='content-title'>
                <h1>
                <?php
                    $indexQuestMark = strpos($_SERVER["REQUEST_URI"], "?");
                    $category = substr($_SERVER["REQUEST_URI"], $indexQuestMark + 1);
                    $title = implode(' ', explode('_', $category));
                    $title = ucwords($title);
                    echo $title;
                ?>
                </h1>
                <?php
                    if ($category === "geodes") {
                        echo "<p>Geodes are rounded rocks that have hollow spaces in their centers. These voids are filled with crystals and other minerals.<br><br>
                        From the outside, a geode looks like an ordinary, round rock. There’s nothing special or particularly attractive about it. They are lumpy and actually quite ugly looking. It’s only when they are broken apart that their inner beauty is revealed.</p>";
                    }
                    if ($category === "rough_gems") {
                        echo "<p>A rough gemstone is un uncut unshaped gemstone. It is the stone in its natural form, often found in the ground, just as mother nature made. They are often called raw gems but the proper name is rough.</p>";
                    }
                    if ($category === "crystals") {
                        echo "<p>For thousands of years crystals and gemstones have been used by native healers. Crystals can be held, placed in your environment or used in crystal healing to promote energetic balance and healing.</p>";
                    }
                ?>
            </div>
            <div id='gems'>
                <?php 
                    $_SESSION["category"] = $category;
                    $jsonStr = file_get_contents("data/stock.json");
                    $data = json_decode($jsonStr, true)[$category];
                    foreach($data as $d){
                        echo "<div class='gem'>
                                <a href='/gem.php?$category&".$d["name"]."'>
                                    <img class='gem-img' src='$d[img]' alt=".$d["name"].">
                                
                                <p class='gem-name'>$d[name]</p>
                                <i class='gem-origin'>$d[origin]</i>
                                </a>
                            </div>";
                    }
                ?>
            </div>
        </div>
    </main>
        <?php footerHTML(); ?>
</body>

</html>