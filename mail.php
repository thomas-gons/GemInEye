<?php
    session_start();
    //Check for valid access to page
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!empty($_SESSION['referrer']) && $_SESSION['referrer'] === '/contact.php' && !empty($_POST)) {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
    } else {
        header("Location: php/error_page.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mail - Gem In Eye</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_contact.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>
<body>
    <?php include "php/header.php"; ?>
    <main>
        <?php include "php/side_bar.php"; ?>
        <!-- Check contact form -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            //Errors checking
            if (empty($_POST['ContactDate'])) {
                $errors['cDate'] = 'Enter a Date please';
            }
            if (empty($_POST['firstName']) || preg_match("/\d+/",$_POST['firstName'])) {
                $errors['fName'] = 'Enter a valid firstName please';
            }
            if (empty($_POST['lastName']) || preg_match("/\d+/",$_POST['lastName'])) {
                $errors['lName'] = 'Enter a valid lastName please';
            }
            if (empty($_POST['Email']) || !preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['Email'])) {
                $errors['email'] = 'Enter a valid Email please';
            }
            if (empty($_POST['Genre'])) {
                $errors['genre'] = ' ';
            }
            if (empty($_POST['BirthDate'])) {
                $errors['bDate'] = ' ';
            }
            if (empty($_POST['job'])) {
                $errors['job'] = ' ';
            }
            if (empty($_POST['Object'])) {
                $errors['object'] = ' ';
            }
            if (empty($_POST['Content'])) {
                $errors['content'] = ' ';
            }
            if(empty($errors)) {
                $_SESSION['cDate'] = $_POST['ContactDate'];
                $_SESSION['fName'] = $_POST['firstName'];
                $_SESSION['lName'] = $_POST['lastName'];
                $_SESSION['email'] = $_POST['Email'];
                $_SESSION['genre'] = $_POST['Genre'];
                $_SESSION['bDate'] = $_POST['BirthDate'];
                $_SESSION['job'] = $_POST['job'];
                $_SESSION['object'] = $_POST['Object'];
                $_SESSION['content'] = $_POST['Content'];
                }
            }
        ?>
        <div id="page-content">
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
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>