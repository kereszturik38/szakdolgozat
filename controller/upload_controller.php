<?php
include "model/Post.php";

$UPLOAD_LIMIT_BY_LEVEL = array(
    "1" => 5000000, // 5mb
    "2" => 10000000, // 10mb
    "3" => 20000000 // 20mb
);

if (isset($_POST["submit"])) {


    $title = $_POST["title"];
    $file = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $public = isset($_POST["publicCheck"]) ? 1 : 0;

    $IMAGE_TYPES = array("png", "jpg", "bmp");
    $VIDEO_TYPES = array("mp4", "ogg", "mov");



    $uploadOK = 1;
    $uploadType = "";
    if (in_array($fileType, $IMAGE_TYPES)) {
        $uploadType = "image/" . $fileType;
        $realImage = @is_array(getimagesize($_FILES["fileToUpload"]["tmp_name"]));
        if ($realImage === false) {
            echo "<div class='alert alert-danger text-center' role='alert'>Upload failed. File is not an image</div>";
            $uploadOK = 0;
        }
    } else if (in_array($fileType, $VIDEO_TYPES)) {
        $uploadType = "video/" . $fileType;
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Upload failed. File type is not supported.</div>";
        $uploadOK = 0;
    }



    $p = new Post();
    if ($p->upload($_SESSION["uid"], $title, $public, $uploadType, $conn)) {

        $upload_dir = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/";
        if (is_dir($upload_dir)) {
            $uploadOK = 0;
        }
        $upload_target = $upload_dir .  $p->get_post_id() . "." . $fileType;

        if (file_exists($upload_target)) {
            echo "Sorry, file already exists.";
            $uploadOK = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]) {
            echo "Sorry, your file is too large.";
            echo "your file size: " . $_FILES["fileToUpload"]["size"];
            echo "your upload limit is: " . $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]];
            $uploadOK = 0;
          } 

        if ($uploadOK === 0) {
            echo "<div class='alert alert-danger text-center' role='alert'>Upload failed.</div>";
            $p->delete($p->get_post_id(), $conn);
            // if everything is ok, try to upload file
        } else if ($uploadOK === 1) {
            mkdir($upload_dir);
            if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_target)) {
                echo "<div class='alert alert-success text-center' role='success'>Upload successful.</div>";
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                $p->delete($p->get_post_id(), $conn);
                unlink($upload_dir);
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Upload failed.</div>";
    }
}


include "view/upload.php";
