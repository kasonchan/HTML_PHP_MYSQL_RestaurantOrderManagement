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
<div><h2>Sign Up Confirmation</h2></div>
<div>
<?php
  require_once("DatabaseFunctions.php");

  // ****************************************
  // Connect database
  // ****************************************
  $con = ConnectDatabase();

  $firstName = $_POST['inputFirstName'];
  $lastName = $_POST['inputLastName'];
  $password = $_POST['inputPassword'];
  $email = $_POST['inputEmail'];
  $year = $_POST['inputYear'];
  $month = $_POST['inputMonth'];
  $day = $_POST['inputDate'];

  $insertCustomer = "INSERT INTO customer VALUES('$firstName', '$lastName', '$password', '$email', '$year', '$month', '$day', '0', 'N')";
  $insertCustomerResult = mysql_query($insertCustomer);  

  if(!$insertCustomerResult)
  {
    echo "<div style=\"color:red;\">Unable to sign up.</div>" . "<BR>";
    echo "<input type=\"button\" value=\"Back\" onClick=\"history.go(-1)\" />";
  }
  else
  {
    echo "Thank you for signing up to K-Wich Club, " . $firstName . " " . $lastName . ".<BR>";
    echo "A confirmation has been sent to your email." . '</br>';

    $to = $email;
    $subject = "K-Wich Club Sign Up Confirmation";
    $message = "Hi, " . $firstName . " " . $lastName . ",\n\n" . "Thank you for signing up to K-Wich Club.\n\n" . "Best Wiches,\n" . "K-Wich Club\n";
    mail($to,$subject,$message);
  }


   echo "<script type=\"text/javascript\">";
  echo "var url ='CustomerHomepage.php';";
  echo "var delay = 4;";
  echo "var d = delay * 1000;";
  echo "window.setTimeout ('parent.location.replace(url)', d);";
  echo "</script>";
?>

       

</div>

</body>
</html>