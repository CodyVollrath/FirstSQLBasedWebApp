<?php

$fileName = $_FILES['file']['name'][0];
$path = $_FILES['file']['tmp_name'][0];
if(isset($fileName)){
    if(!empty($fileName)){
        $location = '../images/';
        if(move_uploaded_file($path,$location.$fileName)){
            echo 'File upload successfully';
        }
    }
} else{
    echo "Select a file!!";
}

?>