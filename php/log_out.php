<!-- From any page: log out and redirecte to the home page -->

<?php
    session_start();
    session_unset();
    header('Location: /index.php');
?>