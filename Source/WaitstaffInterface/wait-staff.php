<?php

require_once("DatabaseFunctions.php");


$con = ConnectDatabase();

$tablet_id = getTabletID();



$q="UPDATE table_status set assign_to='N' WHERE assign_to='$tablet_id'";
$q2 = mysql_query($q);


?>


<html>

   <head>

      <title>Wait-Staff Interface</title>

   </head>

   <link rel="stylesheet" type="text/css" href="style.css" />
 
   <body>
      
      <center><img src="maintitle.JPG" height="300" width="550" /> <br /> <br /> <br />

      <label></label><a href="Login.php"><input type="submit" value="Log In" class="button" /></a> </center>      
   </body>

</html>
