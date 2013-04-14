<html>
   <head>
      <title>Tables Menu</title>
   </head>

<?php
echo "<script type=\"text/javascript\">";
        echo "var url ='confirm.php?refreshed=1';";
        echo "var delay = 20;";
        echo "var d = delay * 1000;";
        echo "window.setTimeout ('parent.location.replace(url)', d);";
        echo "</script>";
?>


<frameset cols="90%,10%" border="5">
  <frame scrolling="yes" resize src="table-left3.php">
  <frame scrolling="no" resize src="table-right3.php">

</frameset>



</html>

