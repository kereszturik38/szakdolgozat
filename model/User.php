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

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    function verify($username, $password, $conn)
    {
        $stmt = $conn->prepare("SELECT uid,username,email,level FROM user WHERE username LIKE ? AND password LIKE ?");
        $stmt->bind_param("ss", $username, $password);


        if ($stmt->execute()) {
            $results = $stmt->get_result();
            if ($results->num_rows === 0) {
                echo "<div class='alert alert-danger text-center' role='alert'>Invalid username or password combination.</div>";
            } else {
                while ($row = $results->fetch_assoc()) {
                    $this->uid = $row["uid"];
                    $this->username = $row["username"];
                    $this->email = $row["email"];
                    $this->level = $row["level"];
                }
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>Something has gone wrong.Try again.</div>";
        }
        $stmt->close();
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
