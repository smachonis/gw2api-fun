<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="gw2_style.css" rel="stylesheet" type="text/css" />
<title>Guild Wars 2 API Testing</title>
</head>
<body>
<?php

$url = file_get_contents("https://api.guildwars2.com/v1/map_names.json");
$maps = json_decode($url,true);
$world_id = $_GET['w'];

$print_maps = "";

foreach ($maps as $map)
{
	$map_id = $map['id'];
	$print_maps.='<a href="events.php?w='.$world_id.'&m='.$map_id.'">'.$map['name'].'</a><br />';
}


?>

<table id="world-menu">
<thead>
  <tr>
    <th colspan="2"><a href="index.php">Choose a World</a> >> Choose a Location</th>
  <tr>
    <th>Tyria</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <td>Thanks for Stopping By! Email me at <a href="mailto:steven@machonis.me">steven@machonis.me</a></td>
  </tr>
</tfoot>
<tbody>
  <tr>
    <td><?php echo $print_maps; ?></td>
  </tr>
</tbody>
</table>
</body>
</html>