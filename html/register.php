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
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username!");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password!");
        }
        else if (empty($_POST["gmail"]))
        {
            apologize("You must provide your gmail!");
        }
        else if (empty($_POST["groupkey"]))
        {
            apologize("You must provide a unique group key emailed to you by group creator!");
        }
        else if (query("SELECT * FROM users WHERE groupkey=?", $_POST["groupkey"])===false)
        {
            apologize("There is no such group key registered with our site!");
        }
        else if ($_POST["password"]!= $_POST["confirmation"])
        {
            apologize("Your passwords do not match!");
        }
        else if ((query("INSERT INTO users (username, hash, gmail, groupkey) VALUES(?, ?, ?, ?)",
        $_POST["username"], crypt($_POST["password"]), $_POST["gmail"], $_POST["groupkey"]))===false)
        {
            apologize("We were not able to register you at this time...try again later!");
        }
        else
        {
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $id;

            // redirect to portfolio
            redirect("/");
        }    
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
        
    
    
?>
