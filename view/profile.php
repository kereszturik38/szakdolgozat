<div class="container d-flex align-items-center justify-content-center " id="profileDiv">
    <div class="card" id="profileCard">
        <img class="card-img-top" src=<?php echo $pfp; ?> alt="pfp">
        <div class="card-body text-center">
            <h5 class="card-title"><?php echo $u->get_username(); ?></h5>
            <?php  if($u->is_admin($u->get_uid(),$conn)){ ?>
                <i class="bi-hammer">This user is admin</i>
            <?php } else{
             if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) : ?>
                <h5>UID: <?php echo $u->get_uid(); ?></h5>

                <button class="btn btn-primary" id="makeAdminButton">Make admin</button>
            <?php endif;} ?>
            <p class="card-text">Level : <?php echo $u->get_level(); ?></p>
            <a href=<?php echo "index.php?page=search&pageNum=0&select=Uploader&search=" . $u->get_username(); ?> class="btn btn-success">View <?php echo $postcount; ?> posts</a>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {

        $("#makeAdminButton").click(function() {

            $.ajax({
                type: "POST",
                url: "ajax/admin_update.php",
                data: {
                    uid: <?php echo $u->get_uid(); ?>
                },
                success: function() {
                    alert("User successfully made admin")
                    $("#profileDiv").load(location.href + " #profileDiv");
                },
                error: function() {
                    $("#makeAdminButton").text("This user is already admin");
                }
            })
        });

    });
</script>