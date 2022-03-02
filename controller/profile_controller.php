<?php
include "model/User.php";

$u = new User();

if(isset($_GET["id"])){
    $profile = $_GET["id"];
    $u->filterByUID($profile,$conn);
    $postcount = $u->get_post_count($conn);
    include "view/profile.php";

}else if(isset($_SESSION["loggedIn"])){
    $profile = $_SESSION["uid"];
    $u->filterByUID($profile,$conn);
    $postcount = $u->get_post_count($conn);
    include "view/profile.php";
}else{
    header('location: index.php');
}







?>