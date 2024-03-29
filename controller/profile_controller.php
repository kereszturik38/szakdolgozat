<?php
include "model/User.php";

$u = new User();


if (isset($_GET["id"])) {
    $profile = $_GET["id"];

    if (file_exists("pfp/{$profile}.png")) {
        $pfp = "pfp/{$profile}.png";
    } else {
        $pfp = "pfp/default.png";
    }

    if ($u->filterByUID($profile, $conn)) {
        $postcount = $u->get_post_count($conn);
        include "view/profile.php";
    } else {
        include "view/404.php";
    }
} else if (isset($_SESSION["loggedIn"])) {
    $profile = $_SESSION["uid"];

    if (file_exists("pfp/{$profile}.png")) {
        $pfp = "pfp/{$profile}.png";
    } else {
        $pfp = "pfp/default.png";
    }

    if ($u->filterByUID($profile, $conn)) {
        $postcount = $u->get_post_count($conn);
        include "view/profile.php";
    } else {
        include "view/404.php";
    }
} else {
    header('location: index.php');
}
