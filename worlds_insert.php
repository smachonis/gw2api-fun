<?php

$db_admin="smachoni_gw2admi";
$db_adpass="waD0RuU05no0o2usx2";
$database = "smachoni_gw2";

mysql_connect(localhost,$db_admin,$db_adpass);

@mysql_select_db($database) or die( "Unable to select database");


$url = file_get_contents("https://api.guildwars2.com/v2/worlds?ids=all");
$worlds = json_decode($url,true);
date_default_timezone_set("America/New_York");
$when = date("Y-m-d H:i:s"); 
//echo $when->format('Y-m-d H:i:s');

foreach ($worlds as $world)
{
	$world_id = $world['id'];
	$world_pop = $world['population'];
	$world_name = mysql_real_escape_string($world['name']);

	echo $world_id." ".$world_name." ".$world_pop." ".$when."<br />";

	$query = "INSERT INTO worlds_pop VALUES ('','$world_id','$world_name','$world_pop','$when')";
	mysql_query($query);

	if ($world_id == 1017 && $world_pop != "Full") {
		//Email information
		$admin_email = "admin@machonis.me";
	  	$email = "smachonis@gmail.com";
	 	$subject = "Tarnished Coast is Available";
	  	$comment ="Tarnished Coast Server is Not Full at ".$when;
	  
	  	//send email
	  	//mail($email, $subject, $comment);
	  	echo "Emailed Attempted to Send";
	}
}

mysql_close();

?>