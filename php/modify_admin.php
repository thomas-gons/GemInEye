<?php
    session_start();
    
    if($_POST['mode'] == "removeItem") {
        $id = $_POST['id'];
        $jsonStr = file_get_contents("../data/stock.json");
        $data = json_decode($jsonStr, true);
        unset($data[$id[0]][intval($id[1])-1]); // On retire l'item correspondant a l'id dans stock
        $data[$id[0]] = array_values($data[$id[0]]);
        for($i=0;$i<count($data[$id[0]]);$i++) { // On redefini les id de tout les items
            $data[$id[0]][$i]["id"] = $id[0].strval(intval($i)+1);
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("../data/stock.json", $jsonData);

        $jsonOrder = file_get_contents("../data/order.json");
        $newData = json_decode($jsonOrder, true);

        //On recherche la position de l'id obtenu afin de supprimer l'item dans order
        foreach(array_keys($newData) as $key) {
            for($i=0;$i<count($newData[$key]);$i++) {
                if($newData[$key][$i]["id"] == $id) { // On retire l'item correspondant a l'id dans order
                    unset($newData[$key][$i]);
                    $newData[$key] = array_values($newData[$key]); 
                }
                if($newData[$key][$i]["id"][0] == $id[0] && intval($newData[$key][$i]["id"][1]) > intval($id[1])) { // On decremente tout les id superieur de la meme category
                    $newData[$key][$i]["id"] = $id[0].strval(intval($newData[$key][$i]["id"][1])-1);
                } 
            }
            if(empty($newData[$key])) {
                unset($newData[$key]);
                $newData = array_values($newData);
            }
        }
        $jsonNewData = json_encode($newData, JSON_PRETTY_PRINT);
        file_put_contents("../data/order.json", $jsonNewData);
    }

    if($_POST['mode'] == "removeCategory") {

        $cat = $_POST['id'];
        // It can delete all the data of a category
        /*
        $jsonStr = file_get_contents("../data/stock.json");
        $data = json_decode($jsonStr, true);
        unset($data[$cat]); // On retire la category correspondante a l'id dans stock
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("../data/stock.json", $jsonData);
        */
        $jsonOrder = file_get_contents("../data/order.json");
        $newData = json_decode($jsonOrder, true);
    
        foreach(array_keys($newData) as $key) {
            for($i=0;$i<count($newData[$key]);$i++) {
                if($newData[$key][$i]["id"][0] == $cat) {
                    unset($newData[$key][$i]);
                    $newData[$key] = array_values($newData[$key]);
                    $i--;
                }
            }
        }
        $jsonNewData = json_encode($newData, JSON_PRETTY_PRINT);
        file_put_contents("../data/order.json", $jsonNewData);
    
        $csv = array_map('str_getcsv', file("../data/categories.csv"));
        for($i=0;$i<count($csv);$i++) {
            if($csv[$i][1] == $cat) {
                unset($csv[$i]);
                $csv = array_values($csv);
                break;
            }
        }
        $fileCSV = fopen('../data/categories.csv', 'w');
        foreach ($csv as $fields)
            fputcsv($fileCSV, $fields);
        fclose($fp);
    }

    if($_POST["mode"] == "modifyItems") {
        $id = $_POST['id'];
        $property = $_POST['property'];
        $value = $_POST['value'];
        $jsonOrder = file_get_contents("../data/stock.json");
        $data = json_decode($jsonOrder, true);
        for($i=0;$i<count($data[$id[0]]);$i++) {
            if($data[$id[0]][$i]['id'] == $id) {
                $data[$id[0]][$i][$property] = strval($value);
                break;
            }
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("../data/stock.json", $jsonData);
        
        
        
        if($property == "img" || $property == "name" || $property == "quantity" || $POSTproperty == "price") {
            $jsonOrder = file_get_contents("../data/order.json");
            $newData = json_decode($jsonOrder, true);
            foreach(array_keys($newData) as $key) {
                for($i=0;$i<count($newData[$key]);$i++) {
                    if($newData[$key][$i]["id"] == $id) {
                        $newData[$key][$i][$property] = strval($value);
                    }
                }
            }
            $jsonNewData = json_encode($newData, JSON_PRETTY_PRINT);
            file_put_contents("../data/order.json", $jsonNewData);
        }
        
    }
?>