<?php
    include 'post.php';
    include 'emailUser.php';
    if(isset($_POST['submitButton'])){
      //Declare variables and convert data to lowercase except for password and phone
        $userName =  strtolower($_POST['username']);
        $password = $_POST['password'];
        $email = strtolower($_POST['email']);
        $phone =  ($_POST['phone']);

        //Create a mySQLI object written as OpenCon()
        $connection=OpenCon();

        //Prepare statements for SQL use:
        $userName = $connection->real_escape_string($userName);
        $password = $connection->real_escape_string($password);
        $email = $connection->real_escape_string($email);
        $phone =  $connection->real_escape_string($phone);

        //Hash the password for security
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        //Insert records into the database from the user entered fields
        $insert = "INSERT INTO users(`id`,`username`,`password`,`email`,`phone`)
                VALUES('','$userName','$hashedPassword','$email','$phone')";

        //Check for matching username
        $query = "SELECT username FROM users WHERE username='$userName'";

        //Check if user exists
        if($userCheck = $connection->query($query)){
          if(mysqli_num_rows($userCheck)>= 1){
            echo"Username already exists: <br>";
            $goBack = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo"<a href='$goBack'>Go Back</a>";
          }
          else{
            //Update database with user information
            if($request = $connection->query($insert)){
              emailUser($email,$userName);
              echo"<p align = 'Center'>New Record created</p><br>";
            }
          }
        }
        else{
            echo"Error Connecting";
        }
        CloseCon($connection);
    }
?>