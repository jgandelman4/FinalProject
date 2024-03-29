<?php

    /***********************************************************************
     * config.php
     *
     * Computer Science 50
     * Problem Set 7
     *
     * Configures pages.
     **********************************************************************/

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();

    if (!preg_match("{(?:login|logout|register|registergroup|instructions)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["groupkey"]))
        {
            redirect("login.php");
        }
    }
  
?>
