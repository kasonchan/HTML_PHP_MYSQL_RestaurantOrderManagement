<html>

<!-- select count(assign_to) FROM table_status WHERE assign_to='70.104.20.182'; -->


 <script>
 
 function question($v)
 {
   x=$v*5+1
    parent.location.replace("http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php?var=" + x);
   alert("Table " + $v + "\nCustomer calling for waiter ");
 }

 function serve($v)
 {
   x=$v*5+2
    parent.location.replace("http://students.cse.unt.edu/~kmh0237/Wait-Staff/tell2.php?var=" + x);


 }


 function refill($v)
 {
   x=$v*5+3
    parent.location.replace("http://students.cse.unt.edu/~kmh0237/Wait-Staff/tell.php?var=" + x);
 }
 
 function cash($v)
 {
   x=$v*5+4
    parent.location.replace("http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php?var=" + x);
   alert("Table " + $v + "\nPlease take customer cash ");
 }

 function tables($v)
 {
   parent.location.replace("http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php?var=" + $v*5);
   alert("Table " + $v);

 }

 </script>


 <link rel="stylesheet" type="text/css" href="style.css" />


 
 <?php
 
echo '<table align="center" >';
require_once("DatabaseFunctions.php");

$var = $_GET['var'];

$tabnum = (int)($var/5);


$con = ConnectDatabase();

$max = getMaxTable();

$tablet_id = getTabletID();


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

echo "<tr>";
$nmax = $max%4;
 for ($j=1; $j<=$nmax; $j++) {$val = ((int)($max/4))*4+$j;

     
     $q="SELECT table_number,checkout,tips,total,call_staff,occupied,assign_to,refill FROM table_status WHERE table_number=$val";
     $q2 = mysql_query($q);
     $row=mysql_fetch_row($q2);

     $q="SELECT cook,serve FROM order_ingredient WHERE table_number=$val";
     $q3 = mysql_query($q);

     $ref = false;
     while ($row2=mysql_fetch_row($q3)) {
       if ($row2[0] == 'Y' && $row2[1] == 'N') {
         $ref = true;
       }
     }

     echo '<td>';
     if ($row[4] == 'Y') {
       echo '<img src="question.jpg" height="50" width="30" onclick="question('.$val.')">';
     } else {
       echo '<img src="empty.jpg" height="50" width="30">';
     }
     echo '</td>';

     echo '<td>';
     if ($row[7] == 'Y') {
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


$val=0;
 $q="SELECT table_number,checkout,tips,total,call_staff,occupied,assign_to,refill FROM table_status WHERE table_number=$val";
     $q2 = mysql_query($q);
     $row=mysql_fetch_row($q2);

     $q="SELECT cook,serve FROM order_ingredient WHERE table_number=$val";
     $q3 = mysql_query($q);

     $ref = false;
     while ($row2=mysql_fetch_row($q3)) {
       if ($row2[0] == 'Y' && $row2[1] == 'N') {
         $ref = true;
       }
     }







echo "<tr>";

     echo '<td>';
     if ($row[4] == 'Y') {
     echo '<img src="empty.jpg" height="50" width="30">';

    } else {
       echo '<img src="empty.jpg" height="50" width="30">';
     }
     echo '</td>';

     echo '<td>';
     if ($row[7] == 'Y') {
     echo '<img src="empty.jpg" height="60" width="60">';
    } else {
       echo '<img src="empty.jpg" height="60" width="60">';
     }
     echo '</td>';



      echo "<td><font size=1 ><input type=\"button\" id=\"table\" value=\"Web Orders\" class=\"emptyTable2\" onclick=\"tables($val)\" /></td></font>";

echo "</tr><tr>";


$q="SELECT cook,serve FROM order_ingredient WHERE table_number=$val";
       $q2 = mysql_query($q);
       $serve=FALSE;


       while($row2=mysql_fetch_row($q2)) {
         if ($row2[0] == 'Y' && $row2[1] == 'N') {
           $serve=TRUE;
         }
       }

       echo '<td>';
       if ($serve) {
         echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve('.$val.')">';
       } else {
         echo '<img src="empty.jpg" height="50" width="50">';
       }
       echo '</td>';

       echo '<td>';
       if ($row[1] == 'Y') {
        echo '<img src="empty.jpg" height="50" width="50">';
} else {
         echo '<img src="empty.jpg" height="50" width="50">';
       }
       echo '</td>';

echo "<tr/>";
?>



 </table>
 



</html>
