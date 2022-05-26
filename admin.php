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
    <title>Gem In Eye - Home</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_admin.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
    <script src="/js/admin.js" defer></script>
</head>

<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php
            include "php/side_bar.php"
        ?>
        <div class="content">

            <select name="items" id="items">
                <?php 
                    if(!empty($_POST["id"])) {
                        $jsonItems = file_get_contents("data/stock.json");
                        $listCategory = json_decode($jsonItems, true);
                        foreach($listCategory as $category) {
                            foreach($category as $items) {
                                ?>
                                <option class='optionItem' value='<?=$items['id']?>'><?=$items['name']?></option>; 
                                <?php
                            }                    
                        }   
                    } else {
                        $jsonItems = file_get_contents("data/stock.json");
                        $listCategory = json_decode($jsonItems, true);
                        foreach($listCategory as $category) {
                            foreach($category as $items) {
                                ?>
                                <option class='optionItem' value='<?=$items['id']?>'><?=$items['name']?></option>; 
                                <?php
                            }                    
                        }  
                    }           
                ?>
            </select>
            <input type="button" id="deleteItems" value="Delete Items"/>
            <input type="button" id="modifyItems" value="Modify Items"/>
            <select name="property" id="property">
                <option class='optionProperty'>---------------</option>
                <option class='optionProperty' value='name'>Name</option>
                <option class='optionProperty' value='description'>Descritption</option>
                <option class='optionProperty' value='origin'>Origin</option>
                <option class='optionProperty' value='category'>Category</option>
                <option class='optionProperty' value='crystal system'>Crystal System</option>
                <option class='optionProperty' value='density'>Density</option>
                <option class='optionProperty' value='diaphaneity'>Diaphaneity</option>
                <option class='optionProperty' value='formula'>Formula</option>
                <option class='optionProperty' value='fracture'>Fracture</option>
                <option class='optionProperty' value='hardness'>Hardness</option>
                <option class='optionProperty' value='ima symbol'>Ima Symbol</option>
                <option class='optionProperty' value='luster'>Luster</option>
                <option class='optionProperty' value='img'>Image</option>
                <option class='optionProperty' value='url'>Url</option>
                <option class='optionProperty' value='quantity'>Quantity</option>
                <option class='optionProperty' value='price'>Price</option>
            </select>
            <input type="text" id="modifyItemsStep2"></input>
            <input type="button" id="securityModify" value="Apply Changes"/>

            <select name="category" id="category">
                <?php
                    $csv = array_map('str_getcsv', file("data/categories.csv"));
                    for($i = 1; $i < count($csv); $i++){
                        $categoryName = implode(' ', explode('_', $csv[$i][0]));
                        $categoryName = ucwords($categoryName); ?>
                        <option class='option' value='<?=$categoryName[0]?>'><?=$categoryName?></option>
                        <?php
                    }
                ?>
            </select>
            <input type="button" id="deleteCategory" value="Delete Category"/>
            <select name="customer" id="customer">
            <?php
            
                $xml = simplexml_load_file("data/customers.xml");
                foreach($xml->children() as $customer) {
                    $customerId = $customer->id;
                    $customerLogin = $customer->login;
                    ?>
                        <option class="optionCustomer" value='<?=$customerId?>'><?=$customerLogin?></option>
                    <?php
                }
            
            ?>
            <input type="button" id="modifyCustomer" value="modify Customer"/>
            <select name="customerChange" id="customerChange">
                <option class="changeCustOption" value='id'>Id</option>
                <option class="changeCustOption" value='admin'>Admin</option>
                <option class="changeCustOption" value='login'>Login</option>
                <option class="changeCustOption" value='password'>Password</option>
                <option class="changeCustOption" value='firstname'>FirstName</option>
                <option class="changeCustOption" value='lastname'>LastName</option>
                <option class="changeCustOption" value='gender'>Gender</option>
                <option class="changeCustOption" value='email'>Email</option>
                <option class="changeCustOption" value='birthdate'>BirthDate</option>
                <option class="changeCustOption" value='adress'>Adress</option>
                <option class="changeCustOption" value='job'>Job</option>
            </select>
        </div>
    
    </main>
    <?php
        include "commons/footer.html";
    ?>
</body>

</html>