<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Guild Wars 2 API Testing</title>
</head>
<body>
<?php

echo '<p>Event Details<br />';
$event_id = $_GET['e'];
$url = file_get_contents("https://api.guildwars2.com/v1/event_details.json?event_id=$event_id");
$event = json_decode($url,true);
print_r($event);
echo '</p>';

echo '<p><br />';
$url = file_get_contents("https://api.guildwars2.com/v1/continents.json");
$cont = json_decode($url,true);
print_r($cont);
echo '</p>';

echo '<p>Maps<br />';
$url = file_get_contents("https://api.guildwars2.com/v1/maps.json?map_id=54");
$event = json_decode($url,true);
print_r($event);
echo '</p>';

echo '<p>Map Floor<br />';
$url = file_get_contents("https://api.guildwars2.com/v1/map_floor.json?continent_id=1&floor=1");
$event = json_decode($url,true);
//print_r($event);
echo '</p>';




?>

<img src="https://tiles.guildwars2.com/1/1/2/1/1.jpg" />
</body>
</html>