<?php


class Post
{
    private int $post_id;
    private int $post_uid;
    private string $title;
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
            while ($row = $results->fetch_assoc()) {
                $this->post_id = $post_id;

                $this->post_uid = $row["uid"];
                $this->title = $row["title"];
                $this->bookmark_count = $row["bookmark_count"];
                $this->comment_count = $row["comment_count"];
                $this->timestamp = $row["timestamp"];
                $this->visible = $row["visible"];
                $this->type = $row["type"];
            }
        }
        $stmt->close();
    }


    function upload(int $uid, string $title, int $visible, string $type, $conn)
    {
        $stmt = $conn->prepare("INSERT INTO post(post.uid,title,visible,type) VALUES (?,?,?,?)");
        $stmt->bind_param("isis", $uid, $title, $visible, $type);

        if ($stmt->execute()) {
            $this->post_id = $stmt->insert_id;
            $this->filterByPID($this->post_id, $conn);
            //echo "<div class='alert alert-success text-center' role='success'>Upload successful.</div>";
        } else {
            echo "upload failure";
        }
        $stmt->close();
    }

    function delete(int $post_id, $conn)
    {
        $stmt = $conn->prepare("DELETE FROM post WHERE post_id = ?");
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            //echo "<div class='alert alert-success text-center' role='success'>Upload successful.</div>";
        } else {
            //echo "<div class='alert alert-danger text-center' role='alert'>Upload failed.</div>";
        }
        $stmt->close();
    }

    function filterByTitle(string $title, $conn)
    {

        $stmt = $conn->prepare("SELECT post_id,post.uid,username,title,bookmark_count,comment_count,timestamp,visible,type FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE ?");
        $stmt->bind_param("s", $title);

        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function filterByType(string $title, string $type, $conn)
    {
        $stmt = $conn->prepare("SELECT post_id,post.uid,username,title,bookmark_count,comment_count,timestamp,visible,type FROM post INNER JOIN user ON post.uid = user.uid WHERE title LIKE ? AND type LIKE ?");
        $stmt->bind_param("ss", $title, $type);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function get_popular(int $limit, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM post ORDER BY bookmark_count LIMIT ?");
        $stmt->bind_param("i", $limit);

        if ($stmt->execute()) {
            $results = $stmt->get_result();
            return $results;
        }
        $stmt->close();
    }

    function get_bookmarks(int $uid, $conn)
    {

        $bookmarks = array();

        $stmt = $conn->prepare("SELECT post_id FROM bookmarks WHERE uid = ?");
        $stmt->bind_param("i", $uid);

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
        $stmt->bind_param("ii", $post_id, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    function update_comments(int $post_id, $conn)
    {
        $stmt = $conn->prepare("UPDATE post SET comment_count =(SELECT COUNT(post_id) FROM comment WHERE post_id=?) WHERE post_id=?");
        $stmt->bind_param("ii", $post_id, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
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


    function get_post_id()
    {
        return $this->post_id;
    }

    function get_post_uid()
    {
        return $this->post_uid;
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
