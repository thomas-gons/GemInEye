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
    <header id="sorry">
        <h1>Sorry !</h1>
    </header>
    <main id="error-content">
        <p>Either you aren't cool enough to visit "<?=$_SESSION['referrer']?>" or it doesn't exists !</p>
        <div id="div-btn-journey">
            <a href="/category.php">Visit our Home Page</a>
        </div>
    </main>
</body>
</html>