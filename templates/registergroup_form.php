<form action="registergroup.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="gmail" placeholder="Gmail Address" type="text"/>
        </div>
        <div class="control-group">
            <input autofocus name="groupkey" placeholder="Your Unique Group Password" type="text"/>
        </div>
        <div class="control-group">
            <a href="instructions.php" onclick="return popitup('instructions.php')">Complete Calendar Sharing Instructions before Registration is Complete</a>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Create New WeFree Group!</button>
        </div>
    </fieldset>
</form>

<script language="javascript" type="text/javascript">
// popitup function from http://www.quirksmode.org/js/popup.html
function popitup(url) {
	newwindow=window.open(url,'Calendar Sharing Instructions','height=500,width=1000');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>

