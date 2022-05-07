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
    <title>Gem In Eye - About</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_about.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>
<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            include "php/side_bar.php";
        ?>
        <div id="page-content">
            <div id="AllContent">
                <div id="Descriptif">
                    <div class="Part1">
                        <h1 class="Titre">Who are we ?</h1>
                        <p>
                            GemInEye is based on four student that wanted to develop a business that no one could ever thought of. 
                            We are engineers, innovators and above all a team. We work together to provide you the best Gem, you can ever find in 
                            the world. Our priority is to bring out the beauty of gem by searching for the most suitable suppliers and give it to you at 
                            the best price in its finest form. As a teams, directors, and strategist, we build that company on the respect of work ethics, 
                            of the environment during the extraction of gems. 
                        </p>
                    </div>
                    <hr class="Lign">
                    <div class="Part1">
                        <h1 class="Titre">Where are we ?</h1>
                        <div class="Adresse">  
                            <p>
                                Our head office is located in France, more particularly in Méry sur Oise. 
                                You can come during our opening hours from Monday to Friday from 10 a.m. to 12 a.m. and 2 p.m. to 4.30 p.m., 
                                at the following address:  <u>12 rue Antoine de St-Exupery</u>   
                            </p> 
                        </div>
                    </div>
                    <hr class="Lign">
                    <div class="Part1">
                        <h1 class="Titre">How to contact us ?</h1>
                        <div class="ContactUs">
                            <p>
                                You can contact us with our contact page, or you can call us at <u>02 21 12 45 65</u> or you can contact our mail support on <u>gemineye@support.com</u>
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="Lign">
                <div class="Part2">
                    <h1 class="Titre">More About the CEOs</h1>
                    <div class="aboutUs">
                        <div class="Ceo">
                            <div class="Nom">Causse Raphael </div> <br>
                            <p> CyTech Student, I am someone who like to play with computer </p>
                        </div>
                        <div class="Ceo">
                            <div class="Nom">Gons Thomas </div> <br>
                            <p> CyTech Student, I am someone who like to play with computer </p>
                        </div>
                        <div class="Ceo">
                            <div class="Nom">Cotot Lucas </div> <br>
                            <p> CyTech Student, I am someone who like to play with computer </p>
                        </div>
                        <div class="Ceo">
                            <div class="Nom">Alzoubaidy Maxime </div> <br>
                            <p> Student at CyTech. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>
</html>