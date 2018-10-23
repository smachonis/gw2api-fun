<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Guild Wars 2 API Testing</title>
<link href="gw2_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

$url = file_get_contents("https://api.guildwars2.com/v1/world_names.json");
$worlds = json_decode($url,true);
$na_worlds = array();
$eu_worlds = array();
foreach ($worlds as $world)
{
	if($world['id'] < 2000)
	  array_push($na_worlds, array('name' => $world['name'], 'id' => $world['id']));
	else
	  array_push($eu_worlds, array('name' => $world['name'], 'id' => $world['id']));
}

asort($na_worlds);
asort($eu_worlds);

$print_na ="";
$print_eu ="";

foreach ($na_worlds as $world)
{
	$print_na.= '<a href="maps.php?w='.$world['id'].'">'.$world['name'].'</a><br />';
}

foreach ($eu_worlds as $world)
{
	$print_eu.='<a href="maps.php?w='.$world['id'].'">'.$world['name'].'</a><br />';
}

?>
<a href="worlds.php">Check World Population Status</a><p>
<table id="world-menu">
<thead>
  <tr>
    <th colspan="2">Choose a World</th>
  <tr>
    <th>North American Servers</th>
    <th>European Servers</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <td colspan="2">Thanks for Stopping By! Email me at <a href="mailto:steven@machonis.me">steven@machonis.me</a></td>
  </tr>
</tfoot>
<tbody>
  <tr>
    <td><?php echo $print_na; ?></td>
    <td><?php echo $print_eu; ?></td>
  </tr>
</tbody>
</table>

</body>
</html>