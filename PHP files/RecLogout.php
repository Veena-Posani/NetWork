<?php
    session_start();
    if(isset($_SESSION['rid']))
    {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['join']);
        unset($_SESSION['rfname']);
        unset($_SESSION['rid']);
        unset($_SESSION['OrgID']);
        unset($_SESSION['table']);
        header('location: ../Front-end pages/Home.html');
    }
?>