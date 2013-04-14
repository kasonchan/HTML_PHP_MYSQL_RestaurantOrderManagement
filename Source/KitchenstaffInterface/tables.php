require_once("DatabaseFunctions.php");
$max = getMaxTable();
$num = ($max/6);
 for ($i=1; $i<=$num; $i++) {
   echo "<tr>";
   
  for ($j=1; $j<=4; $j++) {$val = ($i-1)*6+$j;
   
     $q="SELECT refill,checkout,tips,total,call_staff FROM table_status WHERE table_number=$val";
     $q2 = mysql_query($q);
     $row=mysql_fetch_row($q2);

     echo "<td><input type=\"button\" id=\"table\" value=\"$val\" class=\"tablenumber\" onclick=\"tables($val)\" /></td>";                
    
    


   }
}
