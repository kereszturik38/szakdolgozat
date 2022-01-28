<?php

include "model/Post.php";
include "inc/searchfield.php";

?>



<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <?php

        if (isset($_GET["search"])) {


            $p = new Post();

            $search = "%" . $_GET["search"] . "%";
            $select = $_GET["select"];

            switch ($select) {
                case "Title":
                    $resultsToShow = $p->filterByTitle($search, $conn);
                    break;
                case "Image":
                    $resultsToShow = $p->filterByType($search,"image/%", $conn);
                    break;
                case "Video":
                    $resultsToShow = $p->filterByType($search,"video/%", $conn);
                    break;
            }
            if ($resultsToShow && $resultsToShow->num_rows > 0) {


                while ($row = $resultsToShow->fetch_assoc()) {

                    //var_dump($row);

                    $path = glob("posts/" . $row["post_id"] . "/" . $row["post_id"] . ".png");
                    //echo end($path);
                    if ($path != false) {
                        $imgstr =  end($path);
                    }

                    include "view/results.php";
                }
            } else{
                include "view/noresults.php";
            }
        } else {
            include "view/default.php";
        }


        ?>

    </div>
</div>