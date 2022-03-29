<?php

class User implements JsonSerializable
{
    private int $uid;
    private string $username;
    private string $email;
    private int $level;

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

    static function set_username($uid,$conn,$newusername){
        $stmt = $conn->prepare("UPDATE user SET username=? WHERE uid=?");
        $stmt->bind_param("si",$newusername,$uid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

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

    static function set_password($uid,$conn,$newpassword){
        $stmt = $conn->prepare("UPDATE user SET password=? WHERE uid=?");
        $stmt->bind_param("si",$newpassword,$uid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

   static  function set_email($uid,$conn,$newemail){
        $stmt = $conn->prepare("UPDATE user SET email=? WHERE uid=?");
        $stmt->bind_param("si",$newemail,$uid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
