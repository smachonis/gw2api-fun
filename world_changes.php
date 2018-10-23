<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="gw2_style.css" rel="stylesheet" type="text/css" />
<title>Guild Wars 2 API Testing</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $("#server").on('change', function() {
           var serverid = $(this).val();
           var url = "world_changes.php?i=";
           window.location = url+serverid;
           
       });
    });
</script>
</head>
<body>
    <h2>Show Server Population Changes</h2>
    
<?php

include "db_conn.php";

$conn = new mysqli($server,$db_user,$db_pass,$database);
if($conn ->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}
    
$sql = "SELECT DISTINCT wid, wname FROM worlds_pop ORDER BY wname ASC";
$result = $conn->query($sql);
echo "Select Server: <select id='server'>";
echo "<option value=\"\"></option>";
while($row = $result->fetch_assoc()) {
    $selected = "";
    if($row['wid'] == $_GET['i']) {
        $selected = "selected";
    }
    echo "<option value=".$row['wid']." ".$selected.">".$row['wname']."</option>";
}
echo "</select>";

$sql = "SELECT wname, wpop, wuptime FROM worlds_pop WHERE wid = ".$_GET["i"]." ORDER BY wuptime ASC";
$result = $conn->query($sql);

$print_worlds = "";
$server = "";
$first = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        if($first == 0) {
            $prev_wuptime = $row['wuptime'];
            $prev_pop = $row['wpop'];
            $first = 1;
        } else {
            $curr_wuptime = $row['wuptime'];
            $curr_pop = $row['wpop'];
            if($curr_pop != $prev_pop) {
                $print_worlds.="<tr><td>".$prev_pop."</td><td>".$curr_pop."</td><td>".$curr_wuptime."</td></tr>";            
            }

            $prev_wuptime = $row['wuptime'];
            $prev_pop = $row['wpop'];
        }
    }
}

$conn->close();

?>
<table id="world-menu">
<thead>
  <tr>
    <th>Previous</th>
    <th>New</th>
    <th>Time</th>
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