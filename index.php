<?php
include "inc/db.php";

session_start();
$page = 'index';

$menupontok = array(    'index' => "Home", 
                        'upload' => "Upload",
                        'settings' => "Settings"
                );

$title = $menupontok[$page];



include "inc/htmlheader.php";

include "inc/htmlnav.php";
include "controller/" . $page . "_controller.php";


include "inc/footer.php";
?>

