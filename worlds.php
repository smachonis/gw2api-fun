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

$sql = "SELECT w1.wid, w1.wname, w1.wpop, w1.wuptime FROM worlds_pop w1 JOIN (SELECT wid, MAX(wuptime) wuptime FROM worlds_pop GROUP BY wid) w2 ON w1.wid = w2.wid AND w1.wuptime = w2.wuptime ORDER BY w1.wname";
$result = $conn->query($sql);

$print_worlds = "";

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

        $print_worlds.= "<td><a href=\"http://steven.machonis.me/projects/gw2/world.php?i=".$row["wid"]."\">".$row["wname"]."</a></td><td>".$row["wpop"]."</td><td>".$row["wuptime"]."</td></tr>";
    }
} else {
    $print_worlds.="<tr><td>0 results</td><td></td><td></td></tr>";
}

$conn->close();

/*foreach ($results as $result)
{
	$print_maps.=print_r($result);
}
*/

?>
<p>All Times US Eastern Time Zone</p>
<table id="world-menu">
<thead>
  <tr>
    <th>Server Name</th>
    <th>Pop Status</th>
    <th>Last Update</th>
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