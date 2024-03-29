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
    //NOTE:"key" is special word in php, so 'key'
    $members = query("SELECT member FROM groups WHERE `groupkey` = ?", $_SESSION["groupkey"]);
    
    if($members == false)
    {
        apologize("Failed to retrieve group information!");
    }
    //create local array to store just the "member" column from query, which returns an array of rows!
    $memberslist = [];
    foreach($members as $member)
    {
        $memberslist[] = $member["member"];
    }

    //now pass members and mastercalendar into view
    render("mainpage_form.php", ["title" => "MainPage", "members" => $memberslist]);
?>
