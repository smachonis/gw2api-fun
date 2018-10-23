<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="gw2_style.css" rel="stylesheet" type="text/css" />
<title>Guild Wars 2 API Testing</title>
</head>
<body>
<?php
 include "db_conn.php";

$conn = new mysqli($server,$db_user,$db_pass,$database);
if($conn ->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}

$sql = "SELECT wname, wpop, wuptime FROM worlds_pop WHERE wid = ".$_GET["i"]." ORDER BY wuptime DESC LIMIT 192";
$result = $conn->query($sql);

$print_worlds = "";
$server = "";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        switch($row['wpop']) {
            case "Full":  $print_worlds.="<tr class=\"full\">";
                          break;
            case "VeryHigh":  $print_worlds.="<tr class=\"veryhigh\">";
                          break;
            case "High":  $print_worlds.="<tr class=\"high\">";
                          break;
            case "Medium":  $print_worlds.="<tr class=\"medium\">";
                          break;
            default: $print_worlds.="<tr>";
        }

        $print_worlds.= "<td>".$row["wuptime"]."</td><td>".$row["wpop"]."</td></tr>";
        
       
        $server = $row["wname"];
    }
} else {
    $print_worlds.="<tr><td>0 results</td><td></td></tr>";
}

$conn->close();

/*foreach ($results as $result)
{
	$print_maps.=print_r($result);
}
*/
echo "<a href=\"worlds.php\">Back to Server List</a>";
echo "<p>".$server."</p>";
echo "<p><a href=\"world_changes.php?i=".$_GET["i"]."\">View Server Population Changes</a></p>";
echo "<p>All Times US Eastern Time Zone</p>";

?>

<table id="world-menu">
<thead>
  <tr>
    <th>Update Time</th>
    <th>Status</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <td colspan="3">Thanks for Stopping By! Email me at <a href="mailto:steven@machonis.me">steven@machonis.me</a></td>
  </tr>
</tfoot>
<tbody>
    <?php echo $print_worlds; ?>
</tbody>
</table>
</body>
</html>