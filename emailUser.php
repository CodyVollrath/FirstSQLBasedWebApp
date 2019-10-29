<?php
require_once 'Mail.php';
    //Email users
    function emailUser($address,$user){
      //From
      $from = '950doenut.buff@gmail.com';
      $to = "$address";
      $subject = "Verification";
      $msg = "You username is $user";

      $headers = array('From' => $from,'To'=> $to,"Subject" => $subject);
      $smtp = Mail::factory('smtp',array('host'=> 'ssl://smtp.gmail.com',
      'port'=>'465', 'auth'=> true,'username' => '950doenut.buff@gmail.com','password' => 'PASSWORD'));
      
      //Send email
      $mail = $smtp -> send($to,$headers,$msg);
      if(PEAR::isError($mail)){
        echo"<h1> . $mail->getMessage() . </h1>";
      }
      else{
        echo"<h1 align='Center'>An email will be sent to you for verification</h1>";
      }
    }
?>
