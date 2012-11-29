<?php


    /***********************************************************************
     * register.php
     *
     * Computer Science 50
     * Problem Set 7
     * Jason Gandelman
     *
     * Calculates what will be displayed in register_form.php
     **********************************************************************/

    // configuration
    require("../includes/config.php");
    // sql query in user database for gmails where group key = person logged in's group key
    // new var for everyone's calendar ids! and feed to Mainpage_form via render function below!
    render("mainpage_form.php", ["title" => "MainPage"]);

?>
