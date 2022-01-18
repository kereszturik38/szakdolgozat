<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <?php

                foreach ($menupontok as $key => $value) {
                    $active = '';
                    if ($_SERVER['REQUEST_URI'] == '/szakdolgozat/' . $key) $active = ' active';

                    
                ?>
                    <li class="nav-item<?php echo $active; ?>">
                        <a class="nav-link" href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a>
                    </li>
                <?php
                }

                ?>
            </ul>
            <span class="d-flex">


                <?php

                if (isset($_SESSION["loggedIn"])) echo "<i class='bi-person-fill em-1'></i>" . $_SESSION["loggedIn"];
                else {
                    echo "<a class='btn btn-secondary' href='index.php?page=login'>Login</a>";
                }

                ?>

            </span>
        </div>
    </div>
</nav>