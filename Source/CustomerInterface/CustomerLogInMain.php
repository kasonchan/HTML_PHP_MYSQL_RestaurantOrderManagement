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
</head>

<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
$error = false;
$showLogIn = false;
require_once("DatabaseFunctions.php");

// ****************************************************************************
// Form Validation
// ****************************************************************************
// Sample Form's Processing Script
if (count($_POST) > 0) 
{ 
	// ****************************************
	// Connect database
	// ****************************************
	$con = ConnectDatabase();

	// Process the submitted form
  	// Do some simple field checking first...

	$inputEmailResult = $_POST['inputEmail'];
	$inputPasswordResult = $_POST['inputPassword'];

	// echo $inputEmailResult . "<BR>";
	// echo $inputPasswordResult . "<BR>";
	
	$getCustomerName = "SELECT distinct customer_lastname FROM customer WHERE email='$inputEmailResult' AND password='$inputPasswordResult'";
	$getCustomerNameResult = mysql_query($getCustomerName);

  	if( (trim($Email=$_POST['inputEmail']) == '') OR (trim($Password=$_POST['inputPassword']) == '') )
  	{
    	echo "<div style=\"color:red;\">Invalid email and/or password. </div>\n";
    	$error = true;
	}
	else
	{	
		if(!$getCustomerNameResult)
		{
			echo "<div style=\"color:red;\">Invalid email and/or password. </div>\n";
			$error = true;
		}
		else if($getCustomerNameResult)
		{
			if (!mysql_fetch_row($getCustomerNameResult))
			{
				$error = true;
				echo "<div style=\"color:red;\">Invalid email and/or password. </div>\n";
			}
		}
  	}

	if(!$error)
	{
		$showLogIn = true;
	}
}

// ****************************************************************************
// End of form validation
// ****************************************************************************
// If there was an error, or the form wasn't submitted,
// ****************************************************************************
// Form input
// ****************************************************************************
if ($error OR count($_POST) == 0)
  echo <<< EOT
  <table>
    <tr><td>  
 	*Email: <input type="text" name="inputEmail" size="30" maxlength="30" value="$Email" /><br />
	*Password: <input type="password" name="inputPassword" size="20" maxlength="20" value="$Password" /><br />
    <i>*Required field</i>
    </td></tr>
  </table>
  <p><input type="submit" name="Submit" class=Button value="Check and Validate Infos" /></p>
</form>
EOT;
// ****************************************************************************
// End of form input
// ****************************************************************************
?>
</form>


<form method="post" action="CustomerLogInConfirmation.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Log in\"  style=\"display:none;\" />";
	else if($showLogIn == true)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Log In\" class=\"Button\" />";
?>
      <input type="text" name="inputPassword" value="<?=$Password; ?>" style=display:none; /> 
      <input type="text" name="inputEmail" value="<?=$Email; ?>" style=display:none; />
</form>

<input type="button" value="Back" class="Button" onClick="history.go(-1)">

<!-- <form method="post" action="http://students.cse.unt.edu/~kc0284/CustomerInterface/CustomerSignUpMain.php">
      <input type="submit" name="SignUp" value="Sign Up" />
</form> -->
</body>
</html>