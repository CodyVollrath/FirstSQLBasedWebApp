<?php
require_once "post.php";

if(isset($_POST['user'])){
    $username = $_POST['user'];
    $receiver = $_POST['contact'];
    displayMessages($username,$receiver);

}
else{
    if(isset($_POST['sendCurrent'])){
        $username = $_POST['userN'];
        $receiver = $_POST['contact'];
        $message=$_POST['messageData'];
        sendMessage($username,$receiver,$message);
    }
}

function getMessagesForUser($username,$receiver){
    $messageCon = OpenCon();
    $messageQuery = "SELECT * FROM `messages` WHERE `username`='$username' AND `contact` = '$receiver' OR `username` = '$receiver' AND `contact` = '$username'";
    
    $result = $messageCon->query($messageQuery);
    if($result){
        if(mysqli_num_rows($result)>=1){
            while($messageData=$result->fetch_assoc()){
                
                $userOrContact = $messageData['username'];
                $message = $messageData['message'];
                $date = $messageData['datetime'];
                if($userOrContact == $receiver){
                    echo "
                    <div class = 'userBar'>| $receiver | $date |</div>
                        <div class ='grey-message'>
                        $message
                        </div>";
                }
                else{
                    echo"<div class = 'userBar'>| $username | $date |</div>
                    <div class = 'green-message'>
                        $message
                    </div>";
                }

            }

        }
    }
    else{
        echo'<h3 align="center">Select a contact!</h3>';
    }
    closeCon($messageCon);
}
function sendMessage($username, $receiver, $message){
    if(isset($message)&&trim($message)!==''){
        $messageCon = OpenCon();
        date_default_timezone_set('america/new_york');
        $date = date('m/d/Y h:i');
        $sendMessage = "INSERT INTO messages(`id`,`username`,`message`,`datetime`,`contact`) VALUES('','$username','$message','$date','$receiver')";
        if($messageConnection = $messageCon->query($sendMessage)){
            echo"<h1>It worked</h1>";
        }
        else{
            echo"<h1>It DID NOT worked</h1>";
        }
    }
    
}

function displayMessages($username,$receiver){
    getMessagesForUser($username,$receiver);

}

?>