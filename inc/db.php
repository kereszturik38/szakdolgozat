<?php

/*
$server = "nebet.hu";
$db = "c31h202121";
$user = "kk";
$password = "hymWuShlkcIXD5ud";
*/

$conn = new mysqli($server, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>