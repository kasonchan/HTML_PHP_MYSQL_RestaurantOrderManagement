<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="sandwich.jpg">
<title>K-Wich</title>
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
		});
	</script>
	

</head>

<body>
<?php
	require_once("DatabaseFunctions.php");
	$con = ConnectDatabase();
?>
	<div class=PageContainer>
		<div class=TitleContainer>
			<div class=Bold>Welcome to</div>
			<?php
				if(is_null(getTableNumber(getTabletID())))
				{
					echo "<div class=Bold>" . "Online" . "</div>";
				}
			?>
			<div><img src="http://students.cse.unt.edu/~kc0284/CustomerInterface/KWich.JPG"></div>
		</div>
		<div class=ContentContainer>
			<table align=center>
				<tr>
					<td>
						<form action="http://students.csci.unt.edu/~kc0284/CustomerInterface/Menu.php">
							<input class=Button type="submit" value="Order with System" />
						</form>
					</td>
					<td>
						<?php
						if(!is_null(getTableNumber(getTabletID())))
						{
							echo "<form action=\"http://students.csci.unt.edu/~kc0284/CustomerInterface/OrderWithStaff.php\">";
								echo "<input class=Button type=\"submit\" value=\"Order with Staff\" />";
							echo "</form>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="http://students.csci.unt.edu/~kc0284/CustomerInterface/CustomerChangeLanguage.php">
							<input class=Button type="submit" value="Change Language" />
						</form>
					</td>
					<td>
						<form action="http://students.csci.unt.edu/~kc0284/CustomerInterface/KWichClub.php">
							<input class=Button type="submit" value="K-Wich Club" />
						</form>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php
		require_once("DatabaseFunctions.php");

		$con = ConnectDatabase();

		$tablet_id = getTabletID();

		// Testing if if getting the correct tablet_id and table_number
		// echo $tablet_id . "<BR>";
		// echo getTableNumber($tablet_id) . "<BR>";
	?>
</body>
</html>

