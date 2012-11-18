<?php

function maketable($query, $fieldarray , $header){

include("mysqlconnect.php");
//count number of columns
 $columns = count($fieldarray);
//run the query
 $result = mysql_query($query) or die(mysql_error()) ;
 $itemnum = mysql_num_rows($result);

 $flag=0; ## For header

 if($itemnum > 0){
  while($items = mysql_fetch_assoc($result)){
   ## Header display
   if($flag==0){
      echo "<thead><tr>";
      for($y = 0; $y < $columns; $y++){
        echo "<th>" .$header[$y]. "</td>" ;
      }
   echo "</tr></thead><tbody>" ; $flag=1;
   }
   echo "<tr>" ;
   for($x = 0; $x < $columns; $x++){
   
      echo "<td>" .$items[$fieldarray[$x]]. "</td>" ;
   
   }
   echo "</tr>" ;
  };
  echo"</tbody>";
 }
}


?>