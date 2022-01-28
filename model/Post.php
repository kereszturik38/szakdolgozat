<?php


class Post
{
    private int $post_id;
    private string $uploader;
    private string $title;
    private int $bookmark_count;
    private int $comment_count;
    private string $timestamp;
    private bool $visible;
    private string $type;


    function upload($uid,string $uploader,string $title,bool $visible,$conn)
    {
        $stmt = $conn->prepare("INSERT INTO post (post.uid,uploader,title,visible) VALUES (?,?,?,?)");
        $stmt->bind_param("sssb",$uid,$uploader,$title,$visible);
        $stmt->execute();
        $results = $stmt->get_result();
        if ($results->num_rows > 0) return $results;
    }

    function filterByTitle(string $title, $conn)
    {

        $stmt = $conn->prepare("SELECT post_id,post.uid,username,title,bookmark_count,comment_count,timestamp,visible,type FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE ?");
        $stmt->bind_param("s",$title);
        $stmt->execute();
        $results = $stmt->get_result();
        if ($results->num_rows > 0) return $results;
        
    }

    function filterByType(string $title,string $type, $conn)
    {
        $stmt = $conn->prepare("SELECT post_id,post.uid,username,title,bookmark_count,comment_count,timestamp,visible,type FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE ? AND type LIKE ?");
        $stmt->bind_param("ss",$title,$type);
        $stmt->execute();
        $results = $stmt->get_result();
        if ($results->num_rows > 0) return $results;
        
    }

    function get_post_id()
    {
        return $this->post_id;
    }

    function get_uid()
    {
        return $this->uid;
    }
    function get_uploader()
    {
        return $this->uploader;
    }

    function get_title()
    {
        return $this->title;
    }

    function get_bookmark_count()
    {
        return $this->bookmark_count;
    }
    function get_comment_count()
    {
        return $this->comment_count;
    }
    function get_timestamp()
    {
        return $this->timestamp;
    }
    function get_visible()
    {
        return $this->visible;
    }
    function get_type()
    {
        return $this->type;
    }
}
