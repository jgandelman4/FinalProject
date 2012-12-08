<form>
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

<table>
<tr>
<button type="submit" class="search_date">Search Dates</button>
</tr>
</table>


<script>
//function to zero pad dates
$(document).ready(function() {
    
    $('.btn').click(function() {


   
    window.location.replace("https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/calendar&redirect_uri=http://ec2-54-234-13-85.compute-1.amazonaws.com&response_type=code&client_id=1079769168876.apps.googleusercontent.com&approval_prompt=force");
    
    });
})

</script>



<script>

$(document).ready(function() {
    $('.login').click(function() {
    console.log(hello);
        $.ajax({
            url:'https://www.googleapis.com/calendar/v3/calendars?key=AIzaSyAtbPQBk1DDAWgBAs07k3f7QKhtPa434-o',
            type:'POST',
            contentType: 'application/json',
            data: JSON.stringify(
            {
                "summary": "mastercalendar"
            }
           ),

            success:function(response,textStatus,jqXHR){
            var mastercalendar = response["id"];
                }
                //console.log(mastercalendar);
            });
            });
})
</script>
