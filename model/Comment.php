<?php

// JSON válaszra átalakítás miatt szükséges a JsonSerializable

class Comment implements JsonSerializable
{
    private int $comment_id;
    private int $uid;
    private string $username;
    private int $post_id;
    private string $text;
    private string $time_commented;

    // Komment beszúrása a kommentek táblába
    // Output: true vagy false


    static function leaveComment($post_id,$uid,$text,$conn){
        $stmt = $conn->prepare("INSERT INTO comment (uid,post_id,text) VALUES (?,?,?)");
        $stmt->bind_param("iis", $uid,$post_id,$text);
        if ($stmt->execute()) {
            $stmt = $conn->prepare("UPDATE post SET comment_count = (SELECT COUNT(*) FROM comment WHERE comment.post_id = post.post_id) WHERE post.post_id = ?");
            $stmt->bind_param("i",$post_id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
            $stmt->close();
        }
        $stmt->close();
    }

    // Kommentek törlése az adatbázisból
    // Output: true vagy false

    static function remove_comments($commentArray,$conn){
        if(sizeof($commentArray) != 0){

            $loopOk = true;

            foreach($commentArray as $comment){
                if(!$loopOk){ break; }
                $stmt = $conn->prepare("DELETE FROM comment WHERE comment_id =?");
                $stmt->bind_param("i", $comment);
                if($stmt->execute()){
                    continue; //success
                }else{
                    $loopOk = false;
                    break; //fail
                }
            }
            if($loopOk === true){
                return true;
            }
        } else{
            return false;
        }
    }

    // Adott felhasználó és poszt alapján szűrés kommentekre
    // Output: true vagy false

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
            return true;
        }else{
            return false;
        }
        $stmt->close();
    }

    // Adott posztra vonatkozó kommentek lekérése
    // Output: Kommentek tömb (üres vagy kommenteket tartalmazó)

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

    // Getterek

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

    // A JSON válaszokhoz szükséges serialize függvény

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
