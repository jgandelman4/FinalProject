<?php

    /***********************************************************************
     * register.php
     *
     * Computer Science 50
     * Problem Set 7
     * Jason Gandelman, Charlotte Chang
     *
     * Allows users to register with groupkey and gcal
     **********************************************************************/

    // configuration
    require("../includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["gmail"]))
        {
            apologize("You must provide your gmail!");
        }
        else if (empty($_POST["groupkey"]))
        {
            apologize("You must provide a unique group key emailed to you by group creator!");
        }
        else if (query("SELECT * FROM groups WHERE groupkey = ?", $_POST["groupkey"])==false)
        {
            apologize("There is no such group key registered with our site!");
        }
        else if ((query("INSERT INTO groups (member, `groupkey`) VALUES (?,?)", $_POST["gmail"], $_POST["groupkey"]))===false)
        {
            apologize("We were not able to register you at this time...try again later!");
        }
        
        else
        {
            $_SESSION["groupkey"] = $_POST["groupkey"];
            // redirect to mainpage
            redirect("/mainpage.php");
        }            
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }    
?>
