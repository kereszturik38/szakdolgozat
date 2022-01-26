<?php


class Post
{
    private int $post_id;
    private int $uid;
    private string $uploader;
    private string $title;
    private int $bookmark_count;
    private int $comment_count;
    private string $timestamp;
    private bool $visible;
    private string $type;


    function searchByPID(int $pid, $conn)
    {

        $sql = "SELECT *,username FROM post INNER JOIN user ON post.uid = user.uid WHERE post_id =" . $pid;

        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $this->post_id = $row["post_id"];
                $this->uid = $row["uid"];
                $this->uploader = $row["username"];
                $this->title = $row["title"];
                $this->bookmark_count = $row["bookmark_count"];
                $this->comment_count = $row["comment_count"];
                $this->timestamp = $row["timestamp"];
                $this->visible = $row["visible"];
                $this->type = $row["type"];
            }
        } else {
            echo $conn->error;
        }
        $conn->close();
    }

    function filterByTitle(string $title, $conn)
    {


        $sql = "SELECT post_id,post.uid,username,title,bookmark_count,comment_count,timestamp,visible,type FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE '%" . $title . "%'";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            return $result;
        } else {
            echo $conn->error;
        }

        $conn->close();
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
