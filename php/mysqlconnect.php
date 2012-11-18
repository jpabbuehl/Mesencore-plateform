<?php
$user="root";
$password="tournament";
$database="mesencore";
$server="localhost";
$connexion = mysql_connect($server,$user,$password) or die("Unable to connect database");
mysql_select_db($database, $connexion) or die("Unable to select database");
?>
