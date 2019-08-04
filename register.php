<?php
    include 'post.php';
    if(isset($_POST['submitButton'])){
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        //SUPER VULNERABLE TO SQL INJECTIONS FIX LATER
        $insert = "INSERT INTO users(`id`,`username`,`password`,`email`,`phone`)
                VALUES('','$userName','$password','$email','$phone')";
        $connection=OpenCon();
        if($request = $connection->query($insert)){
          echo"New Record created";
        }
      else{
        echo"Error Connecting";
      }

        CloseCon($connection);
    }

?>