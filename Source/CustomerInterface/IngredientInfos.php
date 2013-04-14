<!DOCTYPE html>
<html>

<head>
	
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<link rel = "stylesheet" type = "text/css" href = "style.css"/>

<script>
function showHint(str)
{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","gethint.php?q="+str,true);
xmlhttp.send();
}
</script>

</head>

<body>

<?php
	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$showDesc = false;
	function GetDesc($ingredient_name)
	{
		$getIngredientDesc = "SELECT distinct ingredient_name, ingredient_desc, ingredient_calories FROM ingredient WHERE ingredient_name = '$ingredient_name'";
		$getIngredientDescResult = mysql_query($getIngredientDesc);

		while($row=mysql_fetch_row($getIngredientDescResult))
		{
      		// foreach ($row as $value)
			echo "Ingredient: " . $row[0] . "<BR>";
			echo "Description: " . $row[1] . "<BR>";
			echo "Calories: " . $row[2] . "<BR>";
		}
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
				<p><input type="text" name="name" onkeyup="showHint(this.value)" /></p>
				<p>Suggestions: <span id="txtHint"></span></p>
				<p><input type="submit" class=Button value="Ingredient Description" /></p>

<?php
		echo GetDesc($_POST['name']);

		// $url = 'http://students.csci.unt.edu/~kc0284/CustomerInterface/IngredientInfos.php';
		// echo '<META HTTP-EQUIV=Refresh CONTENT="10; URL='.$url.'">'; 
		?>
</form>

</body>

</html>

