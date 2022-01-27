<?php

var_dump($_POST);

if(isset($_POST["username"])) {

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];

    $sql = "INSERT INTO user (username,email,password) VALUES ('". $username . "','" . $email . "','" . $password . "')";
    if($conn->query($sql) === TRUE){
        $last_id = $conn->insert_id;

        echo "Succesfully registered user " . $username . " with uid " . $last_id;
    }

    
}


include "view/register.php";

?>