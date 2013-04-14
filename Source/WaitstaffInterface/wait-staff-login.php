

<html>

   <head>

      <title>Wait-Staff Login </title>

   </head>

   <link rel="stylesheet" type="text/css" href="style.css" />
   
   <body>
     <?php    
      if ($_POST['loginSubmit'] == "Log In")
      { 
        $errorMessage = "";

        if (empty($_POST['user']))
         {
           $errorMessage .= "<li>No UserID entered</li>";
         }

        if (empty($_POST['pass']))
         {
           $errorMessage .= "<li>No Password entered</li>";
         }

        if (empty($errorMessage))
         {
            echo "<script>window.location = 'table-menu.php' </script>"; 
         }
      }
     ?> 
    
       // Connect to database

<?      $con = mysql_connect("Studentdb.cse.unt.edu","kc0284","WHO55amikason");

      if (!$con)
      {
         die('Could not connect: ' . mysql_error());
         echo 'Could not connect!\n';
      }
      mysql_select_db("kc0284", $con);

      $query = "SELECT distinct waitstaff_id FROM waitstaff WHERE waitstaff_id = $_POST["user"]";
			$r = mysql_query($query);
			if(!$r)
				echo "Error";
			else
			{
				while($row=mysql_fetch_row($r))
				{
      					foreach ($row as $value)
						echo "<input type=\"checkbox\" name=\"Veggie[]\" value=\"$value\" />" . $value . " ";
				}	
			}      
?>
      <h1> Log In </h1> 
      <?php
        if (!empty($errorMessage))
        {
           echo ("<ul>" . $errorMessage . "</ul><br>");
        }
      ?>

      <form method="post">
      UserID: <input type="text" name="user" class="textbox" value="<?=$_POST["user"]; ?>" /> <br /><br /><br />

      Password: <input type="password" name="pass" class="textbox" value="<?=$_POST["pass"]; ?>" /> <br /> </h1> <br />
 
      <label></label><input type="submit" name="loginSubmit" value="Log In" class="button1" /> <br />
      </form>

      <img src="k-wich.JPG" height="80" width="200" align="bottom" />
  
      
   </body>

</html>
