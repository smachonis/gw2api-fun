<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
#map { position: absolute;
    width:500px; height:500px; }
</style>
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.css" />
 <!--[if lte IE 8]>
     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.ie.css" />
 <![endif]-->
<script src="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.js"></script>

<title>Untitled Document</title>
</head>
<body>
<div id="map"></div>
<script>
   
var map = L.map('map').setView([0,0], 2);
	    
L.tileLayer("https://tiles.guildwars2.com/1/1/{z}/{x}/{y}.jpg", {
	minZoom: 0,
	maxZoom: 7,
	continuousWorld: true
}).addTo(map);

var marker = L.marker([200, -200]).addTo(map);
var marker = L.marker([-200, 200]).addTo(map);
var marker = L.marker([200, 200]).addTo(map);
var marker = L.marker([-200, -200]).addTo(map);

</script>
</body>
</html>