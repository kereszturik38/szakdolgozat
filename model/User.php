<?php

class User
{
    private int $uid;
    private string $username;
    private string $email;
    private int $level;

    function register($username, $email, $password, $conn)
    {
        $stmt = $conn->prepare("INSERT INTO user (username,email,password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute() === TRUE) {
            return true;
        }else{
            return false;
        }
    }

    function verify($username,$password,$conn)
    {
        $stmt = $conn->prepare("SELECT uid,username,password,level FROM user WHERE username LIKE ? AND password LIKE ?");
        $stmt->bind_param("ss", $username,$password);
        $stmt->execute();
        $results = $stmt->get_result();

        return $results;
    }



    function get_uid()
    {
        return $this->uid;
    }

    function get_username()
    {
        return $this->username;
    }

    function get_email()
    {
        return $this->email;
    }
    function get_level()
    {
        return $this->level;
    }
}
