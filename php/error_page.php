<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Error Page</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Error page</h1>
    </header>
    <p>Oops ! An error occured on <?=$_SESSION['referrer']?> !</p>
    <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            echo "<form action='/php/log_out.php' method='post' style='margin-top: 2em;'>
                    <button type='submit'>Home page</button>
                </form>";
        } else {
            echo "<form action='/index.php' method='post' style='margin-top: 2em;'>
                    <button type='submit'>Home page</button>
                </form>";
        }
    ?>
</body>
</html>