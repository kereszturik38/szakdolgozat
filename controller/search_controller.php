<?php

include "model/Post.php";
include "inc/searchfield.php";

?>



<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <?php

        if (isset($_GET["search"])) {


            $p = new Post();
            $searchRaw = $_GET["search"];
            $search = "%" . $_GET["search"] . "%";
            $select = $_GET["select"];

            if(isset($_GET["pageNum"])){
                $pageNum = $_GET["pageNum"];
            }else{
                $pageNum=0;
               
            }
            $postsPerPage = 6;

            $offset = $pageNum * $postsPerPage;

            switch ($select) {
                case "Title":
                    $numberOfPages = $p->get_number_of_pages($postsPerPage,$search,$conn);
                    $resultsToShow = $p->filterByTitle($search,$offset,$postsPerPage,$conn);
                    break;
                case "Image":
                    $numberOfPages = $p->get_number_of_pages($postsPerPage,$search,$conn,"image/%");
                    $resultsToShow = $p->filterByType($search,"image/%",$offset, $postsPerPage,$conn);
                    break;
                case "Video":
                    $numberOfPages = $p->get_number_of_pages($postsPerPage,$search,$conn,"video/%");
                    $resultsToShow = $p->filterByType($search,"video/%",$offset, $postsPerPage,$conn);
                    break;
                case "Uploaded by":
                    $numberOfPages = $p->get_number_of_pages($postsPerPage,$search,$conn);
                    $resultsToShow = $p->filterByUploader($search,$offset,$postsPerPage,$conn);
                    break;
                
            }
            if ($resultsToShow && $resultsToShow->num_rows > 0) {

                
                while ($row = $resultsToShow->fetch_assoc()) {

                    $p->filterByPID($row["post_id"],$conn);
                    $imgstr = fetch_file($p);
                    include "view/results.php";
                }
                echo "</div>";
                include "inc/pagination.php";
            } else{
                include "view/noresults.php";
            }
        } else {
            include "view/default.php";
        }

        ?>

    </div>
</div>