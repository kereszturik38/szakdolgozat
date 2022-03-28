<?php


class Post implements JsonSerializable
{
    private int $post_id;
    private int $post_uid;
    private string $title;
    private string $description;
    private int $bookmark_count;
    private int $comment_count;
    private string $timestamp;
    private int $visible;
    private string $type;





    function filterByPID($post_id, $conn)
    {
        $this->update_bookmarks($post_id, $conn);
        $this->update_comments($post_id, $conn);

        $stmt = $conn->prepare("SELECT * FROM post WHERE post_id LIKE ?");
        $stmt->bind_param("i", $post_id);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            if($results->num_rows == 0) return false;

            while ($row = $results->fetch_assoc()) {
                $this->post_id = $post_id;

                $this->post_uid = $row["uid"];
                $this->title = $row["title"];
                $this->description = $row["description"];
                $this->bookmark_count = $row["bookmark_count"];
                $this->comment_count = $row["comment_count"];
                $this->timestamp = $row["timestamp"];
                $this->visible = $row["visible"];
                $this->type = $row["type"];
            }
            return true;
        }else{ return false; }
        $stmt->close();
    }


    function upload(int $uid, string $title, string $description, int $visible, string $type, $conn)
    {
        if($type === "") return;
        $stmt = $conn->prepare("INSERT INTO post(post.uid,title,description,visible,type) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issis", $uid, $title, $description, $visible, $type);

        if ($stmt->execute()) {
            $this->post_id = $stmt->insert_id;
            $this->filterByPID($this->post_id, $conn);
            return 0;
        } else {
            return 1;
        }
        $stmt->close();
    }

    function delete(int $post_id, $conn)
    {
        $stmt = $conn->prepare("DELETE FROM post WHERE post_id = ?");
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            return 0;
        } else {
            return 1;
        }
        $stmt->close();
    }

    function filterByTitle(string $title,int $offset,int $postsPerPage,$conn)
    {
        

        $stmt = $conn->prepare("SELECT * FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE ? AND VISIBLE=1 LIMIT ?,?");
        $stmt->bind_param("sii", $title,$offset,$postsPerPage);

        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function filterByType(string $title, string $type,int $offset, int $postsPerPage,$conn)
    {
        $stmt = $conn->prepare("SELECT * FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE ? AND type LIKE ? AND VISIBLE=1 LIMIT ?,?");
        $stmt->bind_param("ssii", $title, $type,$offset,$postsPerPage);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }
    function filterByUploader(int $offset, int $postsPerPage,$conn,$username=null,$uid = null)
    {
        if($username === null){
            $username = "%";
        }if($uid === null){
            $uid = "%";
        }

        $stmt = $conn->prepare("SELECT * FROM post INNER JOIN user ON post.uid = user.uid WHERE username LIKE ? AND post.uid LIKE ? AND VISIBLE=1 LIMIT ?,?");
        $stmt->bind_param("ssii",$username,$uid,$offset,$postsPerPage);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function filterPrivate(string $user=null,int $offset, int $postsPerPage,$conn)
    {
        if($user===null){
            $user = "%";
        }
        $stmt = $conn->prepare("SELECT * FROM post INNER JOIN user ON post.uid = user.uid WHERE visible=0 AND post.uid LIKE ? LIMIT ?,?");
        $stmt->bind_param("sii",$user,$offset,$postsPerPage);

        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function get_number_of_bookmark_pages($postsPerPage,$conn,$user=null){
        if($user === null){
            $user = "%";
        }
        

        $stmt = $conn->prepare("SELECT CEIL(COUNT(post_id)/?) as 'pages' from bookmarks WHERE uid LIKE ?");
        $stmt->bind_param("is",$postsPerPage,$user);
        if ($stmt->execute()){
            $result = $stmt->get_result()->fetch_assoc();
            $pages = $result["pages"];
            return $pages;
        }else{
            $pages = 1;
            return $pages;
        }
    }

    function get_number_of_pages($postsPerPage,$conn,$title=null,$type=null,$visible=null,$user=null,$username=null){
        if($title === null){
            $title = "%";
        }
        if($type === null){
            $type = "%";
        }
        if($user === null){
            $user = "%";
        }
        if($visible === null){
            $visible = 1; // 1 = true;
        }if($username === null){
            $username="%";
        }

        $stmt = $conn->prepare("SELECT CEIL(COUNT(post_id)/?) as 'pages' from post INNER JOIN user on post.uid = user.uid WHERE title LIKE ? AND type LIKE ? AND post.uid LIKE ? AND username LIKE ? AND visible=?");
        $stmt->bind_param("issssi",$postsPerPage,$title,$type,$user,$username,$visible);
        if ($stmt->execute()){
            $result = $stmt->get_result()->fetch_assoc();
            $pages = $result["pages"];
            return $pages;
        }else{
            $pages = 1;
            return $pages;
        }
    }

    function set_visibility($post_id,$visibility,$conn){
        $stmt = $conn->prepare("UPDATE post SET visible=? WHERE post_id=?");
        $stmt->bind_param("ii", $visibility,$post_id);

        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
        $stmt->close();
    }
    


    function get_popular(int $limit, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM post WHERE visible=1 ORDER BY bookmark_count DESC LIMIT ?");
        $stmt->bind_param("i", $limit);

        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function get_bookmarks(int $uid,int $offset,int $postsPerPage,$conn)
    {

        $bookmarks = array();

        $stmt = $conn->prepare("SELECT post_id FROM bookmarks WHERE uid = ? LIMIT ?,?");
        $stmt->bind_param("iii", $uid,$offset,$postsPerPage);

        if ($stmt->execute()) {
            $results = $stmt->get_result();
            while ($row = $results->fetch_assoc()) {
                $this->post_id = $row["post_id"];
                $this->filterByPID($row["post_id"], $conn);
                array_push($bookmarks, clone $this);
            }
        }
        return $bookmarks;
        $stmt->close();
    }

    function update_bookmarks(int $post_id, $conn)
    {
        $stmt = $conn->prepare("UPDATE post SET bookmark_count =(SELECT COUNT(post_id) FROM bookmarks WHERE post_id=?) WHERE post_id=?");
        $stmt->bind_param("ii", $post_id,$post_id);
        if ($stmt->execute()) {
            $stmt2 = $conn->prepare("SELECT bookmark_count FROM post WHERE post_id=?");
            $stmt2->bind_param("i",$post_id);
            if($stmt2->execute()){
                $result = $stmt2->get_result();
                while ($row = $result->fetch_assoc()) {
                    $this->bookmark_count = $row["bookmark_count"];
                }
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }
        $stmt->close();
    }

    function update_comments(int $post_id, $conn)
    {
        $stmt = $conn->prepare("UPDATE post SET comment_count =(SELECT COUNT(post_id) FROM comment WHERE post_id=?) WHERE post_id=?");
        $stmt->bind_param("ii", $post_id,$post_id);
        if ($stmt->execute()) {
            $stmt2 = $conn->prepare("SELECT comment_count FROM post WHERE post_id=?");
            $stmt2->bind_param("i",$post_id);
            if($stmt2->execute()){
                $result = $stmt2->get_result();
                while ($row = $result->fetch_assoc()) {
                    $this->comment_count = $row["comment_count"];
                }
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }
        $stmt->close();
    }

    function is_bookmarked(int $uid, int $post_id, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM bookmarks WHERE uid =? AND post_id=?");
        $stmt->bind_param("ii", $uid, $post_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $stmt->close();
    }

    function bookmark(int $uid, int $post_id, $conn)
    {
        $stmt = $conn->prepare("INSERT INTO bookmarks (uid,post_id) VALUES (?,?)");
        $stmt->bind_param("ii", $uid, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    function remove_bookmark(int $uid, int $post_id, $conn)
    {
        $stmt = $conn->prepare("DELETE FROM bookmarks WHERE uid=? AND post_id=?");
        $stmt->bind_param("ii", $uid, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    function update_description($description,$post_id, $conn)
    {
        if($post_id === null) return false;

        $stmt = $conn->prepare("UPDATE post SET description = ? WHERE post_id LIKE ?");
        $stmt->bind_param("si", $description, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    function update_title($title,$post_id, $conn)
    {
        if($post_id === null) return false;

        $stmt = $conn->prepare("UPDATE post SET title = ? WHERE post_id LIKE ?");
        $stmt->bind_param("si", $title, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }


    function get_post_id()
    {
        if(isset($this->post_id)){
            return $this->post_id;
        }
        
    }

    function get_post_uid()
    {
        if(isset($this->post_uid)){
            return $this->post_uid;
        }
        
    }

    function get_title()
    {
        if(isset($this->title)) return $this->title;
    }

    function get_description()
    {
        if(isset($this->description)) return $this->description;
    }

    function get_bookmark_count()
    {
        if(isset($this->bookmark_count)) return $this->bookmark_count;
    }
    function get_comment_count()
    {
        if(isset($this->comment_count)) return $this->comment_count;
    }
    function get_timestamp()
    {
        if(isset($this->timestamp)) return $this->timestamp;
    }
    function get_visible()
    {
        if(isset($this->visible)) return $this->visible;
    }
    function get_type()
    {
        if(isset($this->type)) return $this->type;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
