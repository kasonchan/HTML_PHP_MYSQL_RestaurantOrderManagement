<html>
 <script>
 
 function question()
 {
   alert("Table " + table.value + "\nCustomer calling for waiter ");
 }

 function serve()
 {
   alert("Table " + table.value + "\nPlease serve the food ");
 }


 function refill()
 {
   alert("Table " + table.value + "\nDrink = \nNumber of Refills =  ");
 }
 
 function cash()
 {
   alert("Table " + table.value + "\nPlease take customer cash ");
 }

 function tables()
 {
   alert("Table " + table.value);

 }

 </script>

 <body>
 <link rel="stylesheet" type="text/css" href="style.css" />

 <p align="center"> 
 
 <?php 
echo "<table>";
 for ($i=1; $i<=6; $i++) 
  { ?>

   <tr>
     <th><?php echo '<img src="question.jpg" height="50" width="30" onclick="question()">'; ?></th>
     <th><?php echo '<img src="drink.jpg" height="60" width="60" onclick="refill()">'; ?></th>  
     <th><?php echo "<input type=\"button\" id=\"table\" value=$i class=\"tablenumber\" onclick=\"tables()\" />"; ?></th>                  
    <?php
    $s = $i + 6;
    ?>
     <th><?php echo '<img src="question.jpg" height="50" width="30" onclick="question()">'; ?></th>
     <th><?php echo '<img src="drink.jpg" height="60" width="60" onclick="refill()">'; ?></th>
     <th><?php echo "<input type=\"button\" id=\"table\" value=$s class=\"tablenumber\" onclick=\"tables()\" />"; ?></th>
         
    <?php
    $r = $i + 12;
    ?>
     <th><?php echo '<img src="question.jpg" height="50" width="30" onclick="question()">'; ?></th>
     <th><?php echo '<img src="drink.jpg" height="60" width="60" onclick="refill()">'; ?></th>
     <th><?php echo "<input type=\"button\" id=\"table\" value=$r class=\"tablenumber\" onclick=\"tables()\" />"; ?></th>

    <?php   
    $w = $i + 18;
    ?>
     <th><?php echo '<img src="question.jpg" height="50" width="30" onclick="question()">'; ?></th>
     <th><?php echo '<img src="drink.jpg" height="60" width="60" onclick="refill()">'; ?></th>
     <th><?php echo "<input type=\"button\" id=\"table\" value=$w class=\"tablenumber\" onclick=\"tables()\" />"; ?></th>
   </tr>
     
   <?php echo "<br>"; ?> 

    <tr>
       <th><?php echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve()">'; ?></th>
       <th><?php echo '<img src="cash.jpg" height="50" width="50" onclick="cash()">'; ?></th>
       
       <th> </th>
       <th><?php echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve()">'; ?></th>
       <th><?php echo '<img src="cash.jpg" height="50" width="50" onclick="cash()">'; ?></th>
             
       <th> </th>
       <th><?php echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve()">'; ?></th>
       <th><?php echo '<img src="cash.jpg" height="50" width="50" onclick="cash()">'; ?></th>
   
       <th> </th>
       <th><?php echo '<img src="sandwich.jpg" height="50" width="50" onclick="serve()">'; ?></th>
       <th><?php echo '<img src="cash.jpg" height="50" width="50" onclick="cash()">'; ?></th>
      
    </tr>
    
    <?php echo "<br>"; 

   } ?>
 </table>
 
 </p>

 </body>

</html>
