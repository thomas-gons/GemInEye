<?php
    if (isset($_POST) && !empty($_POST)) {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $jsonStock = $jsonStr = file_get_contents("../data/stock.json");
        $data = json_decode($jsonStr, true);
        $gems = $data[strval($id[0])];
        $data[strval($id[0])][intval($id[1]) - 1]["id"];
        for ($i = 0; $i < count($gems); $i++){
            if ($gems[$i]["id"] == $id){
                $data[$id[0]][$i]["quantity"] += $quantity;
                break;
            }
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("../data/stock.json", $jsonData);
    }
?>