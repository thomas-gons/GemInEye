<?php
    session_start();
    $xml = simplexml_load_file("../data/customers.xml");
    
    //variables d'erreur
    $error = false;

    //récuperation des donné d'inscription
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password = $_POST["c_password"];
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];

    //vérifie si tout les champs sont rempli
    if($username === "" || $email === "" || $password === "" || $c_password === "" || $name === "" || $lastname === ""){
        $_SESSION["empty_error"] = "One or more fields are not filled in.";
        $error = true;
    }
    
    //vérifie si le compte existe déjà
    foreach($xml->children() as $customer){
        if ((strval($customer->login) === $username ||
         strval($customer->email) === $email)) {
            $_SESSION["already_exist_error"] = "This email or username already exist.";
            $error = true;
         }
    }

    //vérifie si la confirmation du mdp est bon
    if($password !== $c_password){
        $_SESSION['mdp_error'] = "Passwords are not the same.";
        $error = true;
    }

    if($error === true){
        header("Location: /sign.php?page=signup");
    }
?>