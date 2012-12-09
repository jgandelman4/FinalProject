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
monthfield.options[today.getMonth() + 1] = new Option(today.getMonth() + 1, today.getMonth() + 1, true, true) //select today's month
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
//function to zero pad dates, so that date submitted to google is in RFC3339 format
//taken from http://stackoverflow.com/questions/2998784/how-to-output-integers-with-leading-zeros-in-javascript
function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

//js function to read querystring to get authentication code from google
//taken from http://stackoverflow.com/questions/647259/javascript-query-string
function getQueryString() {
    var result = {}, queryString = location.search.substring(1),
      re = /([^&=]+)=([^&]*)/g, m;

    while (m = re.exec(queryString)) {
    result[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    return result;
}

$(document).ready(function() {
    
    //make js understand the php variable passed in from controller
    var members = <?php echo json_encode($members); ?>;
    console.log(members);
    
    $('.search_date').click(function () {

        //TODO handle permission response here. exchange authorization code for token
        //need to understand how to use ajax to do this....
        /*
        https://developers.google.com/oauthplayground/?code=4/vnZ4X3Tm4BRZHeTUiHFqMaYpspgT.UgBbFtB8GhsUshQV0ieZDArY_5D2dgI
        */
        
        //read information from dropdown to send first ajax to freebusy all users
        var sday= zeroPad($("#sday").val(),2);
        var smonth = zeroPad($("#smonth").val(),2);
        var syear = $("#syear").val();
        var eday = zeroPad($("#eday").val(),2);
        var emonth = zeroPad($("#emonth").val(),2);
        var eyear = $("#eyear").val();
        var sdatestring = syear + "-" + smonth + "-"+ sday+"T00:00:00-05:00";
        var edatestring = eyear + "-" + emonth + "-"+ eday+"T00:00:00-05:00";

        //now build object containing ids to send in ajax
        var calendar_ids = [];
        //i here is the key, automatically increments
        for (i in members)
        {
            calendar_ids[i] = {
                "id": members[i]
            };
        } 
        //send ajax request to call freebusy on all member calendars       
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
                var busy = users[user]["busy"];
                if (busy !== null)
                {
                    for (var time in busy) 
                    //events is an array of arrays, each of which contains an array of objects, each object has "end" "start"
                    {
                        var start = new Date(busy[time]["start"]);
                        var end = new Date(busy[time]["end"]);
                        
                        events[i]= new Array(start.getTime(), end.getTime());
                        i++;
                    } 
                 }       
            }
            document.write(events);
            
            //now use js sort function to sort
            events.sort(function(a,b) {
                //if there is a tie, we sort by end time
                if (a[0] == b[0])
                {
                    return a[1]-b[1];
                }
                return a[0]-b[0];
            });
            console.log(events);
            
            var master_busy = [];
            var j = 0;
            //now we compare the events and combine repetitive events
            for (i in events)
            {   
                i = parseInt(i);
                if(events[i+1]!= undefined)
                {
                    if(events[i][1] >= events[i+1][0])
                    {
                        //merge
                        events[i+1][0]= events[i][0];  
                        if(events[i+1][1]< events[i][1])
                            events[i+1][1]= events[i][1]; 
                    }
                    else 
                    {
                          master_busy[j] = events[i]; 
                          j++;
                    }                
                    i++;
                }
                else
                {
                    master_busy[j]= events[i];
                    console.log(master_busy[j]);
                }
            }
            
            
           for (j in master_busy)
           {
                var fdate_s=new Date(master_busy[j][0]);
                var fdate_e=new Date(master_busy[j][1]);
                document.write("free start time:");
                document.write(fdate_e);
                document.write("free end time:");
                document.write(fdate_s);
           }
                
                
                }//this is the end of the success function of the first ajax
            });
        });//end of onclick     
})//end of dom load
</script>

