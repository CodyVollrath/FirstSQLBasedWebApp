<?php
require_once 'post.php';
$fileName = $_FILES['file']['name'];
$fileName = str_replace(" ","_",strtolower($fileName));
var_dump($fileName);
$path = $_FILES['file']['tmp_name'];
$username = $_POST['user'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];
if(isset($fileName)){
    if(!empty($fileName)){
        $location = 'images/';
        $fullFileLocation = $location.$fileName;
        if(move_uploaded_file($path,$location.$fileName)){
            $messageCon = OpenCon();
            date_default_timezone_set('america/new_york');
            $date = date('m/d/Y h:i');
            $sendMessage = "INSERT INTO messages(`id`,`username`,`message`,`datetime`,`contact`,`file`) VALUES('','$username','$message','$date','$receiver','$fullFileLocation')";
            if($messageConnection = $messageCon->query($sendMessage)){
                echo 'File upload successfully';
            }
            closeCon($messageCon);           
        }
    }
} else{
    echo "Select a file!!";
}

?>