<?php
    session_start();
    // unset($_SESSION['login']);
    session_unset();
    header('Location: /index.php');
?>