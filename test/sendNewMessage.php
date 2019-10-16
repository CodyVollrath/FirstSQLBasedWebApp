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
              addsContacts($senderName,$receiver,$conn);
              //Reverse the order so that they are in sync
              addsContacts($receiver,$senderName,$conn);
              $sendMessage = "INSERT INTO messages(`id`,`username`,`message`,`datetime`,`contact`) VALUES('','$senderName','$message','$date','$receiver')";
              if($messageConnection = $conn->query($sendMessage)){
                echo"<h1>It worked</h1>";
              }
              else{
                echo"<h1>It did not work</h1>";
              }
          }
          else{
            echo'<h1>Adjust Post Conditions</h1>';
          }
          closeCon($conn);
          }
          //Find a way to test if username and contact are already in the database and keep it in sync: if it is, then ignore the insert
          function addsContacts($username,$contact,$conn){
              $addToContactsQuery = "INSERT INTO contacts(`id`,`username`,`contact`) VALUES('','$username','$contact')";
              if($contactConnection = $conn->query($addToContactsQuery)){
                echo"<h1>It worked (Contacts)</h1>";
              }
              else{
                echo"<h1>It did not work (Contacts)</h1>";
              }
          }
           
?>