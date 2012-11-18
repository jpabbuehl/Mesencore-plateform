<?php

// This script gets data via POST from books_edit_js.php

// The POST request supplies the following data:
//
// row_id   => corresponds to the id in the database table 
// value    => the actual (changed) content to be written 
// column   => which column number(!) 

$database="mesencore";
$host="localhost";
$user="root";
$password="tournament";
$table="caf_cluster";

mysql_connect($host,$user,$password);
mysql_select_db($database) or die( "Unable to select database");

$rawdata    = $_POST;

// Grab the data from the $_POST request
$id             = $rawdata['id'];
$value          = $rawdata['value'];
$column         = $rawdata['columnName'];

$query  = "update $table set $column=$value where GENE_ID=$id";
$result = mysql_query($query);

// Provide feedback to the entry field 
if (!$result) { echo "Update failed"; }
else          { echo "UPD: $value"; }

echo $value;
// Close the connection 
mysql_close();
?>
