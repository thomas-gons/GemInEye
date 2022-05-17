<?php 
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $jsonStock = $jsonStr = file_get_contents("../data/stock.json");
    $data = json_decode($jsonStr, true);
    $gems = $data[$id[0]];
    for ($i = 0; $i < count($gems); $i++){
        if ($gems[$i]["id"] == $id){
            $data[$id[0]][$i]["quantity"] -= $quantity;
            break;
        }
    }
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("../data/stock.json", $jsonData);
