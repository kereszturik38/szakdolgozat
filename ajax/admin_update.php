<?php
include  "../inc/db.php";
include "../model/User.php";

$u = new User();

if(isset($_POST["uid"])){
    if($u->is_admin($_POST["uid"],$conn)){ 
        die("User already admin");
    }else{
        $stmt = $conn->prepare("INSERT INTO admin (uid) VALUES (?)");
        $stmt->bind_param("i", $_POST["uid"]);
        if ($stmt->execute()) {
            echo "Success";
        } else {
            $stmt->close();
            die("Database error");
        }
        $stmt->close();
    }
}else{
    die("UID not set");
}
