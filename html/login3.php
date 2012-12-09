<!DOCTYPE html>

<html>

    <head>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <script src="js/jquery-1.8.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>

    </head>

    <body>

        <div class="container-fluid">

            <div id="top">
                <a href="/"><img alt="C$50 Finance" src="img/logo.gif"/></a>
            </div>

            <div id="middle">


<form>
    <fieldset>
        <div>
            <button type="submit" class="btn">Log in to group page!</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="registergroup.php">create</a> for a group
    or <a href="register.php">join</a> a group
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.btn').click(function() {
    
    console.log(fadf);

    //window.location.replace("https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/calendar&redirect_uri=http://ec2-54-234-13-85.compute-1.amazonaws.com&response_type=code&client_id=1079769168876.apps.googleusercontent.com&approval_prompt=force");
    
    });
})

</script>


            </div>

            <div id="bottom">
                Copyright &#169; John Harvard
            </div>

        </div>

    </body>

</html>
