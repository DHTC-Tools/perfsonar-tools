<?
if(isset($_GET["type"]) and $_GET["type"] == "throughput") require("throughput.php");
else require("latency.php"); 
?>