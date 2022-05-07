<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!isset($_SESSION['referrer'])) {
        $_SESSION['referrer'] = $current_uri;
    } else {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
    }
    if ($_SESSION['contact'] !== 'send') {
        // PAGE A FAIRE
        header("Location : php/error_page.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gem In Eye - Contact</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_contact.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <div id="page_content">
            <?php
                echo $_SESSION['cDate']." ";
                echo $_SESSION['fName']." ";
                echo $_SESSION['lName']." ";
                echo $_SESSION['email']." ";
                echo $_SESSION['genre']." ";
                echo $_SESSION['bDate']." ";
                echo $_SESSION['job']." ";
                echo $_SESSION['object']." ";
                echo $_SESSION['content']." ";
            ?>
        </div>
    </main>
    <?php
        include "commons/footer.html";
    ?>
</body>

</html>