<?php

    //phpinfo();
    //echo "Hello";
    require_once ("config.php");
    $VSECore->CheckAuth();
    $VSECore->redirect("main/index.php");

?>
