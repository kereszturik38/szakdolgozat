<div class="container">
    <div class="sticky-top">
        <button class="btn btn-danger mt-5 mb-5" id="removeCommentsButton">Remove Comments</button>
        <input type="checkbox" id="checkAllBtn" onClick="toggle(this)">Select all</input>
    </div>

    <div id="commentSection" class="mt-2">
        <?php
        if ($comments != NULL) {
            foreach ($comments as $comment) {
                $u->filterByUID($comment->get_uid(), $conn);
        ?>
                <div class="d-flex bg-gray comment" data-cid=<?php echo $comment->get_comment_id() ?>>
                    <div class="d-flex px-2">
                        <?php if (file_exists("pfp/{$comment->get_uid()}.png")) { ?>
                            <img class="pfp" src=<?php echo "pfp/{$comment->get_uid()}.png" ?> alt="pfp">
                        <?php } else { ?>
                            <img class="pfp" src=<?php echo "pfp/default.png" ?> alt="pfp">
                        <?php } ?>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a class="link link-success" href="index.php?page=profile&id=<?php echo $comment->get_uid(); ?>">
                            <h5><?php echo $u->get_username(); ?> <small class="text-muted"><i>Posted on <?php echo $comment->get_time_commented(); ?></i></small></h5>
                        </a>
                        <p><?php echo $comment->get_text();  ?></p>
                    </div>
                    <div class="flex-grow-1">
                        <input type="checkbox" id=<?php echo $comment->get_comment_id(); ?> name="commentCheckbox" value=<?php echo $comment->get_comment_id(); ?>>
                    </div>
                </div>


        <?php


            }
        }

        ?>
    </div>
</div>

<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('commentCheckbox');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }


    var array = []

    $("#removeCommentsButton").click(() => {
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        if (checkboxes.length < 1) return;

        for (var i = 0; i < checkboxes.length; i++) {
            array.push(checkboxes[i].value)
        }

        $.ajax({
            url: "ajax/remove_comments.php",
            method: "POST",
            data: {
                comments: array
            },
            success: () => {
                alert("Comments successfully deleted.")
                $("#commentSection").load(location.href + " #commentSection");
            },
            error: () => {
                alert("An error has occurred.")
            }
        })
    })
</script>