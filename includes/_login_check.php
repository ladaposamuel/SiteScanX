<?php

    // Getting index page name
    $basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);;

    if(!isset($_SESSION['user']) && $basename != "index"){
        header("Location: ". INDEX_LINK);
    }

    if($basename == "index") {
        if(!empty($_SESSION['user']))
            header("Location:". INDEX_LINK);
    }

?>
