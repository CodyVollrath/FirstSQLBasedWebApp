<?php
$targetDir = "pictures/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;

if(isset($_POST["TBA"])){
    checkIfImageisImage();
}

//Check if image is an actual image
function checkIfImageisImage(){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false){
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
    else{
        echo "File is not an image.";
    }
}
?>