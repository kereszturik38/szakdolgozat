<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container px-4 px-lg-5">
            <a class="navbar-brand"><img src="resource/favicon-32x32.png" alt="favicon"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=search">Search</a>
                    </li>
                    <?php if (isset($_SESSION["loggedIn"])) :  ?>


                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=settings">Settings</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=logout">Logout</a>
                        </li>

                    <?php endif ?>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center mx-sm-auto">

            <?php if (isset($_SESSION["loggedIn"])) { ?>

                <a class="btn btn-primary mx-3" href="index.php?page=bookmarks&pageNum=0">
                    Bookmarks <span class="badge badge-light"> <i class="bi-bookmark"></i> </span>
                </a>

                <a class="btn btn-success mx-3" href="index.php?page=upload">
                    Upload <span class="badge badge-light"> <i class="bi-upload"></i> </span>
                </a>



                <div class="d-flex" id="loggedUser">
                    <div class="justify-content-center align-items-center align-self-center d-none d-lg-block">
                        <h5 class="user"><?php echo $_SESSION["username"] ?></h5>
                    </div>
                    <div class="d-flex px-2">
                        <?php if(file_exists("pfp/{$_SESSION['uid']}.png")){ ?>
                            <img class="pfp" src=<?php echo "pfp/{$_SESSION['uid']}.png" ?> alt="pfp">
                        <?php } else { ?>
                            <img class="pfp" src=<?php echo "pfp/default.png" ?> alt="pfp">
                        <?php } ?>
                    </div>
                </div>


            <?php } else { ?>
                <a class='btn btn-secondary' href='index.php?page=login'>Login</a>
            <?php } ?>
        </div>

    </nav>
</div>