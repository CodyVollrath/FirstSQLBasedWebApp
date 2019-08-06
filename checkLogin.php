<?php
    include "login.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header('HTTP/1.0 403 Forbidden', TRUE, 404);
    }
    else{
        header("Location:main.php");
    }
?>