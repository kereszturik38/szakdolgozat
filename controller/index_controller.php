<?php
include "model/Post.php";
include "inc/searchfield.php";

if (isset($_GET["search"]) && $_GET["search"] != "") {

    $search = htmlspecialchars($_GET["search"]);
    $select = $_GET["select"];

    $p = new Post();

    $resultsToShow = $p->filterByTitle($search, $conn);

?>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <?php

        if ($resultsToShow->num_rows > 0) {
            while ($row = $resultsToShow->fetch_assoc()) {

                //var_dump($row);

                $path = glob("./posts/" . $row["post_id"] . "/" . $row["post_id"] . ".png");
                //echo end($path);
                if ($path != false) {
                    $imgstr =  end($path);
                }

                include "view/results.php";
            }
        }
    } else {
        include "view/default.php";
    }

        ?>
        </div>
    </div>