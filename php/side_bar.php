<!-- Barre de navigation gauche -->
<aside>
    <nav id='side-nav'>
        <img id='side-nav-menu-img' src='/img/sideBar/menu.png' style='width: 28px'>
        <a href='/index.php'>
            <img class='side-nav-img' src='/img/sideBar/home.png' style='width:28px'>
            <span>Home</span>
        </a>
        <button class='dropdown-btn'>
            <img class='side-nav-img' src='/img/sideBar/product.png' style='width:30px'>
            <span>Product</span>
        </button>
        <div class='dropdown-container'>
            <?php
                $csv = array_map('str_getcsv', file("data/categories.csv"));
                for ($i = 1; $i < count($csv); $i++) { 
                    // uppercase the first letter and underscore in the category name
                    $categoryName = implode(' ', explode('_', $csv[$i][0]));
                    $categoryName = ucwords($categoryName); ?>
                    <a href='/category.php?cat=<?=$csv[$i][1]?>'><?=$categoryName?></a>
                <?php } ?>
        </div>
        <?php 
            if (isset($_SESSION["login"])) { ?>
                <a href='/admin.php'>
                    <img class='side-nav-img' src='/img/sideBar/admin.png' style='width:32px'>
                    <span>User</span>
                </a>
            <?php } ?>
        <a href='/cart.php'>
            <img class='side-nav-img' src='/img/cart.png' style='width:30px'>
            <span>Order</span>
        </a>
        <a href='/about.php'>
            <img class='side-nav-img' src='/img/sideBar/about.png' style='width:30px'>
            <span>About</span>
        </a>
        <a href='/contact.php'>
            <img class='side-nav-img' src='/img/sideBar/contact.png' style='width:30px'>
            <span>Contact</span>
        </a>
        <?php 
            if (isset($_SESSION["login"])) { ?>
                <a href='/php/log_out.php' id='side-nav-log-out'>
                    <img src='/img/sideBar/logOut.png' style='width:26px'>
                    <span>Log Out</span>
                </a>
            <?php } ?>
    </nav>
</aside>