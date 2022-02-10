<div>
    <div id="carousel_most_popular" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php
            foreach ($topImages as $key => $img) {
                $u->filterByUID($img->get_post_uid(),$conn);
            ?>
                <div class="carousel-item <?php if ($key === 0) echo 'active'; ?>">
                    <img class="d-block w-100" src=<?php echo fetch_image($img) ?> alt=<?php echo $img->get_title(); ?>>
                    <div class="carousel-caption d-none d-md-block text-white">
                    <h2><?php echo $img->get_title(); ?></h2>
                    <h3><?php echo $u->get_username(); ?>
                        <i class="bi-bookmark-fill mx-2"><?php echo $img->get_bookmark_count(); ?></i>
                    </h3>
                    </div>
                </div>
                
            <?php
            }

            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel_most_popular" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel_most_popular" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>