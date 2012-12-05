<script type="text/javascript">
/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/
//var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()//2017, 3, 14, 0, 0, 0, 0)
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for (var i=1; i<32; i++)
dayfield.options[i]=new Option(i)
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
for (var m=1; m<13; m++)
//monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[m]=new Option(m)
//monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
//monthfield.options[today.getMonth()]=new Option(today.getMonth(), today.getMonth(), true, true) //select today's month
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
<button type="submit" class="search_date">Search Dates</button>
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
//function to zero pad dates
function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

$(document).ready(function() {
    //make js understand the php variable passed in from controller
    var members = <?php echo json_encode($members); ?>;
    console.log(members);
    
    $('.search_date').click(function() {
        //read information from dropdown here, because DOM is not loaded previously
        var sday= zeroPad($("#sday").val(),2);
        var smonth = zeroPad($("#smonth").val(),2);
        var syear = $("#syear").val();
        var eday = zeroPad($("#eday").val(),2);
        var emonth = zeroPad($("#emonth").val(),2);
        var eyear = $("#eyear").val();
        var sdatestring = syear + "-" + smonth + "-"+ sday+"T00:00:00-05:00";
        var edatestring = eyear + "-" + emonth + "-"+ eday+"T00:00:00-05:00";
        console.log(sdatestring);
        console.log(edatestring);
        //now build object containing ids to send in ajax
        var calendar_ids = [];
        //i here is the key, automatically increments
        for (i in members)
        {
            calendar_ids[i] = {
                "id": members[i]
            };
        }        
        $.ajax({
            url:'https://www.googleapis.com/calendar/v3/freeBusy?key=AIzaSyAtbPQBk1DDAWgBAs07k3f7QKhtPa434-o',
            type:'POST',
            contentType: 'application/json',
            data: JSON.stringify({
            "timeMin": sdatestring,
            "timeMax": edatestring,
            "timeZone":"EST",
            //send object of ids 
            "items": calendar_ids
        }),

        success:function(response,textStatus,jqXHR){
        // Create an empty array to store times
        var users = response["calendars"];
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
        //now add all events to mastercalendar
        var mastercalendar = <?php echo json_encode($mastercalendar); ?>;
        console.log(mastercalendar);
        
        //create event for each event...stored as an object?
        for(var event in events)
        {   
            //TODO still need to go one more layer down to objects!
            //TODO figure out authorization stuff
            if(event!== '')
            {
                var j = 0;
                var endtime = events[j]["end"];
                var starttime = events[j]["start"];
                j++;
                $.ajax({            
                    url:'https://www.googleapis.com/calendar/v3/calendars/'+'mastercalendar'+'/events?key=AIzaSyCFj15TpkchL4OUhLD1Q2zgxQnMb7v3XaM',
                    type:'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "end": 
                      {
                        "dateTime": endtime
                      },
                        "start": 
                      {
                        "dateTime": starttime
                      }
                    }),
                });
            }
        }
        
        }
});
});
})
</script>

//success of first ajax will loop through all busy events of everyone and call ajax each time to create one event in master calendar

//success of second ajax will call free/busy query on master calendar

//success function of third ajax will reformat busy times into free times
