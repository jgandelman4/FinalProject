<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["member"]))
        {
            apologize("You must provide your calendar.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your group password.");
        }

        // query database for user
        $rows = query("SELECT * FROM groups WHERE member = ?", $_POST["member"]);
        
        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) member
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if ($_POST["password"] == $row["key"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["key"] = $row["key"];
                
                //redirect to main page
                redirect("/mainpage.php");
            }
        }

        // else apologize
        apologize("You have not joined this group.");
    }
    else
    {
        // else render form
        render("login_form.php", ["title" => "Log In"]);
    }

?>
