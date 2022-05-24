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
            header("Location: php/mail.php");
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gem In Eye - Contact</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gemstones online shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/styles_contact.css" rel="stylesheet" type="text/css">
    <script src="/js/navbar.js" defer></script>
    <script src="/js/form_verif.js" defer></script>
    <script src="/js/connected.js" defer></script>
    <script src="/js/order.js" defer></script>
</head>

<body>
    <?php 
        include "php/header.php";
    ?>
    <main>
        <?php 
            include "php/side_bar.php";
        ?>
        <!-- Contenu principal de la page -->
        <div id="container">
            <div id="contact-title">
                <h1>Contact information</h1>
                <p>You may also email us by using the form on this page. We enjoy answering questions and talking with our customers. We hope to hear from you soon!</p>
                <p>Do you want to discover Gem In Eye ? Click <a href="/about.php">here</a></p>
            </div>
            <div class="FormContact">
                <!-- Formulaire de Contact -->
                <form method="post" id="contactForm">
                    <div class="form-input">
                    <label for="ContactDate">Contact date :     </label><br>
                    <input type="date" class="real-input" name="ContactDate" id="ContactDate" required/>
                    <small class="formContactError"></small> 
                    </div>
                    <div class="form-input">
                    <label for="firstName">First name :     </label><br>
                    <input type="text" class="real-input" name="firstName" id="firstName" placeholder="Enter your firstname"  minlength="1" maxlength="25" required/> 
                    <small class="formContactError"></small> 
                    </div>
                    <div class="form-input">
                    <label for="lastName">Last name :     </label><br>
                    <input type="text" class="real-input" name="lastName" id="lastName" placeholder="Enter your lastname" minlength="1" maxlength="25" required/> 
                    <small class="formContactError"></small> 
                    </div>
                    <div class="form-input">
                    <label for="Email">Email :     </label><br>
                    <input type="text" class="real-input" name="Email" id="Email" placeholder="Enter your email" required/>
                    <small class="formContactError"></small> 
                    </div>
                    <div class="form-input">
                        <div class="Gender">
                            <div> <label>Gender :     </label> </div>
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
                        <label for="BirthDate">Birth date :     </label><br>
                        <input class="real-input" type="date" name="BirthDate" id="BirthDate" required/> 
                        <small class="formContactError"></small> 
                    </div>
                    <div class="form-input">
                        <label for="job">Job :     </label><br>
                        <select class="real-input" name="job" id="job" required>
                            <option value="">-- Select your status --</option>
                            <option value="Manager">Manager</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Engineer">Engineer</option>
                            <option value="Professor">Professor</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="Object">Object :     </label><br>
                        <input  type="text" class="real-input" name="Object" id="Object" placeholder="Enter the mail object" minlength="1" maxlength="50" required/>
                        <small class="formContactError"></small>  
                    </div>
                    <div class="form-input">
                        <label for="Content">Content :     </label><br>
                        <textarea class="real-input" name="Content" id="Content" cols="33" placeholder="Enter mail content" required></textarea>
                        <small class="formContactError"></small>  
                    </div>
                    <div class="form-input">
                        <input type="submit" name="submitContact" id="submitContact" value="Send Email"/>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
        include "commons/footer.html"
    ?>
</body>

</html>