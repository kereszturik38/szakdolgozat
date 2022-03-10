<?php
class Comment implements JsonSerializable
{
    private int $comment_id;
    private int $uid;
    private string $username;
    private int $post_id;
    private string $text;
    private string $time_commented;

    function leaveComment($post_id,$uid,$text,$conn){
        $stmt = $conn->prepare("INSERT INTO comment (uid,post_id,text) VALUES (?,?,?)");
        $stmt->bind_param("iis", $uid,$post_id,$text);
        if ($stmt->execute()) {
            $stmt = $conn->prepare("UPDATE post SET comment_count = (SELECT COUNT(*) FROM comment WHERE comment.post_id = post.post_id) WHERE post.post_id = ?");
            $stmt->bind_param("i",$post_id);
            if($stmt->execute()){
                return true;
            }
            $stmt->close();
        }
        $stmt->close();
    }

    function removeComment($post_id,$uid,$text,$conn){
        $stmt = $conn->prepare("INSERT INTO comment (uid,post_id,text) VALUES (?,?,?)");
        $stmt->bind_param("iis", $uid,$post_id,$text);
        if ($stmt->execute()) {
            $stmt = $conn->prepare("UPDATE post SET comment_count = (SELECT COUNT(*) FROM comment WHERE comment.post_id = post.post_id) WHERE post.post_id = ?");
            $stmt->bind_param("i",$post_id);
            if($stmt->execute()){
                return true;
            }
            $stmt->close();
        }
        $stmt->close();
    }

    function commentsForPIDAndUID($post_id, $uid,$conn)
    {
        $stmt = $conn->prepare("SELECT * FROM comment WHERE post_id LIKE ? AND uid LIKE ?");
        $stmt->bind_param("ii", $post_id,$uid);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            while ($row = $results->fetch_assoc()) {
                $this->comment_id = $row["comment_id"];
                $this->uid = $row["uid"];
                $this->post_id = $row["post_id"];
                $this->text = $row["text"];
                $this->time_commented = $row["time_commented"];
            }
        }
        $stmt->close();
    }

    function commentsForPID($post_id,$conn)
    {
        $allComments = array();
        $stmt = $conn->prepare("SELECT * FROM comment WHERE post_id LIKE ?");
        $stmt->bind_param("i", $post_id);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            while ($row = $results->fetch_assoc()) {
                $this->comment_id = $row["comment_id"];
                $this->uid = $row["uid"];
                $this->post_id = $row["post_id"];
                $this->text = $row["text"];
                $this->time_commented = $row["time_commented"];

                array_push($allComments,clone $this);
            }
            
        }
        return $allComments;
        $stmt->close();
    }

    function get_comment_id(){
        return $this->comment_id;
    }

    function get_uid(){
        return $this->uid;
    }

    function get_username(){
        return $this->username;
    }

    function set_username(string $username){
        $this->username = $username;
    }

    function get_post_id(){
        if(isset($this->post_id)) return $this->post_id;
    }

    function get_text(){
        if(isset($this->text)) return $this->text;
    }
    function get_time_commented(){
        if(isset($this->time_commented)) return $this->time_commented;
    }

    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}



?>