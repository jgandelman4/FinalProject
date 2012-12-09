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
    
    //assuming we have a masterid column in SQL table TODO don't need anymore?
    $mastercalendar = query ("SELECT masterid FROM groups WHERE `groupkey` =?", $_SESSION["groupkey"]);
    
    if($members == false)
    {
        apologize("Failed to retrieve group information!");
    }
    //take only the first content in the first row
    $mastercalendar = $mastercalendar[0]["masterid"];
    
    //create local array to store just the "member" column from query, which returns an array of rows!
    $memberslist = [];
    foreach($members as $member)
    {
        $memberslist[] = $member["member"];
    }

    //now pass members and mastercalendar into view
    render("mainpage_form.php", ["title" => "MainPage", "members" => $memberslist]);
?>
