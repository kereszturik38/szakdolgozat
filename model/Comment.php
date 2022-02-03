<?php
class Comment
{
    private int $comment_id;
    private int $uid;
    private int $post_id;
    private string $text;
    private string $time_commented;

    function commentsForPost($post_id, $uid = '%',$conn)
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


}



?>