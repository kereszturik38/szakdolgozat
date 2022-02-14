<div class="card">
   <!-- File type badge -->
   <?php if(preg_match("{image/*}",$bookmark->get_type())){ ?>
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><i class="bi-image em-1"></i></div>
            <!-- Post image-->
            <img class="card-img result" src="<?php echo $imgstr; ?>" alt=<?php echo $bookmark->get_title(); ?> data-postid=<?php echo $bookmark->get_post_id(); ?> />
        <?php 
        } else if(preg_match("{video/*}",$bookmark->get_type())){ ?>
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><i class="bi-play-btn em-1"></i></div>
            <!-- Post image-->
            <video class="card-img result" type=<?php echo $bookmark->get_type(); ?> alt=<?php echo $bookmark->get_title(); ?> data-postid=<?php echo$bookmark->get_post_id(); ?>>
                <source src="<?php echo $imgstr; ?>" />
            </video>
        <?php } ?>
        <!-- Post details-->
    <div class="card-body">
        <div class="text-center">
            <!-- Title,uploader,etc-->
            <h5 class="fw-bolder text-truncate"><?php echo $bookmark->get_title(); ?></h5>
            <h6 class="fw-light"><?php echo $u->get_username(); ?></h6>
            <i class="bi-card-text em-1"></i><?php echo $bookmark->get_comment_count(); ?>
            <i class="bi-bookmark em-1"></i><?php echo $bookmark->get_bookmark_count(); ?>
        </div>
    </div>
</div>