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
            break;
        }
    }
    
    if ($check){
        $_SESSION["login"] = true;
        $_SESSION["customerID"] = $id;
        header("Location: ".$_SESSION["referrer"]);
    }   else {
        header("Location: /sign.php?page=signin");
    }
?>