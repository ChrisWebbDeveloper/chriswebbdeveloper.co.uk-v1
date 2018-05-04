<?php

    session_start();

    if ($_SESSION['username']) {

        echo ("Welcome to your new account, " . $_SESSION['username'] . ".");

    } else {

        header ("Location: index.php");

    };

?>
