<?php
    session_start();
    $salt = $_GET['salt'];
    echo $salt;
    if(isset($_SESSION['cid']))
    {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['join']);
        unset($_SESSION['cfname']);
        unset($_SESSION['cid']);
        unset($_SESSION['table']);
        header('location: ../Front-end pages/Home.html');
    }
?>