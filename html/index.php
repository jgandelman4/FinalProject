<?php

    /***********************************************************************
     * index.php
     *
     * Computer Science 50
     * Problem Set 7
     * Jason Gandelman
     *
     * Calculates what will be displayed in portfolio.php
     **********************************************************************/
     
    // configuration
    require("../includes/config.php"); 
    
    // if not logged in, then go to login page
    if(empty($_SESSION["id"])) 
    {
        // redirect to login
        redirect("/login.php");
    }
    else
    {
      $cash=query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
      // if we found cash
      if (count($cash) == 1)
      {
            // first (and only) row
            $ca = $cash[0];
      }
      $symbols=query("SELECT symbol FROM portfolio WHERE id = ?", $_SESSION["id"]);
      $rows[0]["symbol"]="-";
      $rows[0]["name"]="-";
      $rows[0]["price"]="-";
      $rows[0]["shares"]="-";
      $rows[0]["value"]="-";
      $i=1;
      foreach($symbols as $symbol)
      {
        $rows[$i]=lookup($symbol["symbol"]);
        $q=query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $symbol["symbol"]);
        if (count($q) == 1)
        {
            // first (and only) row
            $qu = $q[0];
        }
        
        $rows[$i]["shares"]= $qu["shares"];
        $rows[$i]["value"]=$rows[$i]["price"]*$rows[$i]["shares"];
        $i++;
      }
        // render portfolio
        render("portfolio.php", ["title"=> "Portfolio", "cash"=> $ca["cash"], "rows"=>$rows]);

    }     
?>        

