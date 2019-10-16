
<form method='POST' action='testInsertIntoDatabase.php'>
    <label for="contactName">Name Of Contact</label>
    <input type="username" name ='contactname' onkeyup="checkInDB()" list='users' id='contactName'placeholder='Enter a user'>
    <textarea name = 'messageArea' class='form-control' placeholder = 'Message' id = 'exampleFormControlTextArea1' rows = '3'></textarea>
    <input type ='submit' id ='sendRequest' class = '' name = 'sendRequest'>
</form>
<?php
require_once 'testPost.php';
  if(isset($_POST['sendRequest'])){
      $conn = openCon();
      $senderName = 'test';
      $receiver = $_POST['contactname'];
      $message = $_POST['messageArea'];
      date_default_timezone_set('america/new_york');
      $date = date('m/d/Y h:i');
      
      $senderName = $conn->real_escape_string($senderName);
      echo"$senderName<br>";
      $receiver = $conn->real_escape_string($receiver);
      echo"$receiver<br>";
      $message = $conn->real_escape_string($message);
      echo"$message<br>";
      $date = $conn->real_escape_string($date);
      echo"$date<br>";
      $sendMessage = "INSERT INTO messages(`id`,`username`,`message`,`datetime`,`contact`) VALUES('','$senderName','$message','$date','$receiver')";
      if($messageConnection = $conn->query($sendMessage)){    
        echo"it worked";
      }
      else{
        var_dump($messageConnection);
      }
  }
  else{
    echo'Hellow';
  }
  closeCon($conn);
?>