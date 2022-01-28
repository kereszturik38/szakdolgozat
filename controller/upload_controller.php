<?php
include "model/Post.php";

enum LevelUploadLimit{
    
}

if(isset($_POST["submit"])){



    $title = $_POST["title"];
    $file = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));

    $p = new Post();



    

}


include "view/upload.php";

?>