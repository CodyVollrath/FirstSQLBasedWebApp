<!DOCTYPE html>
    <html>
      <head>
        <meta charset='UTF-8'>
        <title>Main</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
        <link rel ='stylesheet' href='register.css'>
      </head>
      <body>
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
                    $_SESSION['loginUsername'] = $userName;
                    $_SESSION['loginPassword'] = $password;
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

        <!-- JAVASCRIPT_CDN -->
        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
      </body>
</html>