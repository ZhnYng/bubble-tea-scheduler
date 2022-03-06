<?php
$servername = "sql102.epizy.com";
$username = "epiz_30505380";
$password = "lhdPuZBk9I";
$dbname = "epiz_30505380_bubbleTeaSchedule";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
?>