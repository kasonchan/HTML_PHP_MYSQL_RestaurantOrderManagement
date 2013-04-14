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
	// Process the submitted form
  // Do some simple field checking first...

  // Check something is entered in the first name field
  if (trim($FirstName=$_POST['inputFirstName']) == '') 
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid first name.</div>\n";
  }

  // Check something is entered in the last name field
  if (trim($LastName=$_POST['inputLastName']) == '') 
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid last name.</div>\n";
  }

  // Check something is entered in the password field
  if (trim($Password=$_POST['inputPassword']) == '') 
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid password.</div>\n";
  }

  // Check the date is numeric and in proper numeric range
  $Date = $_POST['inputDate']; // simplification
  if (!(is_numeric($Date) AND ($Date >= 1 AND $Date <= 31)))
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid day.</div>\n";
  }

  // Check the month is numeric and in proper numeric range
  $Month = $_POST['inputMonth']; // simplification
  if (!(is_numeric($Month) AND ($Month >= 1) AND ($Month <= 12))) 
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid month.</div>\n";
  }

  // Check the year is numeric and in proper numeric range
  $Year = $_POST['inputYear']; // simplification
  if (!(is_numeric($Year) AND ($Year <= 1994))) 
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid year.</div>\n";
  }

  // Check something is entered in the Email field
  if (trim($Email=$_POST['inputEmail']) == '') 
  {
    $error = true;
    echo "<div style=\"color:red;\">Invalid email.</div>\n";
  }

  // ****************************************
  // Connect database
  // ****************************************
  $con = ConnectDatabase();

  $getCustomerEmail = "SELECT distinct email FROM customer WHERE email='$Email'";
  $getCustomerEmailResult = mysql_query($getCustomerEmail); 

  while($row=(mysql_fetch_row($getCustomerEmailResult)))
  {
    foreach ($row as $value)
    {
      if($value == $Email)
      {
        $error = true;
        echo "<div style=\"color:red;\">Email is existed.</div>\n";  
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
  <table frame="border">
    <tr><td>  
      First name: <input type="text" name="inputFirstName" size="30" maxlength="30" value="$FirstName" /><br />
      Last name: <input type="text" name="inputLastName" size="30" maxlength="30" value="$LastName" /><br />
      *Password: <input type="password" name="inputPassword" size="20" maxlength="20" value="$Password" /><br />
      *Date of birth (MM/DD/YYYY): <input type="text" name="inputMonth" size="2" maxlength="2" value="$Month" />/<input type="text" name="inputDate" size="2" maxlength="2" value="$Date" />/<input type="text" name="inputYear" size="4" maxlength="4" value="$Year" /><br />
      *Email: <input type="text" name="inputEmail" size="30" maxlength="30" value="$Email" /><br />
      <!----------------------------------------------------------------------
         Use to test if the input
      ---------------------------------------------------------------------->
      <i>*Required field</i>
    </td></tr>
  </table>
  <p><input type="button" value="Back" class=Button  onClick="history.go(-1)" ><input type="submit" name="Submit" class=Button  value="Check and Validate Infos" /></p>
</form>
EOT;
// ****************************************************************************
// End of form input
// ****************************************************************************
?>
</form>


<form method="post" action="CustomerSignUpConfirmation.php">
<?php
  if($showLogIn == false)
    echo "<input type=\"submit\" name=\"Submit\" value=\"Sign Up\"  style=\"display:none;\" />";
  else if($showLogIn == true)
    echo "<input type=\"submit\" name=\"Submit\" value=\"Sign Up\" class=\"Button\" />";
?>
      <input type="text" name="inputFirstName" size="30" value="<?=$FirstName; ?>"  style="display:none" />
      <input type="text" name="inputLastName" value="<?=$LastName; ?>" style="display:none" />
      <input type="text" name="inputPassword" value="<?=$Password; ?>" style="display:none" />
      <input type="text" name="inputDate" size="2" value="<?=$Date; ?>" style="display:none"  />
      <input type="text" name="inputMonth" value="<?=$Month; ?>"  style="display:none" />
      <input type="text" name="inputYear" value="<?=$Year; ?>"  style="display:none" />
      <input type="text" name="inputEmail" value="<?=$Email; ?>"  style="display:none" />
</form>



</body>
</html>