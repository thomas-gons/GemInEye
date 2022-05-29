<?php
    session_start();
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST["cartContentBuyNow"]) && !empty($_POST["cartContentBuyNow"])) {
            $input = explode(",", $_POST["cartContentBuyNow"]);
        } else {
            $input = explode(",", $_POST["cartContent"]);
        }
        $item = array(
            "id" => $input[0],
            "img" => $input[1],
            "name" => $input[2],
            "quantity" => intval($input[3]),
            "price" => intval($input[4])
        );
        addToCart($item, $_SESSION['customerID']);
        modifyStock($item);
    }
    

    function addToCart($item, $customerID) {
        $prev_data = file_get_contents('../data/order.json');

        $orders = json_decode($prev_data, true);
        // if json file is
        if ($prev_data != "") {
            $orders = json_decode($prev_data, true);
            // if the customer has already done an order
            if (array_key_exists($customerID, $orders) != false) {
                $customerOrder = $orders[$customerID];
                $gemIndexInJSON = array_search($item["name"], array_column($customerOrder, "name"));
                // if the customer has already ordered this item
                if ($gemIndexInJSON != "")
                    $orders[$customerID][$gemIndexInJSON]["quantity"] += $item["quantity"];
                else
                    array_push($orders[$customerID], $item);
                
                $jsonData = json_encode($orders, JSON_PRETTY_PRINT);
            } else {
                $orders = $orders + array($customerID => array($item));
                $jsonData = json_encode($orders, JSON_PRETTY_PRINT);
            }
        } else {
            $order = array();
            array_push($order, $item);
            $order = array($customerID => $order);
            $jsonData = json_encode($order, JSON_PRETTY_PRINT);
        }
        file_put_contents("../data/order.json", $jsonData);
    }

    function modifyStock($item) {
        $jsonStr = file_get_contents("../data/stock.json");
        $data = json_decode($jsonStr, true);
        $category = $data[strval($item["id"][0])];
        foreach($category as $key => $val) {
            if ($val["id"] == $item["id"]) {
                $data[$item["id"][0]][$key]["quantity"] -= $item["quantity"];
                break;
            }
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("../data/stock.json", $jsonData);
    }

    $categoryID = explode("&", explode("?", $_SESSION["referrer"])[1])[0];
    if (!empty($_GET['buynow']) && $_GET['buynow'] === "1") {
        header('Location: /cart.php');
    } else {
        header('Location: /category.php?'.$categoryID);
    }
?>