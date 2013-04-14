<html>
   <head>
      <title>Tables Menu</title>
   </head>


<?php
echo "<script type=\"text/javascript\">";
        echo "var url ='table-menu.php?refreshed=1';";
        echo "var delay = 20;";
        echo "var d = delay * 1000;";
        echo "window.setTimeout ('parent.location.replace(url)', d);";
        echo "</script>";


$var = $_GET['var'];
$refreshed = $_GET['refreshed'];


if ($refreshed != 1 ) {
  if ($var > 0 ) {
    echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http://students.cse.unt.edu/~kmh0237/Wait-Staff/table-menu.php?var=".$var."&refreshed=1\">";  
  }
}
?>



<frameset cols="90%,10%" border="5">
  <frame scrolling="yes" resize src="table-left2.php">
<?php  if ($var > 0) {
    echo "<frame scrolling=\"no\" resize src=\"table-right.php?var=".$var."\">";
  } else {
    echo '<frame scrolling="no" resize src="table-right.php">';
  }
?>
</frameset>

   

</html>
