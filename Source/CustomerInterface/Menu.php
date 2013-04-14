<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="sandwich.jpg">
<title>K-Wich Menu</title>
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<link rel = "stylesheet" type = "text/css" href = "style.css"/>
	<script src="jquery.js"></script>
	<script>
		$(document).ready(function(){
			$(".PageContainer").addClass("PageContainer");
			$(".TitleContainer").addClass("TitleContainer");
			$(".ContentContainer").addClass("ContentContainer");
			$(".FunctionsNavigation").addClass("FunctionsNavigation");
		});
	</script>

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
?>
	<div class=PageContainer>
		<div class=TitleContainer>
			<?php 
				if(is_null(getTableNumber(getTabletID()))) 
					echo "<h1 class=Bold>" . "Online " . "</h1>"; 
			?>
			<h1 class=Bold>Menu<h1>
		</div>
		<div class=FunctionsNavigation>
			<?php
				if(!is_null(getTableNumber(getTabletID())))
				{
					echo "<form action=\"CallStaff.php\">";
						echo "<input class=Button type=\"submit\" value=\"Call Staff\" />";
					echo "</form>";
				}
			?>
		</div>
		<!-- <div>
			<input type="button" value="Bread" />
			<input type="button" value="Meat" />
			<input type="button" value="Veggie" />
			<input type="button" value="Dressing" />
			<input type="button" value="Drink" />
			<input type="button" value="Dessert" />
			<input type="button" value="Confirm" />
		</div> -->
		<div class=ContentContainer>
			<iframe class=frame src="http://students.cse.unt.edu/~kc0284/CustomerInterface/MenuBread.php" scrolling="auto" height="200px"> </iframe>
			<iframe class=frame src="http://students.cse.unt.edu/~kc0284/CustomerInterface/IngredientInfos.php" scrolling="auto"> </iframe>
		</div>
	</div>        
</body>
</html>

