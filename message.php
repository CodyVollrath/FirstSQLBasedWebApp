<?php
require_once "post.php";
function getMessagesForUser($username){
    $messageCon = OpenCon();
    $messageQuery = 'SELECT username FROM messages WHERE username="$username"';
    $result = $messageCon->query($messageQuery);
    if($result){
        if(mysqli_num_rows($result)>=1){
            while($messageData = $result->fetch_assoc()){
                echo $messageData['message'];
            }
        }
    }
    else{
        echo'noData';
    }
}

function displayMessages($username){
    getMessagesForUser($username);
    echo "<div class = 'messageContainment'>
            <div class = 'userBar'>User101</div>
                <div class ='grey-message'>
                    fine

                </div>
            <div class = 'userBar'>
                $username
            </div>
            <div class = 'green-message'>
                how are you?<br>
            </div>
            </div>
        ";
}

?>