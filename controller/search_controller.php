<?php

include "model/Post.php";
include "model/User.php";
include "inc/searchfield.php";

?>



<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <?php

        if (isset($_GET["search"])) {

            if (!isset($_GET["select"])) {
                include "view/noresults.php";
            } else {




                $p = new Post();
                $u = new User();
                $searchRaw = $_GET["search"];
                $search = "%" . $_GET["search"] . "%";
                $select = $_GET["select"];

                if (isset($_GET["pageNum"])) {
                    $pageNum = $_GET["pageNum"];
                } else {
                    $pageNum = 0;
                }
                $postsPerPage = 6;

                $offset = $pageNum * $postsPerPage;

                switch ($select) {
                    case "Title":
                        $numberOfPages = $p->get_number_of_pages($postsPerPage, $conn, $search, null, 1, null, null);
                        $resultsToShow = $p->filterByTitle($search, $offset, $postsPerPage, $conn);
                        break;
                    case "Image":
                        $numberOfPages = $p->get_number_of_pages($postsPerPage, $conn, $search, "image/%", 1, null, null);
                        $resultsToShow = $p->filterByType($search, "image/%", $offset, $postsPerPage, $conn);
                        break;
                    case "Video":
                        $numberOfPages = $p->get_number_of_pages($postsPerPage, $conn, $search, "video/%", 1, null, null);
                        $resultsToShow = $p->filterByType($search, "video/%", $offset, $postsPerPage, $conn);
                        break;
                    case "Private":
                        if (isset($_SESSION["loggedIn"])) {
                            if ($_SESSION["admin"] === true) {
                                $user = null;
                            } else {
                                $user = $_SESSION["uid"];
                            }

                            $numberOfPages = $p->get_number_of_pages($postsPerPage, $conn, $search, null, 0, $user, null);
                            $resultsToShow = $p->filterPrivate($user, $offset, $postsPerPage, $conn);
                        } else {
                        }

                        break;
                    case "Uploader":

                        if (preg_match("/uid:/", $searchRaw)) {
                            $s_uid = preg_split("/:/", $searchRaw);
                            try {
                                $u->filterByUID($s_uid[1], $conn);
                                $numberOfPages = $p->get_number_of_pages($postsPerPage, $conn, null, null, 1, $u->get_uid(), null);
                                $resultsToShow = $p->filterByUploader($offset, $postsPerPage, $conn, $u->get_username(), $u->get_uid());
                            } catch (Exception $e) {
                                echo "<div class=alert>No such UID was found</div>";
                                include "view/noresults.php";
                                die();
                            }
                        } else {
                            $numberOfPages = $p->get_number_of_pages($postsPerPage, $conn, null, null, 1, null, $search);
                            $resultsToShow = $p->filterByUploader($offset, $postsPerPage, $conn, $search, null);
                        }



                        break;
                    default:
                        include "view/404.php";
                        break;
                }
                if (isset($resultsToShow) && $resultsToShow->num_rows > 0) {


                    while ($row = $resultsToShow->fetch_assoc()) {

                        $p->filterByPID($row["post_id"], $conn);
                        $imgstr = fetch_file($p);
                        include "view/results.php";
                    }
                    echo "</div>";
                    include "inc/pagination.php";
                } else {
                    include "view/noresults.php";
                }
            }
        } else {
            include "view/default.php";
        }

        ?>

    </div>
</div>