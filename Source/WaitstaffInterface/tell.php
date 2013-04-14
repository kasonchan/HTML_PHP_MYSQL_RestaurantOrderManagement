<?php
require_once("DatabaseFunctions.php");

$var = $_GET['var'];

$con = ConnectDatabase();
$tablet_id = getTabletID();

$tabnum = (int)($var/5);

$q="SELECT T.ingredient_name FROM order_ingredient as T, ingredient as S WHERE T.ingredient_name = S.ingredient_name AND S.ingredient_type = 'drink' AND T.table_number='$tabnum' AND T.serve='N'";
$q2 = mysql_query($q);

echo "Table Number $tabnum <br/> <br/>";


echo "You need to bring: ";
while ($row2=mysql_fetch_row($q2)) {
  echo " $row2[0]";
}
echo "<br/>";

echo "<meta http-equiv=\"REFRESH\" content=\"5;url=http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php?var=".$var."\">"

?>
