<?php

  require("../includes/config");

$client = new Google_Client();
$service = new Google_CalendarService($client);

$events = $service->events->listEvents('CS50');

$free_times = [];
foreach ($events->getItems() as $event)
{
  // find free times
  // add to free_times array
}

foreach ($free_times as $free_time)
{
  // create new "free time" event
  $service->events->create(...)
}




  echo $event->getSummary();
  echo $event->getDescription();
  echo $event->getKind();
  echo $event->getUpdated();

  $
}

?>