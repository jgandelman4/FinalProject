<!DOCTYPE html>

<html>

    <head>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>WeFree: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>WeFree</title>
        <?php endif ?>

        <script src="js/jquery-1.8.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>

    </head>

    <body>

        <div class="container-fluid">

            <div id="top">

                <a href="/"><img alt="WeFree Logo" src="img/WeFree.png"/></a>

            </div>
            
            <div class="container-fluid">
            <table class="table table-hover">   
                <tr class="info">
                        <td>Your WeFree Options:</td>
                        <td><a href="mainpage.php">WeFree Search</a></td>
                        <td><a href="login.php">Log Into WeFree</a></td>
                        <td><a href="register.php">Join an Existing WeFree Group</a></td>
                        <td><a href="registergroup.php">Create a New WeFree Group</a></td>
                        <td><a href="logout.php">Log Out</a></td>
                </tr>
            </table>
            </div>
            <div id="middle">

