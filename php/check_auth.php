<!-- redirected from sign.php when the user press "sign in"
    Check authentication by comparing the given password with
    with the one the one in the xml according to the login entered.
    
    successful authentication: the customer's order is
    merged with his account and he's redirected to categories page.

    authentication failed: the customer's order is to sign in page
    and must re-authenticate
-->

<?php
    session_start();
    if(isset($_POST) && !empty($_POST)) {
        $xml = simplexml_load_file("../data/customers.xml");
        $check = false;
        $username_email = $_POST["username-email"];
        // crypting password
        $pswd = hash("sha256", $_POST["password"]);

        foreach($xml->children() as $customer){
            if ((strval($customer->login) == $username_email ||
            strval($customer->email) == $username_email) && 
            $customer->password == $pswd) {
                $check = true;
                $id = strval($customer->id);
                // change admin session value to that of the connected customer
                $_SESSION["admin"] = intval($customer->admin);
                $_SESSION["connect_error"] = "";
                break;
            }
            else{
                $_SESSION["connect_error"] = "Username or password invalid";
            }
        }
        // Assign the order that is not linked to any customer to the recently logged customer
        if ($check) {
            include "order.php";
            $_SESSION["login"] = true;
            $data = file_get_contents('../data/order.json');
            // get order of the not logged customer and write it to the order of the logged customer
            $orderNotLoggedInCustomer = json_decode($data, true)[$_SESSION["customerID"]];
            if ($orderNotLoggedInCustomer != array()){
                $lastItem = $orderNotLoggedInCustomer[count($orderNotLoggedInCustomer) - 1];
                foreach($orderNotLoggedInCustomer as $item) {
                    if ($item != $lastItem)
                        addToCart($item, $id);
                }
                $orders = file_get_contents('../data/order.json');
                $orders = json_decode($orders, true);
                unset($orders[$_SESSION['customerID']]);
                $jsonData = json_encode($orders, JSON_PRETTY_PRINT);
                file_put_contents("../data/order.json", $jsonData);
            }
            $_SESSION["customerID"] = $id;
            // redirected to the category page corresponding to the product
            header("Location: ".$_SESSION["referrer"]);
        } else {
            // redirected to sign in page with an error message
            header("Location: /sign.php?page=signin");
        }
    }
?>