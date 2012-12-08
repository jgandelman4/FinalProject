<form action="login.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="member" placeholder="Gmail Address" type="text"/>
        </div>
        <div class="control-group">
            <input name="password" placeholder="Group Password" type="password"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Log in to group page!</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="registergroup.php">create</a> for a group
    or <a href="register.php">join</a> a group
</div>

<script>
$.ajax({
    url:'https://www.google.com/accounts/ClientLogin',
    type:'POST',
    contentType: 'application/json',
    data: JSON.stringify({
    "timeMin": sdatestring,
    "timeMax": edatestring,
    "timeZone":"EST",
    //send master calendar id 
    "items": [{"id": mastercalendar}]
    }),
                            
    //now we output the free times
    success:function(response,textStatus,jqXHR){
        //deal with the string called "Auth"
        //After a successful authentication request, use the Auth value to create an Authorization header for each request:
        //Authorization: GoogleLogin auth=yourAuthValue


        }
</script>