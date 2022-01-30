<?php
include "model/Post.php";



if(isset($_POST["submit"])){


    $title = $_POST["title"];
    $file = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    $public = isset($_POST["publicCheck"]) ? 1 : 0;

    $uploadType = "image/" . $fileType;


    $p = new Post();
    $p->upload($_SESSION["uid"],$title,$public,$uploadType,$conn);


    $uploadOK = 1;
    
    
    //change 



    

}


include "view/upload.php";

?>