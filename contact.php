<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];

        //Verification des erreurs
        if (empty($_POST['ContactDate'])) {
            $errors['cDate'] = 'Enter a Date please';
        }
        if (empty($_POST['firstName']) || preg_match("/\d+/",$_POST['firstName'])) {
            $errors['fName'] = 'Enter a valid firstName please';
        }
        if (empty($_POST['lastName']) || preg_match("/\d+/",$_POST['lastName'])) {
            $errors['lName'] = 'Enter a valid lastName please';
        }
        if (empty($_POST['Email']) || !preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['Email'])) {
            $errors['email'] = 'Enter a valid Email please';
        }
        if (empty($_POST['Genre'])) {
            $errors['genre'] = ' ';
        }
        if (empty($_POST['BirthDate'])) {
            $errors['bDate'] = ' ';
        }
        if (empty($_POST['job'])) {
            $errors['job'] = ' ';
        }
        if (empty($_POST['Object'])) {
            $errors['object'] = ' ';
        }
        if (empty($_POST['Content'])) {
            $errors['content'] = ' ';
        }

        if(empty($errors)) {
            $_SESSION['cDate'] = $_POST['ContactDate'];
            $_SESSION['fName'] = $_POST['firstName'];
            $_SESSION['lName'] = $_POST['lastName'];
            $_SESSION['email'] = $_POST['Email'];
            $_SESSION['genre'] = $_POST['Genre'];
            $_SESSION['bDate'] = $_POST['BirthDate'];
            $_SESSION['job'] = $_POST['job'];
            $_SESSION['object'] = $_POST['Object'];
            $_SESSION['content'] = $_POST['Content'];
            header("Location: mail.php");
            die();
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gem In Eye</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_contact.css" rel="stylesheet" type="text/css">
    <script src="/js/side_navbar.js" defer></script>
    <script src="/js/form_verif.js" defer></script>
</head>

<body>
    <?php 
        include "misc.php";
        headerHTML();
    ?>
    <main>
        <?php sideBarHTML(); ?>
        <!-- Contenu principal de la page -->
        <div class="FormContact">
            <!-- Formulaire de Contact -->
            <form method="post" id="contactForm">
                <div class="form-input">
                <label for="ContactDate">Contact Date</label>
                <input type="date" name="ContactDate" id="ContactDate" placeholder="dd/mm/yyyy" required/>
                <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                <label for="firstName">FirstName</label>
                <input type="text" name="firstName" id="firstName" placeholder="Enter your firstname"  minlength="1" maxlength="25" required/> 
                <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                <label for="lastName">LastName</label>
                <input type="text" name="lastName" id="lastName" placeholder="Enter your lastname" minlength="1" maxlength="25" required/> 
                <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                <label for="Email">Email</label>
                <input type="text" name="Email" id="Email" placeholder="Enter your email" required/>
                <small class="formContactError"></small> 
                </div>
                
                <div class="form-input">
                    <div class="Gender">
                        <div> <label>Gender :</label> </div>
                        <div>
                            <input type="radio" name="Genre" id="Woman" value="Woman" required>
                            <label for="Woman">Woman</label>
                        </div>
                        <div>
                            <input type="radio" name="Genre" id="Man" value="Man" required>
                            <label for="Man">Man</label>
                        </div>
                    </div>
                    <small id="GenderError" class="formContactError"></small> 
                </div>
                
                <div class="form-input">
                    <label for="BirthDate">BirthDate</label>
                    <input type="date" name="BirthDate" id="BirthDate" placeholder="dd/mm/yyyy" required/> 
                    <small class="formContactError"></small> 
                </div>

                <div class="form-input">
                    <label for="job">job</label>
                    <select name="job" id="job" required>
                        <option value="Enseignant">Enseignant</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="SDF">SDF</option>
                    </select>
                </div>

                <div class="form-input">
                    <label for="Object">Object :</label>
                    <input type="text" name="Object" id="Object" placeholder="Enter the mail object" minlength="1" maxlength="50" required/>
                    <small class="formContactError"></small>  
                </div>

                <div class="form-input">
                    <label for="Content">Content :</label>
                    <textarea name="Content" id="Content" roww="5" cols="33" placeholder="Enter mail content" required></textarea>
                    <small class="formContactError"></small>  
                </div>
                <div class="form-input">
                    <input type="submit" name="submitContact" id="submitContact" value="Send Email"/>
                </div>
            </form>
        </div>
    </main>
    <?php footerHTML(); ?>
</body>