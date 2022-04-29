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
    <title>Gem In Eye</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_contact.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php 
        include("misc.php");
        headerHTML();
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
    <?php footerHTML(); ?>
</body>

</html>