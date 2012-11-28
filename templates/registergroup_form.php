<form action="register.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="username" placeholder="Username" type="text"/>
        </div>
        <div class="control-group">
            <input name="password" placeholder="Password" type="password"/>
        </div>
        <div class="control-group">
            <input name="confirmation" placeholder="Confirm Password" type="password"/>
        </div>
        <div class="control-group">
            <input autofocus name="gmail" placeholder="Gmail address associated with your Gcal" type="text"/>
        </div>
        <div class="control-group">
            <input autofocus name="groupkey" placeholder="Your unique group key" type="text"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Create Group!</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">log in</a> if you registered an account previously
</div>
