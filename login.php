<?php
    include "post.php";
    $connection = openCon();
    session_start();
    //Check if submit button was pressed
    if(isset($_POST['submitButton'])){
        //Declare variables and convert to lowercase except for password
        $userName = strtolower($_POST['username']);
        $password = $_POST['password'];

        //Prepare statement
        $userName = $connection->real_escape_string($userName);
        $password = $connection->real_escape_string($password);

        $query = "SELECT username,`password` FROM users WHERE username = '$userName'";
        $checkCreds = $connection->query($query);
        if($checkCreds){
            if(mysqli_num_rows($checkCreds)== 1){
                $result = $checkCreds->fetch_object();
                $dbPassword = $result->password;
                $pwdCheck = password_verify($password,$dbPassword);
                if($pwdCheck){
                    
                    $_SESSION['username'] = $userName;
                    $_SESSION['password'] = $password;
                    header("Location: main.php");
                }
                else{
                    echo"Check Password";
                }
            }
            else{
                echo"Check username and password";
                $goBack = htmlspecialchars($_SERVER['HTTP_REFERER']);
                echo"<br><a href='$goBack'>Go Back</a>";
            }
        }
        else{
            echo"ERROR";
        }
    }
    CloseCon($connection);
?>