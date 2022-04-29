<?php
    function headerHTML(){
        echo "<header>
        <!-- Section haute du header -->
        <div id='top-container'>
            <div id='top-logo-content'>
                <div id='top-logo-img'>
                    <a href='/index.php'>
                        <img id='top-logo' src='/img/logo.png' alt='logo_Gem_In_Eye'>
                    </a>
                </div>
            </div>
            <div id='header-container'>
                <div id='header-title'>
                    <h1>Gem In Eye</h1>
                </div>
                <div id='header-log-cart'>
                    <div id='header-log'>";
                        if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                            echo "<a href='log_out.php' class='log-btn'>Log out</a>";
                        } else {
                            echo "<a href='sign_in.php' class='log-btn'>Sign in</a>
                                  <a href='sign_up.php' class='log-btn'>Sign up</a>";
                        }
                    echo "</div>
                    <div id='header-cart'>
                        <div id='header-cart-content'>
                            <div id='cart-img-div'>
                                <img id='cart-img' src='/img/cart.png' alt='cart_image'>
                                <div id='cart-content'>"; 
                                        $jsonStock = file_get_contents("data/order.json");
                                        if ($jsonStock != null){
                                            $data = json_decode($jsonStock, true);
                                            echo "<div id='cart-items-nb'>".count($data)."</div>
                                                  <div id=cart-items>";
                                            for ($i = 0; $i < count($data); $i++) {
                                                if ($i < 5){
                                                    echo "<div class='cart-item'>
                                                            <img src=".$data[$i]["img"]." alt=".$data[$i]["name"]." width=80 height=80>
                                                            <div class='cart-item-name'>".$data[$i]["name"]."</div>
                                                            <div class='cart-item-quantity'>".$data[$i]["quantity"]."</div>
                                                        </div>";
                                                    } else {
                                                        echo "<div>. . .</div>";
                                                        break;
                                                    } 
                                            }
                                            echo "</div>";
                                        }
                                    echo "
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section basse du header -->
        <div id='nav-container'>
            <nav id='head-nav'>
                <ul id='head-list'>
                    <li class='li-elem'><a href='/index.php'>Home</a></li>
                    <li class='li-elem'><a href='/category.php'>Products</a></li>
                    <li class='li-elem'><a href=''>About</a></li>
                    <li class='li-elem'><a href='/contact.php'>Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>";
    }

    function sideBarHTML() {
        echo "<!-- Barre de navigation gauche -->
        <nav id='side-nav'>
            <a href='/index.php'>Home</a>
            <button class='dropdown-btn'>Products</button>
            <div class='dropdown-container'>
                <a href='/category.php?geodes'>Geodes</a>
                <a href='/category.php?rough_gems'>Rough Gems</a>
                <a href='/category.php?crystals'>Crystals</a>
            </div>
            <a href=''>About</a>
            <a href='/contact.php'>Contact</a>
        </nav>";
    }

    function footerHTML() {
        echo "<footer>
        <ul id='footer-list'>
            <li class='footer-list-item'><a href='/index.php'>Home</a></li>
            <li class='footer-list-item'><a href=''>About</a></li>
            <li class='footer-list-item'><a href='/contact.php'>Contact</a></li>
            <li class='footer-list-item'><a href=''>Privacy Policy</a></li>
        </ul>
        <div id='footer-logo-img'>
            <img id='footer-logo' src='/img/logo.png' alt='logo_Gem_In_Eye'>
        </div>
        <div id='copyright'>Gem In Eye © 2022</div>
    </footer>";
    }