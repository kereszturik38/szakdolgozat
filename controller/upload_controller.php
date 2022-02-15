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
    $errorMsg = "";
    $uploadType = "";
    if (in_array($fileType, $IMAGE_TYPES)) {
        $uploadType = "image/" . $fileType;
        $realImage = @is_array(getimagesize($_FILES["fileToUpload"]["tmp_name"]));
        if ($realImage === false) {
            $errorMsg .= " file is not an image ";
            $uploadOK = 0;
        }
    } else if (in_array($fileType, $VIDEO_TYPES)) {
        $uploadType = "video/" . $fileType;
    } else {
        $errorMsg .= "File type is not supported.";
        $uploadOK = 0;
    }



    $p = new Post();
    if ($p->upload($_SESSION["uid"], $title, $public, $uploadType, $conn) === 0) {

        $upload_dir = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/";
        if (is_dir($upload_dir)) {
            $uploadOK = 0;
        }
        $upload_target = $upload_dir .  $p->get_post_id() . "." . $fileType;

        if (file_exists($upload_target)) {
            $errorMsg .= "File already exists.";
            $uploadOK = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]) {
            $errorMsg .= " File is too large for your level.";
            $errorMsg .= " Your file size is: " . $_FILES["fileToUpload"]["size"]/1000000 . "mb while your upload limit is " . $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]/1000000 . "mb.";
            $uploadOK = 0;
          } 

        if ($uploadOK === 0) {
            echo "<div class='alert alert-danger text-center' role='alert'>Upload failed." . $errorMsg . "</div>";
            $p->delete($p->get_post_id(), $conn);
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
        echo "<div class='alert alert-danger text-center' role='alert'>Upload failed." . $errorMsg . "</div>";
        $p->delete($p->get_post_id(), $conn);
    }
}


include "view/upload.php";
