<?php
require_once("DatabaseFunctions.php");

$var = $_GET['var'];

$con = ConnectDatabase();
$tablet_id = getTabletID();

$tabnum = (int)($var/5);
$switcht = $var % 5;


$q="SELECT assign_to from table_status WHERE table_number='$tabnum'";
$q2 = mysql_query($q);
$row2=mysql_fetch_row($q2);


if ($row2[0] == $tablet_id || $tabnum == 0) {


switch ($switcht) {
case 0:

echo "$tabnum $switcht";
$q="UPDATE table_status set occupied='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

break;
case 1:
echo "$tabnum $switcht";
$q="UPDATE table_status set call_staff='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

break;
case 2:
echo "$tabnum $switcht";
$q="UPDATE order_ingredient set serve='Y' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

echo "$tabnum $switcht";
$q="UPDATE table_status set refill='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

break;
case 3:
echo "$tabnum $switcht";
$q="UPDATE order_ingredient as S, table_status as Y, ingredient as T SET S.serve = 'Y' WHERE S.table_number = '2' AND Y.refill = 'Y' AND S.serve = 'N' AND T.ingredient_name = S.ingredient_name AND T.ingredient_type = 'Drink';";
$q2 = mysql_query($q);


echo "$tabnum $switcht";
$q="UPDATE table_status set refill='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);


break;
case 4:
echo "$tabnum $switcht";
$q="UPDATE table_status set checkout='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

echo "$tabnum $switcht";
$q="DELETE from order_ingredient WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

echo "$tabnum $switcht";
$q="UPDATE table_status set assign_to='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);


echo "$tabnum $switcht";
$q="UPDATE table_status set occupied='N' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);

echo "$tabnum $switcht";
$q="UPDATE table_status set total='0',tips='0' WHERE table_number='$tabnum'";
$q2 = mysql_query($q);


break;
}
}
echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php\">"


?>


