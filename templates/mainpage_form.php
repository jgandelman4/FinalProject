<form>
    <fieldset>
        <div class="control-group">
            <input autofocus name="starttime" placeholder="Start Time" id="start" type="text"/>
        </div>
        <div class="control-group">
            <input autofocus name="endtime" placeholder="End Time" id="end" type="text"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Suggest Time</button>
        </div>
    </fieldset>
</form>



<script>

$start=date($("#start"));

$(document).ready(function() {

$(".btn").click(function() {

    $.ajax({
    url:'https://www.googleapis.com/calendar/v3/freeBusy?key={YOUR_API_KEY}',
    type:'POST',
    data: {
    "timeMin":"$("#start")"
    "timeMax":""
    "timeZone":"" },
    // sql query in user database for gmails where group key = person logged in's group key
    
    

});

</script>

//success of first ajax will loop through all busy events of everyone and call ajax each time to create one event in master calendar

//success of second ajax will call free/busy query on master calendar

//success function of third ajax will reformat busy times into free times
