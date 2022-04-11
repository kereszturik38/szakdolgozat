<?php

// JSON válaszra átalakítás miatt szükséges a JsonSerializable

class User implements JsonSerializable
{
    private int $uid;
    private string $username;
    private string $email;
    private int $level;

    
    //Felvesszük az adott felhasználó adatait az IDja alapján
    //Output:   true (az object felveszi a felhasználó adatait) vagy false

    function filterByUID($uid, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM user WHERE uid LIKE ?");
        $stmt->bind_param("i", $uid);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            if($results->num_rows == 0) return false;
            while ($row = $results->fetch_assoc()) {
                $this->uid = $uid;
                
                $this->username = $row["username"];
                $this->email = $row["email"];
                $this->level = $row["level"];
                
            }
            return true;
        }else{ return false; }
        $stmt->close();
    }

    // Használat: register_controller.php
    // Beszúr egy új felhasználót az adatbázisba
    // Output: true vagy false

    static function register($username, $email, $password, $conn)
    {
        $stmt = $conn->prepare("INSERT INTO user (username,email,password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    // Használat: login_controller.php
    // Login függvény,beléptet egy adott felhasználót
    // Output: 1 (hibás adat), 0 (sikeres belépés) vagy 2 (adatbázis hiba)

    function verify($username, $email,$password, $conn)
    {
        $stmt = $conn->prepare("SELECT uid,username,email,level FROM user WHERE username LIKE ? AND email LIKE ? AND password LIKE ?");
        $stmt->bind_param("sss", $username, $email,$password);


        if ($stmt->execute()) {
            $results = $stmt->get_result();
            if ($results->num_rows === 0) {
                return 1;
            } else {
                while ($row = $results->fetch_assoc()) {
                    $this->uid = $row["uid"];
                    $this->username = $row["username"];
                    $this->email = $row["email"];
                    $this->level = $row["level"];
                }
                return 0;
            }
        } else {
            return 2;
        }
        $stmt->close();
    }

    // Segédfüggvény,lekérdezi hogy az adott user ID szerepel-e az adminok táblában
    // Használata: az összes admin tevékenység 
    // Output: true vagy false

    static function is_admin(int $uid,$conn){
        $stmt = $conn->prepare("SELECT uid FROM admin WHERE uid=?");
        $stmt->bind_param("i", $uid);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // Használat: ajax/change_username.php
    // A felhasználónév változtatása 
    // Output: true vagy false

    static function set_username($uid,$conn,$newusername){
        $stmt = $conn->prepare("UPDATE user SET username=? WHERE uid=?");
        $stmt->bind_param("si",$newusername,$uid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Használat: ajax/change_password.php
    // Az adott felhasználó jelszavának egyeztetése egy input jelszóval
    // Output: true vagy false

    static function verify_password($uid,$conn,$password){
        $stmt = $conn->prepare("SELECT * FROM user WHERE uid=? AND password LIKE ?");
        $stmt->bind_param("is",$uid,$password);
        if($stmt->execute()){
            $result = $stmt->get_result()->num_rows;
            if ($result > 0){
                return true;
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    // Használat: ajax/change_password.php
    // A jelszó változtatása 
    // Output: true vagy false

    static function set_password($uid,$conn,$newpassword){
        $stmt = $conn->prepare("UPDATE user SET password=? WHERE uid=?");
        $stmt->bind_param("si",$newpassword,$uid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Használat: ajax/change_email.php
    // Az email változtatása 
    // Output: true vagy false

   static  function set_email($uid,$conn,$newemail){
        $stmt = $conn->prepare("UPDATE user SET email=? WHERE uid=?");
        $stmt->bind_param("si",$newemail,$uid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Használat: profile_controller.php
    // Segédfüggvény,az adott felhasználó poszt számát kérdezi le
    // Output: a felhasználó poszt száma vagy false

    function get_post_count($conn){
        if(!isset($this->uid)) return false;

        $stmt = $conn->prepare("SELECT COUNT(post_id) as postcount FROM post WHERE uid=? AND visible=1");
        $stmt->bind_param("i",$this->uid);
        if($stmt->execute()){
            $result =  $stmt->get_result()->fetch_assoc();
            return $result["postcount"];
        }else{
            return false;
        }
    }


    // Getterek

    function get_uid()
    {
        if(isset($this->uid)){
            return $this->uid;
        }
        
    }

    function get_username()
    {
        if(isset($this->username)) return $this->username;
    }

    function get_email()
    {
        if(isset($this->email)) return $this->email;
    }
    function get_level()
    {
        if(isset($this->level)) return $this->level;
    }

    // A JSON válaszokhoz szükséges serialize függvény

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
