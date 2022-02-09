<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src=<?php echo $imgstr ?> alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder"><?php echo $p->get_title() ?></h1>
                <div class="fs-5 mb-5">
                    <span><a class="link-success text-decoration-none" href="#"><?php echo $u->get_username(); ?></a></span><br>
                    <i class="bi-bookmark em-1"><span class="badge badge-secondary bg-dark" id="bookmarkCount"><?php echo $p->get_bookmark_count() ?></span></i>
                </div>

                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                <div class="d-flex">
                    <?php if (!$p->is_bookmarked($_SESSION["uid"],$p->get_post_id(),$conn)) { ?>
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" id="bookmarkButton">
                            <i class="bi-bookmark em-1"></i>
                            Add to bookmarks
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" id="removebookmarkButton">
                            <i class="bi-bookmark em-1"></i>
                            Remove from bookmarks
                        </button>
                    <?php } ?>
                    <script>
                        $(document).ready(function() {
                            $("#bookmarkButton").click(function() {

                                $.ajax({
                                    type: "POST",
                                    urL: "index.php?page=post&id=" + <?php echo $p->get_post_id(); ?>,
                                    data: {
                                        bookmark: "set"
                                    },
                                    success: function(result) {
                                        $("#bookmarkButton").text("Added to your bookmarks");
                                        $("#bookmarkCount").text(<?php echo $p->get_bookmark_count() ?>);
                                    },
                                    error: function() {
                                        $("#bookmarkButton").text("Already in your bookmarks");
                                    }
                                })
                            });
                            $("#removebookmarkButton").click(function() {

                                $.ajax({
                                    type: "POST",
                                    urL: "index.php?page=post&id=" + <?php echo $p->get_post_id(); ?>,
                                    data: {
                                        bookmark: "unset"
                                    },
                                    success: function(result) {
                                        $("#removebookmarkButton").text("Removed from bookmarks");
                                        $("#bookmarkCount").text(<?php echo $p->get_bookmark_count() ?>);
                                    },
                                    error: function() {
                                        $("#removebookmarkButton").text("Try again");
                                    }
                                })
                            });
                        })
                    </script>
                </div>
            </div>
        </div>

        <div class="mt-5">


            <form method="post">
                <div class="mb-3">
                    <label for="usercomment">
                        <h5>Leave a comment</h5>
                    </label>
                    <textarea class="form-control" rows="3" id="usercomment" name="usercomment"></textarea>
                    <button class="btn btn-success mt-3" name="submit" id="submit" value="submit">Leave comment</button>
                </div>

            </form>
        </div>
        <div class="mt-5">
            <h2>Comments <span class="badge badge-secondary bg-dark"><?php echo $p->get_comment_count() ?></span></h2>



            <?php

            if ($comments != NULL) {
                foreach ($comments as $comment) {
                    $u->filterByUID($comment->get_uid(), $conn);
            ?>
                    <div class="d-flex bg-gray">
                        <div class="flex-grow-1 ms-3">
                            <a class="link link-success" href="#">
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
</section>