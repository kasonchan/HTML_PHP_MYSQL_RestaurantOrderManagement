<?php
require_once("DatabaseFunctions.php");

$var = $_GET['var'];

$con = ConnectDatabase();
$tablet_id = getTabletID();

$tabnum = (int)($var/5);

$q="SELECT T.ingredient_name FROM order_ingredient as T, ingredient as S WHERE T.ingredient_name = S.ingredient_name AND S.ingredient_type = 'meat' AND T.table_number='$tabnum' AND T.serve='N'";
$q2 = mysql_query($q);

echo "Table Number $tabnum <br/> <br/>";

echo "You need to bring: <br/><br/><br/>";

$q="SELECT * FROM order_ingredient WHERE table_number='$tabnum' AND serve='N' AND cook='Y'";
$q2 = mysql_query($q);
$arr = array();
while ($row2=mysql_fetch_row($q2)) {
  $arr[] = $row2[1];
}
$arr = array_unique($arr);

foreach ($arr as $ord) {
  $q="SELECT * FROM order_ingredient WHERE order_number='$ord' AND serve='N' AND cook='Y' AND table_number='$tabnum'";
  $q2 = mysql_query($q);
  echo "Order number $ord: <br/>";
  while ($row2=mysql_fetch_row($q2)) {
    if ($row2[4] == "Y") {
       echo "$row2[2] ";
    }  
  }
  echo "<br/><br/>";
}


echo "<br/>";

echo "<meta http-equiv=\"REFRESH\" content=\"20;url=http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php?var=".$var."\">"

?>
