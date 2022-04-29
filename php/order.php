<?php
    session_start();
    $input = explode(",", $_POST["cartContent"]);
    $data = array("img" => $input[0],
                  "name" => $input[1],
                  "quantity" => intval($input[2])
                );

    $prev_data = file_get_contents('../data/order.json');
    if ($prev_data != null) {
        $tmpMap = json_decode($prev_data, true);
        $gemIndexInJSON = array_search($data["name"], array_column($tmpMap, "name"));
        if ($gemIndexInJSON != "")
            $tmpMap[$gemIndexInJSON]["quantity"] += $data["quantity"];
        else 
            array_push($tmpMap, $data);
        $jsonData = json_encode($tmpMap, JSON_PRETTY_PRINT);
    } else {
        $order = array();
        array_push($order, $data);
        $jsonData = json_encode($order, JSON_PRETTY_PRINT);
    }
    file_put_contents("../data/order.json", $jsonData);
    
    $category_url = explode("&", explode("?", $_SESSION["referrer"])[1])[0];
    header('Location: /category.php?'.$category_url);
?>