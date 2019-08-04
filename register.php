<?php
    include 'post.php';
    if(isset($_POST['submitButton'])){
        $userName =  strtolower($_POST['username']);
        $password = strtolower($_POST['password']);
        $email = strtolower($_POST['email']);
        $phone =  strtolower($_POST['phone']);
        //SUPER VULNERABLE TO SQL INJECTIONS FIX LATER
        $insert = "INSERT INTO users(`id`,`username`,`password`,`email`,`phone`)
                VALUES('','$userName','$password','$email','$phone')";
        //Use prepared statement in final version
        $query = "SELECT username FROM users WHERE username='$userName'";
        $connection=OpenCon();
      
        if($userCheck = $connection->query($query)){
          if(mysqli_num_rows($userCheck)>= 1){
            echo"Username already exists: <br>";
            $goBack = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo"<a href='$goBack'>Go Back</a>";
          }
          else{
            if($request = $connection->query($insert)){
              echo"New Record created";
            }
          }

        }
        else{
            echo"Error Connecting";
        }
        CloseCon($connection);
    }

?>