<div class="container d-flex align-items-center justify-content-center ">
    <div class="card" id="profileCard">
        <img class="card-img-top" src=<?php echo "pfp/{$profile}.png"; ?> alt="pfp">
        <div class="card-body text-center">
            <h5 class="card-title"><?php echo $u->get_username(); ?></h5>
            <p class="card-text">Level : <?php echo $u->get_level(); ?></p>
            <a href=<?php echo "index.php?page=search&pageNum=0&select=User&search={$u->get_uid()}" ?> class="btn btn-success">View <?php echo $postcount; ?> posts</a>
        </div>
    </div>

</div>