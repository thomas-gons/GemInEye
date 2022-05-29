<?php
    session_start();
    if (isset($_POST) && !empty($_POST)) {
        $xml = simplexml_load_file("../data/customers.xml");
        
        //variables d'erreur
        $error = false;

        //récuperation des données d'inscription
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $c_password = $_POST["c_password"];
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];

        //vérifie si tout les champs sont remplis
        if ($username === "" || $email === "" || $password === "" || $c_password === "" || $name === "" || $lastname === ""){
            $_SESSION["empty_error"] = "One or more fields are not filled in.";
            $error = true;
        }
        //vérifie si le compte existe déjà
        foreach ($xml->children() as $customer){
            if ((strval($customer->login) === $username ||
            strval($customer->email) === $email)) {
                $_SESSION["already_exist_error"] = "This email or username already exist.";
                $error = true;
            }
        }
        //vérifie si la confirmation du mdp est bonne
        if ($password !== $c_password){
            $_SESSION['mdp_error'] = "Passwords are not the same.";
            $error = true;
        }
        if ($error === true){
            header("Location: /sign.php?page=signup");
        }
        else {
            $xml2 = new DOMDocument();
            // pretty print for XML file
            $xml2->formatOutput = true;
            $xml2->preserveWhiteSpace = false;
            
            $xml2->load("../data/customers.xml");
            $cust = $xml2->firstChild;
            $newcust = $xml2->createElement("customer");
            
            $admin = $xml2->createElement("admin",'0');
            $login = $xml2->createElement("login",$username);
            $password = $xml2->createElement("password", hash('sha256', $password));
            $firstname = $xml2->createElement("firstname",$name);
            $lastname = $xml2->createElement("lastname",$lastname);
            $email = $xml2->createElement("email",$email);
            
            $newcust->appendChild($admin);
            $newcust->appendChild($login);
            $newcust->appendChild($password);
            $newcust->appendChild($firstname);
            $newcust->appendChild($lastname);
            $newcust->appendChild($email);
        
            $cust->appendChild($newcust);
            $xml2->save("../data/customers.xml");
            $_SESSION['success_sign_up'] = "Sign up success";
            header("Location: /sign.php?page=signin");
        }
    }
?>