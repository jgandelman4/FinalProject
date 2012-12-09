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

//Auto date fill-in function taken from http://www.javascriptkit.com/ to populate the dropdowns
function populatedropdown(dayfield, monthfield, yearfield){
    var today=new Date();
    var dayfield=document.getElementById(dayfield);
    var monthfield=document.getElementById(monthfield);
    var yearfield=document.getElementById(yearfield);
    for (var i=1; i<32; i++)
        dayfield.options[i]=new Option(i);
    dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true); //select today's day
    for (var m=1; m<13; m++)
        monthfield.options[m]=new Option(m);
    monthfield.options[today.getMonth() + 1] = new Option(today.getMonth() + 1, today.getMonth() + 1, true, true); //select today's month
    var thisyear=today.getFullYear();
    for (var y=0; y<20; y++){
        yearfield.options[y]=new Option(thisyear, thisyear);
        thisyear+=1;
    }
    yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true); //select today's year
}
</script>

<script type="text/javascript">
//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
window.onload=function(){
populatedropdown("sday", "smonth", "syear")
populatedropdown("eday", "emonth", "eyear")
}
</script>

<script type="text/javascript">
//function to zero pad dates, so that date submitted to google is in RFC3339 format,
//taken from http://stackoverflow.com/questions/2998784/how-to-output-integers-with-leading-zeros-in-javascript
function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

//when DOM is loaded and button clicked, send ajax to Google
$(document).ready(function() {
    
    //make js understand the php variable passed in from controller
    var members = <?php echo json_encode($members); ?>;
    
    $('.search_date').click(function () {        
        //read information from dropdown to send first ajax to freebusy all users
        var sday= zeroPad($("#sday").val(),2);
        var smonth = zeroPad($("#smonth").val(),2);
        var syear = $("#syear").val();
        var eday = parseInt($("#eday").val())+1;
        var eday_formatted = zeroPad(eday, 2);
        var emonth = zeroPad($("#emonth").val(),2);
        var eyear = $("#eyear").val();
        var sdatestring = syear + "-" + smonth + "-"+ sday+"T00:00:00-05:00";
        var edatestring = eyear + "-" + emonth + "-"+ eday_formatted+"T00:00:00-05:00";

        //now build object containing ids to send in ajax
        var calendar_ids = [];
        for (i in members)
        {
            calendar_ids[i] = {
                "id": members[i]
            };
        } 

        //send ajax request to call freebusy on all member calendars with our key      
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

        success:function(response,textStatus,jqXHR) {
            // Create an empty array to store times returned by freebusy
            var users = response["calendars"];
	        var events = [];
	        var i = 0;
	        for(var user in users) 
	        {   
                var busy = users[user]["busy"];
                if (busy != undefined)
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
            
            //now use js sort function to sort everything in events
            events.sort(function(a,b) {
                //if there is a tie when sorting by beginning time, we sort by end time
                if (a[0] == b[0])
                {
                    return a[1]-b[1];
                }
                return a[0]-b[0];
            });
            
            //now we compare the events and merge overlapping events
            var master_busy = [];
            var j = 0;
            for (i in events)
            {   
                //turn i from a string into an int
                i = parseInt(i);
                if(events[i+1]!= undefined)
                {
                    if(events[i][1] >= events[i+1][0])
                    {
                        events[i+1][0]= events[i][0];  
                        if(events[i+1][1]< events[i][1])
                            events[i+1][1]= events[i][1]; 
                    }
                    else 
                    {
                          //if there is no overlap with previous event, push into masterbusy array
                          master_busy[j] = events[i]; 
                          j++;
                    }                
                    i++;
                }
                else
                {
                    //push last into masterbusy array
                    master_busy[j]= events[i];
                }
            }
            
            //determine the order to print free times
            var beginning = new Date(sdatestring);
            var end = new Date(edatestring);
                        
            //if the beginning point is free, the beginning point is the first free beginning
            var first_busy_start = master_busy[0][0];
            if (beginning.getTime()< first_busy_start)
            {                
                document.write("WeFree Start Time:");
                document.write(beginning);
                for (j in master_busy)
                   {
                        j = parseInt(j);
                        var fdate_s = new Date(master_busy[j][0]);
                        var fdate_e = new Date(master_busy[j][1]);
                        
                        //remember to close the last case
                        if(master_busy[j+1] == undefined)
                        {
                            var last_busy_end = master_busy[j][1];
                            if(last_busy_end >= end.getTime() )
                            {
                                document.write("WeFree End Time:");
                                document.write(fdate_s);
                            }
                            else
                            {
                                document.write("WeFree End Time:");
                                document.write(fdate_s);
                                document.write("WeFree Start Time:");
                                document.write(fdate_e);
                                document.write("WeFree Start Time:");
                                document.write(end);
                                
                            }
                        }
                        else
                        {
                            document.write("WeFree End Time:");
                            document.write(fdate_s);
                            document.write("WeFree Start Time:");
                            document.write(fdate_e);
                        }
                   }                
            }
            //if the beginning point is busy, the first free beginning is the end of the first busy
            else
            {
                for (j in master_busy)
                   {
                        j = parseInt(j);
                        if (master_busy[j+1] != undefined)
                        {
                            var fdate_s = new Date(master_busy[j][1]);
                            var fdate_e = new Date(master_busy[j+1][0]);
                            document.write("WeFree Start Time:");
                            document.write(fdate_s);
                            document.write("WeFree End Time:");
                            document.write(fdate_e);
                        }
                   }
            }          
                                
            }//this is the end of the success function of the first ajax
        });
    });//end of onclick     
})//end of dom load
</script>

