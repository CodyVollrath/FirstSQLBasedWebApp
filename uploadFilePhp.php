<?php
if(isset($_POST["submit"])){
    $fileName = $_FILES['file']['name'];
    $path = $_FILES['file']['tmp_name'];
    if(isset($fileName)){
        if(!empty($fileName)){
            $location = 'images/';
            if(move_uploaded_file($path,$location.$fileName)){
                echo 'File upload successfully';
            }
        }
    } else{
        echo "Select a file!!";
    }
}
else{
    echo "HIT";
}

?>