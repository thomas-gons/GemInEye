<header>
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
                <div id='header-log'>
                    <?php if (!empty($_SESSION["login"]) && $_SESSION["login"] === true) {
                        $xml = simplexml_load_file("data/customers.xml");
                        foreach ($xml->children() as $customer){
                            if (intval($customer->id) == $_SESSION['customerID'])
                                $customerData = array($customer->login, $customer->email);
                        } ?>
                        <a href='/php/log_out.php' class='log-btn'>Log out</a>
                        <div id='connected'>
                            <img id='connected-img' src='/img/user.png' alt='user_logo'>
                            <div id='circle'></div>
                            <div id='connected-login'>
                            <?php foreach ($customerData as $cd) ?>
                                <p><?=$cd?></p>
                            </div>
                        </div>
                        <?php } else { ?>
                            <a href='/sign.php?page=signin' class='log-btn'>Sign in</a>
                            <a href='/sign.php?page=signup' class='log-btn'>Sign up</a>
                        <?php } ?> 
                </div>
                <div id='header-cart'>
                    <div id='header-cart-content'>
                        <div id='cart-img-div'>
                            <img id='cart-img' src='/img/cart.png' alt='cart_image'>
                            <div id='cart-content'>
                                <?php $jsonOrder = file_get_contents("data/order.json");
                                if ($jsonOrder != null || $jsonOrder != '{}') {
                                    $data = json_decode($jsonOrder, true);
                                    if (array_key_exists($_SESSION['customerID'], $data) != false) {
                                        $data = $data[$_SESSION['customerID']]; ?>
                                        <div id='cart-items-nb'><?=count($data)?></div>
                                            <div id=cart-items>
                                            <?php for ($i = 0; $i < count($data); $i++) {
                                                if ($i >= 5) { ?>
                                                    <div class='cart-item' style='display: none'>
                                                <?php } else { ?>
                                                    <div class='cart-item'>
                                                <?php } ?>
                                                        <img src='<?=$data[$i]["img"]?>' alt='<?=$data[$i]["name"]?>'
                                                        width=80 height=80>
                                                        <div class='cart-item-id' style='display: none;'><?=$data[$i]["id"]?></div>
                                                        <div class='cart-item-name'><?=$data[$i]["name"]?></div>
                                                        <div class='cart-item-quantity'><?=$data[$i]["quantity"]?></div>
                                                    </div>
                                            <?php } 
                                            if ($i >= 5) ?>
                                                <div>...</div> 
                                        <?php }
                                    } ?>
                                </div>
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
                <li class='li-elem'><a href='/about.php'>About</a></li>
                <li class='li-elem'><a href='/contact.php'>Contact</a></li>
            </ul>
        </nav>
    </div>
</header>