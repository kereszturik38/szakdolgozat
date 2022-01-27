<?php


if(isset($_POST["submit"])){
    echo "is set";
    $title = $_POST["title"];

    echo $title;

    $sql = "INSERT INTO post (uid,title) VALUES (2314,'". $title . "')";
    $conn->query($sql);
}


include "view/upload.php";

?>