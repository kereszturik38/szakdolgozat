<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container px-4 px-lg-5">
            <a class="navbar-brand"><i class="bi-images"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=search">Search</a>
                    </li>
                    <?php if (isset($_SESSION["loggedIn"])) {  ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=settings">Settings</a>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center mx-sm-auto">

            <?php if (isset($_SESSION["loggedIn"])) { ?>

                <a class="btn btn-primary mx-3" href="index.php?page=bookmarks">
                    Bookmarks <span class="badge badge-light"> <i class="bi-bookmark"></i> </span>
                </a>

                <a class="btn btn-success mx-3" href="index.php?page=upload">
                    Upload <span class="badge badge-light"> <i class="bi-upload"></i> </span>
                </a>


                <span class="mx-3"><i class='bi-person-fill em-1'></i><?php echo $_SESSION["username"]; ?></span>
            <?php } else { ?>
                <a class='btn btn-secondary' href='index.php?page=login'>Login</a>
            <?php } ?>
        </div>

    </nav>
</div>