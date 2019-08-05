<?php
    include 'post.php';
    require_once 'Mail.php';
    function emailUser($address,$user){
      //From
      $from = '950doenut.buff@gmail.com';
      $to = "$address";
      $subject = "Verification";
      $msg = "This a test email to verify your registration. You username is $user";

      $headers = array('From' => $from,'To'=> $to,"Subject" => $subject);
      $smtp = Mail::factory('smtp',array('host'=> 'ssl://smtp.gmail.com',
      'port'=>'465', 'auth'=> true,'username' => '950doenut.buff@gmail.com','password' => 'password'));
      
      //Send email
      $mail = $smtp -> send($to,$headers,$msg);
      if(PEAR::isError($mail)){
        echo"<h1> . $mail->getMessage() . </h1>";
      }
      else{
        echo"<h1 align='Center'>An email will be sent to you for verification</h1>";
      }
    }
    if(isset($_POST['submitButton'])){
        $userName =  strtolower($_POST['username']);
        $password = strtolower($_POST['password']);
        $email = strtolower($_POST['email']);
        $phone =  strtolower($_POST['phone']);
        
        $connection=OpenCon();
        $query = "SELECT username FROM users WHERE username='$userName'";
        
        //Attemp at prepared statement concerning insert statements
        $insert = $connection->prepare("INSERT INTO users(id,username,password,email,phone) VALUES(?,?,?,?,?)");
        $insert->bind_param('',$userName,$password,$email,$phone);
        
        //Attemp at prepared statement concerning select statements
        $query = $connection->prepare("SELECT username FROM users WHERE username = ?");
        $query->bind_param($username);
        
        if($userCheck = $query->execute()){
          if(mysqli_num_rows($userCheck)>= 1){
            echo"Username already exists: <br>";
            $goBack = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo"<a href='$goBack'>Go Back</a>";
          }
          else{
            if($request = $insert->execute()){
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
