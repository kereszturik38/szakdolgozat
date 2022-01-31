<?php
include "model/Post.php";



if (isset($_POST["submit"])) {


    $title = $_POST["title"];
    $file = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $public = isset($_POST["publicCheck"]) ? 1 : 0;

    $uploadType = "image/" . $fileType;


    $p = new Post();
    $p->upload($_SESSION["uid"], $title, $public, $uploadType, $conn);

    $uploadOK = 1;

    $upload_dir = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/";
    if(is_dir($upload_dir)){
        $uploadOK = 0;
    }else{
        mkdir($upload_dir);
    }
    $upload_target = $upload_dir .  $p->get_post_id() . "." . $fileType;


    $realImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($realImage === false) {
        echo "<div class='alert alert-danger text-center' role='alert'>Upload failed. File is not an image</div>";
        $uploadOK = 0;
    }
    if (file_exists($upload_target)) {
        echo "Sorry, file already exists.";
        $uploadOK = 0;
    }
    if ($uploadOK === 0) {
        echo "<div class='alert alert-danger text-center' role='alert'>Upload failed.</div>";
        // if everything is ok, try to upload file
    } else {
        if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$upload_target)) {
            echo "<div class='alert alert-success text-center' role='success'>Upload successful.</div>";
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            $p->delete($p->get_post_id(),$conn);
            echo "Sorry, there was an error uploading your file.";
        }
    }



        //change 





    }


    include "view/upload.php";

