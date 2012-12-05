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
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["gmail"]))
        {
            apologize("You must provide your personal gcal ID!");
        }
        else if (empty($_POST["groupkey"]))
        {
            apologize("You must provide a unique group key emailed to you by group creator!");
        }
        else if (empty($_POST["groupcalendar"]))
        {
            apologize("You must provide a unique master calendar ID for your group!");
        }
        else if (empty($_POST["groupname"]))
        {
            apologize("You must provide a unique group name!");
        }
        //this is checking to make sure no group has registered with the same group key
        else if(query("SELECT * FROM groups WHERE `groupkey`=?", $_POST["groupkey"]) == true)
        {
            apologize("This group key has been taken!");
            redirect("/registergroup.php");
        }
        else if ((query("INSERT INTO groups (name, `groupkey`, member, masterid) VALUES(?, ?, ?, ?)", $_POST["groupname"], $_POST["groupkey"], $_POST["gmail"], $_POST["groupcalendar"]))===false)
        {
            apologize("We were not able to register you at this time...try again later!");
        }
        else
        {

            $_SESSION["groupkey"] = $_POST["groupkey"];

            // redirect to portfolio
            redirect("/mainpage.php");
        }    
    }
    else
    {
        // else render form
        render("registergroup_form.php", ["title" => "Register Group"]);
    }
    
?>
