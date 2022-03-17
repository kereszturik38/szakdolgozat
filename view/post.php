<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <?php if (preg_match("{image/*}", $p->get_type())) { ?>
                    <img class="card-img-top mb-5 mb-md-0 enlargePost" src=<?php echo $imgstr ?> alt=<?php echo $p->get_title(); ?> />
                <?php } else if (preg_match("{video/*}", $p->get_type())) { ?>
                    <video class="card-img-top mb-5 mb-md-0 enlargePost">
                        <source src=<?php echo $imgstr ?> />
                    </video>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder"><?php echo $p->get_title() ?></h1>
                <div class="fs-5 mb-5">
                    <span><a class="link-success text-decoration-none" href="index.php?page=profile&id=<?php echo $u->get_uid(); ?>"><?php echo $u->get_username(); ?></a></span><br>
                    <i class=<?php echo $icon; ?>id="bookmarkIcon">
                        <span class="badge badge-secondary bg-dark" id="bookmarkCount">
                            <?php echo $p->get_bookmark_count() ?>
                        </span>
                    </i>
                </div>

                <div class="d-flex">
                    <?php
                    if (isset($_SESSION["loggedIn"])) {
                        if (!$is_bookmarked) { ?>
                            <button class="btn btn-outline-dark flex-shrink-0" type="button" id="bookmarkButton">
                                <i class="bi-bookmark em-1"></i>
                                Add to bookmarks
                            </button>
                        <?php } else { ?>
                            <button class="btn btn-outline-dark flex-shrink-0" type="button" id="removebookmarkButton">
                                <i class="bi-bookmark em-1"></i>
                                Remove from bookmarks
                            </button>
                    <?php }
                    } ?>

                    <?php if (isset($_SESSION["loggedIn"]) && ($p->get_post_uid() === $_SESSION["uid"] || $_SESSION["admin"] === true)) :
                        if ($p->get_visible() === 1) { ?>
                            <a id="visibleButton" class="bi-eye-fill btn btn-primary" data-pid=<?php echo $p->get_post_id(); ?> data-visibility=<?php echo $p->get_visible(); ?>>Make private</a>
                        <?php } else { ?>
                            <a id="visibleButton" class="bi-eye-slash-fill btn btn-primary" data-pid=<?php echo $p->get_post_id(); ?> data-visibility=<?php echo $p->get_visible(); ?>>Make public</a>
                    <?php }
                    endif; ?>
                </div>
            </div>

        </div>

        <div class="row-md-6 mt-5 mb-5">
            <h2>Description</h2>
            <?php if (isset($_SESSION["loggedIn"]) && ($p->get_post_uid() === $_SESSION["uid"] || $_SESSION["admin"] === true)) : ?>
                <a class="mb-5 bi-pencil-fill" href="index.php?page=change&option=description&id=<?php echo $p->get_post_id(); ?>">Edit</a>
            <?php endif ?>
            <p><?php echo $p->get_description(); ?></p>
        </div>

        <div class="mt-5">

            <?php
            if (isset($_SESSION["loggedIn"])) {
            ?>
                <form method="post" action="ajax/comments_update.php" id="commentForm">
                    <div class="mb-3">
                        <label for="usercomment">
                            <h5>Leave a comment</h5>
                        </label>
                        <textarea class="form-control" rows="3" id="usercomment" name="usercomment"></textarea>
                        <button class="btn btn-success mt-3" name="submit" id="submit" value="submit">Leave comment</button>
                    </div>

                </form>
                <p class="text-danger d-none" id="commentError">The comment field can't be empty</p>
            <?php
            }
            ?>
        </div>
        <div class="mt-5">
            <h2>Comments <span class="badge badge-secondary bg-dark" id="commentCount"><?php echo $p->get_comment_count() ?></span></h2>

            <div id="commentSection">
                <?php
                if ($comments != NULL) {
                    foreach ($comments as $comment) {
                        $u->filterByUID($comment->get_uid(), $conn);
                ?>
                        <div class="d-flex bg-gray comment">
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
                        </div>


                <?php


                    }
                }

                ?>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#bookmarkButton").click(function() {

            $.ajax({
                type: "POST",
                url: "ajax/bookmarks_update.php?id=" + <?php echo $p->get_post_id(); ?>,
                data: {
                    post_id: <?php echo $p->get_post_id(); ?>,
                    uid: <?php if (isset($_SESSION["uid"])) echo $_SESSION["uid"];
                            else echo "undefined"; ?>,
                    bookmark: "set"
                },
                dataType: "text",
                success: function(count) {
                    $("#bookmarkButton").text("Added to your bookmarks");
                    $('#bookmarkButton').prop('disabled', true);
                    $("#bookmarkCount").text(count);
                    $("#bookmarkIcon").removeClass("bi-bookmark").addClass("bi-bookmark-fill");
                },
                error: function() {
                    $("#bookmarkButton").text("Already in your bookmarks");
                }
            })
        });
        $("#removebookmarkButton").click(function() {

            $.ajax({
                type: "POST",
                url: "ajax/bookmarks_update.php?id=" + <?php echo $p->get_post_id(); ?>,
                data: {
                    post_id: <?php echo $p->get_post_id(); ?>,
                    uid: <?php if (isset($_SESSION["uid"])) echo $_SESSION["uid"];
                            else echo "undefined"; ?>,
                    bookmark: "unset"
                },
                dataType: "text",
                success: function(count) {
                    $("#removebookmarkButton").text("Removed from bookmarks");
                    $('#removebookmarkButton').prop('disabled', true);
                    $("#bookmarkCount").text(count);
                    $("#bookmarkIcon").removeClass("bi-bookmark-fill").addClass("bi-bookmark");
                },
                error: function() {
                    $("#removebookmarkButton").text("Try again");
                }
            })
        });

        $("#commentForm").keyup(function(e) {
            $("#commentError").addClass("d-none");
        });



        $("#commentForm").submit(function(e) {
            e.preventDefault();
            if ($("#usercomment").val().length === 0) {
                $("#commentError").removeClass("d-none");
                return;
            }

            let form = $(this);
            let action = form.attr('action');

            let dataArray = form.serializeArray();
            dataArray.push({
                name: 'post_id',
                value: <?php echo $p->get_post_id(); ?>
            });
            dataArray.push({
                name: 'uid',
                value: <?php if (isset($_SESSION["uid"])) echo $_SESSION["uid"];
                        else echo "undefined"; ?>
            });

            $.ajax({
                type: "POST",
                url: action,
                data: dataArray,
                dataType: "json",
                beforeSend: function() {
                    $("#commentForm").trigger('reset');
                },
                success: function(array) {

                    $("#commentCount").text(array.length);
                    $("#commentSection").empty();
                    array.forEach(function(currentObject) {
                        $("#commentSection").append(
                            `
                            <div class="d-flex bg-gray comment">
                            <div class="d-flex px-2">
                                    <img class="pfp" src="pfp/${currentObject.uid}.png" alt="pfp" onerror="this.src='pfp/default.png';">
                                </div>
                            <div class="flex-grow-1 ms-3">
                                <a class="link link-success" href="index.php?page=profile&id=${currentObject.uid}">
                                    <h5>${currentObject.username}<small class="text-muted"><i>Posted on ${currentObject.time_commented}</i></small></h5>
                                </a>
                                <p>${currentObject.text}</p>
                            </div>
                        </div>
`
                        );
                    });

                },
                error: function(error) {
                    alert("Something has gone wrong");
                    console.log(error);
                }

            });

        });
    })
</script>