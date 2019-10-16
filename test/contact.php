<?php
         require_once "post.php";
         $conn = openCon();
         if(isset($_POST['contactname'])){
             $requestedName = strtolower($_POST['contactname']);
             sendFriendRequest();
         }
       
         function sendFriendRequest(){
             global $conn,$requestedName;
             $requestedName = $conn->real_escape_string($requestedName);
             $contactQuery = "SELECT username FROM users where username = '$requestedName'";
             $checkDBForUser = $conn->query($contactQuery);
             if($checkDBForUser){
                 if(mysqli_num_rows($checkDBForUser)== 1){
                     $result = $checkDBForUser->fetch_object();
                     echo "<option value = '$result->username'>";
                 }
                 else{
                     echo"<option value = 'Not a user'>";
                 }
             }
         }
         function receiveFriendRequest(){

         }
         function disallowDuplicates(){

         }
         function acceptRequest(){

         }
         function declineRequest(){

         }
         closeCon($conn);
      ?>  