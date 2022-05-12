<?php
    session_start();

    $xml = simplexml_load_file("../data/customers.xml");
    
    $check = false;
    $username_email = $_POST["username-email"];
    $pswd = $_POST["password"];

    foreach($xml->children() as $customer){
        if ((strval($customer->login) == $username_email ||
         strval($customer->email) == $username_email) && 
         strval($customer->password) == $pswd) {
            $check = true;
            $id = strval($customer->id);
            $_SESSION["admin"] = intval($customer->admin);
            $_SESSION["connect_error"] = "";
            break;
        }
        else{
            $_SESSION["connect_error"] = "Username or password invalid";
        }
    }
    
    if ($check){
        $_SESSION["login"] = true;
        $data = file_get_contents('../data/order.json');
        $orderNotLoggedInCustomer = json_decode($data, true)[$_SESSION["customerID"]];
        if ($orderNotLoggedInCustomer != array()){
            include "order.php";
            foreach($orderNotLoggedInCustomer as $item)
                addToCart($item, $id);
            
            $orders = file_get_contents('../data/order.json');
            $orders = json_decode($orders, true);
            unset($orders[$_SESSION['customerID']]);
            $jsonData = json_encode($orders, JSON_PRETTY_PRINT);
            file_put_contents("../data/order.json", $jsonData);
        }
        $_SESSION["customerID"] = $id;
        header("Location: ".$_SESSION["referrer"]);
    } else {
        header("Location: /sign.php?page=signin");
    }
?>