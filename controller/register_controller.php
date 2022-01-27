<?php

var_dump($_POST);

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];

    $sql = "INSERT INTO user (username,email,password) VALUES (' " . $username . " ',' " . $email . " ',' " . $password . " ')";
    $conn->query($sql);

    $last_id = $conn->insert_id;
    echo "Succesfully registered user " . $username . " with uid " . $last_id;
}


include "view/register.php";
