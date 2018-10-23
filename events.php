<?php

function search($array, $key, $value) 
{ 
    $results = array(); 

    if (is_array($array)) 
    { 
        if (isset($array[$key]) && $array[$key] == $value) 
            $results[] = $array; 

        foreach ($array as $subarray) 
            $results = array_merge($results, search($subarray, $key, $value)); 
    } 

    return $results; 
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Guild Wars 2 API Testing</title>
</head>
<body>
<?php

$world_id = $_GET['w'];
$map_id = $_GET['m'];

$url = file_get_contents("https://api.guildwars2.com/v1/events.json?world_id=$world_id&map_id=$map_id");
$events = json_decode($url,true);

$url = file_get_contents("https://api.guildwars2.com/v1/event_names.json");
$event_names = json_decode($url,true);

$url = file_get_contents("https://api.guildwars2.com/v1/map_names.json");
$map_names = json_decode($url,true);

//print_r($events);

echo '<a href="maps.php?w='.$world_id.'">Choose a different location</a><br />';

foreach ($events['events'] as $event)
{
	$find_event_id = $event['event_id'];
	$event_key = search($event_names, "id", $find_event_id);
	
	$find_map_id = $event['map_id'];
	$map_key = search($map_names, "id", $find_map_id);
	
	echo '<a href="event.php?e='.$event['event_id'].'">Event - '.$event_key[0]['name'].' '.$event['state'].'</a><br />';
}


?>
</body>
</html>