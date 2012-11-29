
<script type="text/javascript">

/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/

var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];

function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for (var i=0; i<31; i++)
dayfield.options[i]=new Option(i, i+1)
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
for (var m=0; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=0; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}
</script>



<form action="" name="someform">
<select id="daydropdown">
</select> 
<select id="monthdropdown">
</select> 
<select id="yeardropdown">
</select> 
</form>

<script type="text/javascript">

//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
window.onload=function(){
populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
}
</script>




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
