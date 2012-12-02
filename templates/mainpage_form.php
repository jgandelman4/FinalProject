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
<form id="start">
<td><select id="sday"></select></td> 
<td><select id="smonth"></select></td> 
<td><select id="syear"></select></td> 
</form>
</tr>

<tr>
<form id="end">
<td><select id="eday"></select></td> 
<td><select id="emonth"></select></td> 
<td><select id="eyear"></select></td> 
</form>
</tr>

<tr>
<button type="submit" class="btn">Search Dates</button>
</tr>

</table>


<script type="text/javascript">

//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
window.onload=function(){
populatedropdown("sday", "smonth", "syear")
populatedropdown("eday", "emonth", "eyear")
}
</script>

<script>
// format $start, $end by concatenation into RFC 3339 format 
//JS does not have $! jQuery has $ - meaning selector

//define all of them here first...
//var datestring = year + "-" + month + "-"+

var sday= $("#sday").val();
//console.log(sday);
var smonth = $("#smonth").val();
var syear = $("#syear").val();
var eday = $("#eday").val;
var emonth = $("#emonth").val;
var eyear = $("#eyear").val;
var sdatestring = syear + "-" + smonth + "-"+ sday+"T00:00:00-05:00";
var edatestring = eyear + "-" + emonth + "-"+ eday+"T00:00:00-05:00";
console.log(members);

$(document).ready(function() {

$(".btn").click(function() {

    $.ajax({
    url:'https://www.googleapis.com/calendar/v3/freeBusy?key=AIzaSyAtbPQBk1DDAWgBAs07k3f7QKhtPa434-o',
    type:'POST',
    contentType: 'application/json',
    data: JSON.stringify({
    "timeMin": '2012-11-29T00:00:00-05:00',
    "timeMax": '2012-12-01T00:00:00-05:00',
    //"timeZone":"EST", 
    "items":
    [
        {
          //we will loop to through members with js
          /**for (var member in members)
          echo"{id:"INSERT HERE"}"
          */        
          "id": "jgandelman4@gmail.com"
        },
        {
          "id": "shuaishuai333@gmail.com" 
        }
    ]   
    }),

    success:function(response,textStatus,jqXHR){
    // Create an empty array to store times
    var users = response["calendars"];
	// Loop through the items
	var events = [];
	var i = 0;
	for(var user in users) 
    {   
        for (var time in users[user]) 
        //these are all busy times stored in sequence of user calendar
        events[i]= users[user]["busy"];
        i++;
    }
    console.log(events);
 
    $.ajax{
    //now we will have all busy times in events, all users in users
    //insert all events into the master calendar
     
     }
//create new event with ajax request    
    //jquery read json 
    //loop through each key in json 
    //add each busy event to an array
    //call new JS function that sets off ajax!
    }
});


});
});

</script>

//success of first ajax will loop through all busy events of everyone and call ajax each time to create one event in master calendar

//success of second ajax will call free/busy query on master calendar

//success function of third ajax will reformat busy times into free times
