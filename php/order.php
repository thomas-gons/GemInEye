<?php
    session_start();
    $input = explode(",", $_POST["cartContent"]);
    $data = array(
        "img" => $input[0],
        "name" => $input[1],
        "quantity" => intval($input[2])
    );

    $prev_data = file_get_contents('../data/order.json');
    $customerID = $_SESSION["customerID"];

    $orders = json_decode($prev_data, true);
    if ($prev_data != ""){
        $orders = json_decode($prev_data, true);
        if (array_key_exists($customerID, $orders) != false) {
            $customerOrder = $orders[$customerID];
            $gemIndexInJSON = array_search($data["name"], array_column($customerOrder, "name"));
            if ($gemIndexInJSON != false)
                $orders[$customerID][$gemIndexInJSON]["quantity"] += $data["quantity"];
            else
                array_push($orders[$customerID], $data);
            
            $jsonData = json_encode($orders, JSON_PRETTY_PRINT);
        } else {
            $orders = $orders + array($customerID => array($data));
            $jsonData = json_encode($orders, JSON_PRETTY_PRINT);
        } 

    } else {
        $order = array();
        array_push($order, $data);
        $order = array($customerID => $order);
        $jsonData = json_encode($order, JSON_PRETTY_PRINT);
    }

    file_put_contents("../data/order.json", $jsonData);
    
    $categoryID = explode("&", explode("?", $_SESSION["referrer"])[1])[0];
    header('Location: /category.php?'.$categoryID);
?>