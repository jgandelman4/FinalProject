
<script type="text/javascript">
console.log(
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
for (var i=1; i<32; i++)
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

<table>
<tr>
<form name="start">
<td><select id="startdaydropdown"></select></td> 
<td><select id="startmonthdropdown"></select></td> 
<td><select id="startyeardropdown"></select></td> 
</form>
</tr>

<tr>
<form name="end">
<td><select id="enddaydropdown"></select></td> 
<td><select id="endmonthdropdown"></select></td> 
<td><select id="endyeardropdown"></select></td> 
</form>
</tr>

<tr>
<button type="submit" class="btn">Search Dates</button>
</tr>

</table>


<script type="text/javascript">

//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
window.onload=function(){
populatedropdown("startdaydropdown", "startmonthdropdown", "startyeardropdown")
populatedropdown("enddaydropdown", "endmonthdropdown", "endyeardropdown")
}
</script>


<script>
// format $start, $end by concatenation into RFC 3339 format 
$start=date($("#start"));

$(document).ready(function() {

$(".btn").click(function() {

    $.ajax({
    url:'https://www.googleapis.com/calendar/v3/freeBusy?key={AIzaSyBwAfKa5glQIm_cTkPZKbjIAaiOUNHlIRE}',
    type:'POST',
    data: {
    "timeMin":"2012-11-24T00:00:00+00:00"
    "timeMax":"2012-11-25T00:00:00+00:00""
    "timeZone":"EST" 
    "items": [
        {
          "id": "jgandelman4@gmail.com"
        }
        ]   
    },
    success:function(response){
    // Create an empty array to store times
	var events = [];

	// Loop through the items
	for(var key in response) 
    {
         i=0;
         events.starti=calendars.(key).busy[].start;
         events.endi=calendars.(key).busy[].end;
         i++;
         
    }
    
    for (var key in events)
    {
        document.writeln('events[key]');
    }
    
    //jquery read json 
    //loop through each key in json 
    //add each busy event to an array
    //call new JS function that sets off ajax!
    }
    
    
    

});

</script>

//success of first ajax will loop through all busy events of everyone and call ajax each time to create one event in master calendar

//success of second ajax will call free/busy query on master calendar

//success function of third ajax will reformat busy times into free times
