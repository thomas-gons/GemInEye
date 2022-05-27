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
    <title>Gem In Eye - Mail</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_contact.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php include "header.php"; ?>
    <main>
        <?php include "side_bar.php"; ?> 
        <div id="mail">
            <div id="to">
                <div>To: "GemInEye" &lsaquo;gemineye@support.com.&rsaquo;<br></div>
                <div>From: <?php echo '"'.$_SESSION['fName'].' '.$_SESSION['lName'].'" '.'&lsaquo;'.$_SESSION['email'].'&rsaquo;';?> <br></div>
                <div>Subject: <?php echo $_SESSION['object'];?><br></div>
            </div>
            <div id="mailContent">
                <div><p> <?php echo nl2br(htmlspecialchars($_SESSION['content']));?></p></div>
            </div>
        </div>
    </main>
    <?php include "../commons/footer.html"; ?>
</body>
</html>