
/****
//will recognize start and end from code above?
//how to transform ito RFC3999?

$start= date($("#start"));
$end= date($("#end"));
$(document).ready(function() {

$(".btn").click(function() {

    $.ajax({
    url:'https://www.googleapis.com/calendar/v3/freeBusy?key={AIzaSyBwAfKa5glQIm_cTkPZKbjIAaiOUNHlIRE}',
    type:'POST',
    data: {
    "timeMin": $start;
    "timeMax": $end;
    "timeZone":"EST"; },
    // sql query in user database for gmails where group key = person logged in's group key
    success:function(){
    //this function will import all events to master calendar
    var busy = whatever the result is called;
    for (var busyevent in busy)
        add events to master calendar;  
        
        complete 
    },
    //here's an example
    /**
    success: function(response) {
                  // build html string for a list of suggestions
                  var suggestions = '<ul>';
                  for (var i in response.symbols)
                      suggestions += '<li><a href="#" class="suggestion">' + response.symbols[i] + '</a></li>';

                  // display list of suggestions
                  suggestions += '</ul>';
                  $('#suggestions').html(suggestions);
              }
    **/
    failture:function(){alert('something went wrong!');},
    
    

});
//success of first ajax will loop through all busy events of everyone and call ajax each time to create one event in master calendar

//success of second ajax will call free/busy query on master calendar

//success function of third ajax will reformat busy times into free times
