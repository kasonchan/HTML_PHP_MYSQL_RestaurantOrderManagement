<html>

<script>
 function question($v)
 {
   alert("Table " + $v + "\nCustomer calling for waiter ");
 }

 function serve($v)
 {
   alert("Table " + $v + "\nPlease serve the food ");
 }


 function refill($v)
 {
   alert("Table " + $v + "\nDrink = \nNumber of Refills =  ");
 }
 
 function cash($v)
 {
   alert("Table " + $v + "\nPlease take customer cash ");
 }

 function tables($v)
 {
   window.location="http://students.cse.unt.edu/~kmh0237/Wait-Staff/set.php?var=" + $v;
 }

</script>
<?php


require_once("DatabaseFunctions.php");

$con = ConnectDatabase();

$tablet_id = getTabletID();
?>


 <link rel="stylesheet" type="text/css" href="style.css" />


 
 <?php
echo "<script type=\"text/javascript\">";
        echo "var url ='confirm.php';";
        echo "var delay = 20;";
        echo "var d = delay * 1000;";
        echo "window.setTimeout ('parent.location.replace(url)', d);";
        echo "</script>";
        

echo '<table align="center" >';

$max = getMaxTable();



$num = ($max/4);
 for ($i=1; $i<=$num; $i++) {
   echo "<tr>";
   
  for ($j=1; $j<=4; $j++) {$val = ($i-1)*4+$j;
   
     $q="SELECT refill,checkout,tips,total,call_staff,occupied,assign_to FROM table_status WHERE table_number=$val";
     $q2 = mysql_query($q);
     $row=mysql_fetch_row($q2);

     echo '<td>';
     if ($row[4] == 'Y') {
       echo '<img src="question.jpg" height="50" width="30" onclick="question('.$val.')">';
     } else {
       echo '<img src="empty.jpg" height="50" width="30">';
     }
     echo '</td>';
     
     echo '<td>';
     if ($row[0] == 'Y') {
       echo '<img src="drink.jpg" height="60" width="60" onclick="refill('.$val.')">';
     } else {
       echo '<img src="empty.jpg" height="60" width="60">';
     }
     echo '</td>'; 
     
     if ($row[5] == 'Y') {
       if ($row[6] == $tablet_id) {
         echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"myTable\" onclick=\"tables($val)\" /></td>";
       } else if ($row[6] != "N"){
         echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"otherTable\" onclick=\"tables($val)\" /></td>";
       } else {
         echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"occupiedTable\" onclick=\"tables($val)\" /></td>";
       }
     } else {
       echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"emptyTable\" onclick=\"tables($val)\" /></td>";                
    }
    


   }
    echo "";
    echo "</tr><tr>";
for ($j=1; $j<=4; $j++) {$val = ($i-1)*4+$j;

       $q="SELECT refill,checkout,tips,total,call_staff FROM table_status WHERE table_number=$val";
       $q2 = mysql_query($q);
       $row=mysql_fetch_row($q2);



       if ($j!=1) {
         echo "<th></th>";
       }

       echo '<td>';


       $q="SELECT cook,serve FROM order_ingredient WHERE table_number=$val";
       $q2 = mysql_query($q);
       $serve=FALSE;


       while($row2=mysql_fetch_row($q2)) {
         if ($row2[0] == 'Y' && $row2[1] == 'N') {
           $serve=TRUE;
         }
       }


       if ($serve) {
         echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve('.$val.')">';
       } else {
         echo '<img src="empty.jpg" height="50" width="50">';
       }
       echo '</td>';

       echo '<td>';
       if ($row[1] == 'Y') {
         echo '<img src="cash.jpg" height="50" width="50" onclick="cash('.$val.')">';
       } else {
         echo '<img src="empty.jpg" height="50" width="50">';
       }
       echo '</td>';


     echo "";

  }

   echo "</tr>";
 }


$nmax = $max%4;
 for ($j=1; $j<=$nmax; $j++) {$val = ((int)($max/4))*4+$j;

      $q="SELECT refill,checkout,tips,total,call_staff,occupied,assign_to,table_number FROM table_status WHERE table_number=$val";
     $q2 = mysql_query($q);
     $row=mysql_fetch_row($q2);

     $q="SELECT cook,serve FROM order_ingredient WHERE table_number=$val";
     $q2 = mysql_query($q);
     $row2=mysql_fetch_row($q2);


     echo '<td>';
     if ($row[4] == 'Y') {
       echo '<img src="question.jpg" height="50" width="30" onclick="question('.$val.')">';
     } else {
       echo '<img src="empty.jpg" height="50" width="30">';
     }
     echo '</td>';

     echo '<td>';
     if ($row[0] == 'Y') {
       echo '<img src="drink.jpg" height="60" width="60" onclick="refill('.$val.')">';
     } else {
       echo '<img src="empty.jpg" height="60" width="60">';
     }
     echo '</td>';

     if ($row[5] == 'Y') {
       if ($row[6] == $tablet_id) {
         echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"myTable\" onclick=\"tables($val)\" /></td>";
       } else if ($row[6] != "N"){
         echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"otherTable\" onclick=\"tables($val)\" /></td>";
       } else {
         echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"occupiedTable\" onclick=\"tables($val)\" /></td>";
       }
     } else {
       echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"emptyTable\" onclick=\"tables($val)\" /></td>";
    }



   }
    echo "";
    echo "</tr><tr>";
   for ($j=1; $j<=$nmax; $j++) {$val = ((int)($max/4))*4+$j;

       $q="SELECT refill,checkout,tips,total,call_staff FROM table_status WHERE table_number=$val";
       $q2 = mysql_query($q);
       $row=mysql_fetch_row($q2);



       if ($j!=1) {
         echo "<th></th>";
}

       echo '<td>';

       $q="SELECT cook,serve FROM order_ingredient WHERE table_number=$val";
       $q2 = mysql_query($q);
       $serve=FALSE;


       while($row2=mysql_fetch_row($q2)) {
         if ($row2[0] == 'Y' && $row2[1] == 'N') {
           $serve=TRUE;
         }
       }


       if ($serve) {
         echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve('.$val.')">';
       } else {
         echo '<img src="empty.jpg" height="50" width="50">';
       }
       echo '</td>';

       echo '<td>';
       if ($row[1] == 'Y') {
         echo '<img src="cash.jpg" height="50" width="50" onclick="cash('.$val.')">';
       } else {
         echo '<img src="empty.jpg" height="50" width="50">';
       }
       echo '</td>';


     echo "";
}

echo "</tr>";


?>



 </table>
 



</html>
