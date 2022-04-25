<?php
    session_start();

    $xml = simplexml_load_file("../data/customers.xml");
    
    $check = false;
    $id = $_POST["username-email"];
    $pswd = $_POST["password"];

    echo $id." ".$pswd;

    foreach($xml->children() as $customer){
        if (($customer->login == $id ||
         $customer->email == $id) && 
         $customer->password == $pswd)
            $check = true;
    }
    echo $_SESSION['referrer'];
    
    if ($check){
        $_SESSION["login"] = true;
        echo $_SESSION['referrer'];
        header("Location: ".$_SESSION["referrer"]);
    } else {
        header("Location: /sign-in.php");
    }
    
   
?>