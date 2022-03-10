<?php

if (isset($_POST["submit"])) {


    $file = basename($_FILES["pfpToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    $uploadOK = 1;
    $errorMsg = "";
    $uploadType = "";
    if (in_array($fileType, $IMAGE_TYPES)) {
        $realImage = @is_array(getimagesize($_FILES["pfpToUpload"]["tmp_name"]));
        if ($realImage === false) {
            $errorMsg .= " file is not an image ";
            $uploadOK = 0;
        }
    } else {
        $errorMsg .= "File type is not supported.";
        $uploadOK = 0;
    }



    if ($uploadOK == 1) {

        $upload_target = "pfp/" .$_SESSION["uid"]. ".png";


        if ($_FILES["pfpToUpload"]["size"] > $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]) {
            $errorMsg .= " File is too large for your level.";
            $errorMsg .= " Your file size is: " . $_FILES["pfpToUpload"]["size"]/1000000 . "mb while your upload limit is " . $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]/1000000 . "mb.";
            $uploadOK = 0;
          } 

        if ($uploadOK === 0) {
            echo "<div class='alert alert-danger text-center' role='alert'>Upload failed." . $errorMsg . "</div>";
        } else if ($uploadOK === 1) {
            if (@move_uploaded_file($_FILES["pfpToUpload"]["tmp_name"], $upload_target)) {
                header('Location: index.php?page=profile');
            } else {
                unlink($upload_target);
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Upload failed." . $errorMsg . "</div>";
    }
}


include "view/pfp.php";
