<!-- Barre de navigation gauche -->
<nav id='side-nav'>
    <a href='/index.php'>Home</a>
    <button class='dropdown-btn'>Products</button>
    <div class='dropdown-container'>
        <?php
            $csv = array_map('str_getcsv', file("data/categories.csv"));
            for($i = 1; $i < count($csv); $i++){
                $categoryName = implode(' ', explode('_', $csv[$i][0]));
                $categoryName = ucwords($categoryName);
                echo "<a href='/category.php?cat=".$csv[$i][1]."'>".$categoryName."</a>";
            }
        ?>
    </div>
    <a href=''>About</a>
    <a href='/contact.php'>Contact</a>
</nav>