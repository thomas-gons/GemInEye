<?php
    session_start();
    $current_uri = $_SERVER["REQUEST_URI"];
    if (!isset($_SESSION['referrer']) || empty($_SESSION['referrer'])) {
        $_SESSION['referrer'] = $current_uri;
    } else {
        $previous_uri = $_SESSION['referrer'];
        $_SESSION['referrer'] = $current_uri;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About - Gem In Eye</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_about.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>
<body>
    <?php include "php/header.php"; ?>
    <main>
        <?php include "php/side_bar.php"; ?>
        <div id="page-content">
            <div id="container">
                <div id="description">
                    <div class="part1">
                        <h1 class="title">Who are we ?</h1>
                        <p>
                            GemInEye is based on four student that wanted to develop a business that no one could ever thought of. 
                            We are engineers, innovators and above all a team. We work together to provide you the best Gem, you can ever find in 
                            the world. Our priority is to bring out the beauty of gem by searching for the most suitable suppliers and give it to you at 
                            the best price in its finest form. As a teams, directors, and strategist, we build that company on the respect of work ethics, 
                            of the environment during the extraction of gems. 
                        </p>
                    </div>
                    <hr class="lign">
                    <div class="part1">
                        <h1 class="title">Where are we ?</h1>
                        <div class="Adresse">  
                            <p>
                                Our head office is located in France, more particularly in Méry sur Oise. 
                                You can come during our opening hours from Monday to Friday from 10 a.m. to 12 a.m. and 2 p.m. to 4.30 p.m., 
                                at the following address:  <i>12 rue Antoine de St-Exupery</i>   
                            </p> 
                        </div>
                    </div>
                    <hr class="lign">
                    <div class="part1">
                        <h1 class="title">How to contact us ?</h1>
                        <div class="ContactUs">
                            <p>
                                You can contact us with our contact page, or you can call us at <i>02.21.12.45.65</i> or you can contact our mail support on <i>gemineye@support.com</i>
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="lign">
                <div class="part2">
                    <h1 class="title">More About the CEOs</h1>
                    <div class="about-us">
                        <div class="ceo">
                            <div class="name">Causse Raphael </div> <br>
                            <p> I'm a student at CY Tech Engineer school ! Love all the work I've learn in IT and I'm proud of presenting to you our first web site !</p>
                        </div>
                        <div class="ceo">
                            <div class="name">Gons Thomas </div> <br>
                            <p>I am someone who like to code stuff on a computer since I'm very young. I'm also happy to be able to show my skills by building this site with my team.</p>
                        </div>
                        <div class="ceo">
                            <div class="name">Cotot Lucas </div> <br>
                            <p>I love drawing and designing stuff on a computer. If you like our logo, thank you cause it's all me !</p>
                        </div>
                        <div class="ceo">
                            <div class="name">Alzoubaidy Maxime </div> <br>
                            <p>So glad to work with my friends, I've learn a lot and I'm proud of myself for my contribution to this huge project !</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "commons/footer.html"; ?>
</body>
</html>