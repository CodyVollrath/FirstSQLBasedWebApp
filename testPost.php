<?php
    // This how you hack our site
    function OpenCon(){
        $host="localhost";
        $dbUser="root";
        $dbpass = "";
        $db = "privatemessage";

        $conn = new mysqli($host,$dbUser,$dbpass,$db) or die("Connect Failed: %s\n".$conn -> error);
        return $conn;
    }
    function CloseCon($conn){
        $conn -> close();
    }
?>