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
        include "misc.php";
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
                    echo "</h1>"
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
                                </a>
                                <p class='gem-name'>$d[name]</p>
                                <i style='font-weight: 600;'>$d[origin]</i>
                            </div>";
                    }
            echo "</div>";
            ?>
    </main>
        <?php footerHTML(); ?>
</body>