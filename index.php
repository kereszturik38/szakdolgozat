<?php
include "inc/db.php";
include "inc/fetch_file.php";
include "inc/init_level.php";

session_start();

$UPLOAD_LIMIT_BY_LEVEL = array(
    "1" => 5000000, // 5mb
    "2" => 10000000, // 10mb
    "3" => 20000000 // 20mb
);

    $IMAGE_TYPES = array("png", "jpg", "bmp");
    $VIDEO_TYPES = array("mp4", "ogg", "mov");

include "inc/htmlheader.php";

include "inc/htmlnav.php";
include "controller/index_controller.php";

include "inc/footer.php";
?>

