
<?php

require_once("DatabaseFunctions.php");

$var = $_GET['var'];

$con = ConnectDatabase();

$tablet_id = getTabletID();


echo "stuff" . $var ."      " .$tablet_id;

$q="SELECT assign_to FROM table_status WHERE table_number='$var'";
$q2 = mysql_query($q);
$row2=mysql_fetch_row($q2);

if ($row2[0] == 'N') {
  $q="UPDATE table_status set assign_to='$tablet_id' WHERE table_number='$var'";
  $q2 = mysql_query($q);
}
echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-left2.php\">"

?>

