<?php

    /***********************************************************************
     * register.php
     *
     * Computer Science 50
     * Problem Set 7
     * Jason Gandelman, Charlotte Chang
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
            redirect("https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/calendar&redirect_uri=http://ec2-54-234-13-85.compute-1.amazonaws.com&response_type=code&client_id=1079769168876.apps.googleusercontent.com&approval_prompt=force");
                
        }
        }    
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
        
    
    
?>
