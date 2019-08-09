<?php
function getMessages($username){
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
            <div id = 'textBar'>
                <input id = 'messageTextBar' placeholder='Message' name = 'messageInput' type='text'>
                <button id = 'send' name='sendButton'>SEND</button>
            </div>
        ";
}

?>