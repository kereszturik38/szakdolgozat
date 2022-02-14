
    <div class="card">
        <!-- File type badge -->
        <?php if(preg_match("{image/*}",$row["type"])){ ?>
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><i class="bi-image em-1"></i></div>
            <!-- Post image-->
            <img class="card-img result" src="<?php echo $imgstr; ?>" alt=<?php echo $row["title"]; ?> data-postid=<?php echo $row["post_id"]; ?> />
        <?php 
        } else if(preg_match("{video/*}",$row["type"])){ ?>
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><i class="bi-play-btn em-1"></i></div>
            <!-- Post image-->
            <video class="card-img result" type=<?php echo $row["type"]; ?> alt=<?php echo $row["title"]; ?> data-postid=<?php echo $row["post_id"]; ?>>
                <source src="<?php echo $imgstr; ?>" />
            </video>
        <!-- Post details-->
        <?php } ?>
        <div class="card-body">
            <div class="text-center">
                <!-- Title,uploader,etc-->
                <h5 class="fw-bolder text-truncate"><?php echo $row["title"] ?></h5>
                <h6 class="fw-light"><?php echo $row["username"] ?></h6>
                <i class="bi-card-text em-1"></i><?php echo $row["comment_count"] ?>
                <i class="bi-bookmark em-1"></i><?php echo $row["bookmark_count"] ?>
                <i class="bi-share" id="shareBtn" data-link=<?php echo $_SERVER["SERVER_NAME"] . "/szakdolgozat/index.php?page=post?id=" . $row["post_id"]; ?>></i>
            </div>
        </div>
    </div>
