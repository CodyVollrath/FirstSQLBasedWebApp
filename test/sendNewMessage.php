<?php
    sendNewMessage();
          function sendNewMessage(){
            require_once "login.php";
            if(isset($_POST['sendRequest'])){
              $conn = openCon();
              $senderName = $_SESSION['loginUsername'];
              $receiver = $_POST['contactname'];
              $message = $_POST['messagearea'];
              date_default_timezone_set('america/new_york');
              $date = date('m/d/Y h:i');
              
              $senderName = $conn->real_escape_string($senderName);
              $receiver = $conn->real_escape_string($receiver);
              $message = $conn->real_escape_string($message);
              $date = $conn->real_escape_string($date);
              $sendMessage = "INSERT INTO messages(`id`,`username`,`message`,`datetime`,`contact`) VALUES('','$senderName','$message','$date','$receiver')";
              if($messageConnection = $conn->query($sendMessage)){ 
                echo"it worked";
              }
              else{
                echo"<h1>It did not work</h1>";
              }
          }
          else{
            echo'<h1>Adjust Post Conditions</h1>';
          }

          }
           
?>