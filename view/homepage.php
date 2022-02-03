<div class="container align-items-center">
    <div id="carousel_most_popular" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php
            foreach ($topImages as $key => $img) {
            ?>
                <button type="button" data-bs-target="#carousel_most_popular" data-bs-slide-to="0" <?php if ($key === 0) echo 'class="active" aria-current="true"' ?> aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel_most_popular" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel_most_popular" data-bs-slide-to="2" aria-label="Slide 3"></button>

                <div class="carousel-item <?php if ($key === 0) echo 'active'; ?>">
                    <img class="d-block w-100" src=<?php echo fetch_image($img) ?> alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p>Some representative placeholder content for the first slide.</p>
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

<!--
<div>
    <div class="container align-items-center">
        <div id="carousel_most_popular" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="posts/1293-2330/1293.jpg" alt="...">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="posts/1292-2330/1292.jpg" alt="...">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="posts/1291-2330/1291.jpg" alt="...">
                </div>
            </div>
        </div>
    </div>
</div>
        -->