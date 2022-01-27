<?php


?>



        <?php

        if (isset($_GET["page"])) {
            switch ($_GET["page"]) {
                case "login":
                    include "controller/login_controller.php";
                    break;
                case "settings":
                    include "controller/settings_controller.php";
                    break;
                case "search":
                    include "controller/search_controller.php";
                    break;
            }
        }

        ?>
    </div>
</div>