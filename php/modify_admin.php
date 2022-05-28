<?php
    session_start();

    //REMOVING AN ITEM

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

    // ADD AN ITEM

    if ($_POST["mode"] == "addItems") {
        $categoryID = ucwords($_POST['category'][0]);
        $name = $_POST['name'];
        $description = $_POST['description'];
        $origin = $_POST['origin'];
        $img = $_POST['img'];
        $url = $_POST['url'];
        $quantity = intval($_POST['quantity']);
        $price = intval($_POST['price']);

        $jsonStock = file_get_contents("../data/stock.json");
        $data = json_decode($jsonStock, true);
        $id = $categoryID.(count($data[$categoryID]) + 1);

        include "simple_html_dom.php";

        $gem_name = $_POST['name'];
        $base_url = 'https://en.wikipedia.org/wiki/'.$gem_name;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl_handle, CURLOPT_URL, $base_url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($curl_handle);

        curl_close($curl_handle);

        $html = new simple_html_dom();
        $html->load($response);

        $gemData = ["id" => $id, "name" => $gem_name, "description" => $description, "origin" => $origin];
        
        $properties = array("Category" => "/[\w\s]+/",
                            "Formula" => "/[\w\s(),\+-]+/",
                            "IMA symbol" => "/[A-Za-z]+/",
                            "Crystal system" => "/\w+/",
                            "Fracture" => "/[\w\s(),;-]+/",
                            "Mohs scale hardness" => "/.*/",
                            "Luster" => "/[\w\s(),;-]+/",
                            "Diaphaneity" => "/[\w\s(),;-]+/",
                            "Specific gravity" => "/.*/"
        );

        $endash = html_entity_decode('&#x2013;', ENT_COMPAT, 'UTF-8');

        foreach ($properties as $prop_key => $prop_value) {
            $count = false;
            foreach ($html->find('th[class="infobox-label"]') as $element) {
                if (preg_match("/$prop_key/", $element->plaintext, $match)) {
                    preg_match($prop_value, $element->nextSibling()->plaintext, $match);
                    $val = $match[0];
                    $count = true;
                    break;
                }
            }
            if ($count == false)
                $val = "NA";
        
            if ($prop_key == "Specific gravity"){
                $gemData["density"] = str_replace($endash, '-', $val);
            }
            elseif ($prop_key == "Mohs scale hardness")
                $gemData["hardness"] = $val;
            else 
                $gemData[strtolower($prop_key)] = $val;
        }

        $gemData = $gemData + array("img" => $img, "url" => $url, "quantity" => $quantity, "price" => $price);

        array_push($data[$categoryID], $gemData);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("../data/stock.json", $jsonData);
    }
    
    //MODIFYING AN ITEM

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

    //REMOVING A CATEGORY

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
            if(empty($newData[$key])) {
                $newData[$key]= "";
                unset($newData[$key]);
                $newData = array_values($newData);
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

    //MODIFYING A CUSTOMER

    if($_POST["mode"] == "modifyCustomer") {
        $id = $_POST['id'];
        $propertyCustomer = $_POST['property'];
        $value = $_POST['value'];
        $xml = new DOMDocument();
        // pretty print for XML file
        $xml->formatOutput = true;
        $xml->preserveWhiteSpace = false;
        
        $xml->load("../data/customers.xml");
        
        $xml->getElementsByTagName($propertyCustomer)->item($id - 1)->textContent = $value;
        $xml->save("../data/customers.xml");
    }
?>