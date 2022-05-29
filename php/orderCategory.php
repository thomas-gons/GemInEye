<?php

    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $customerID = $_SESSION['customerID'];

    $jsonStr = file_get_contents("../data/order.json");
    $data = json_decode($jsonStr, true);

    

?>