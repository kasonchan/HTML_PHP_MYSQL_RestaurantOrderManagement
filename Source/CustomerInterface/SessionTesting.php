<html>
<head>
<script type="text/javascript">

function setSrc(obj, url) {
	obj.src = url;
}

function getSrc() {
	var obj = document.getElementById('myframe');
	document.getElementById("frameid").value = obj.src;
	return false; // if we return false, then we don't go to the URL defined in the 

}

</script>
</head>

<body>
<?php
	// Print year
	echo date(Y). "<BR>";
	// Print month
	echo date(n). "<BR>";
	// Print day
	echo date(d). "<BR>";

	// Print hour
	echo date(G) . "<BR>";
	// Print minute
	echo date(i) . "<BR>";
?>



<!-- <iframe id="myframe" src="http://www.yahoo.com"></iframe>

<br>
<br>

<input onload="return getSrc();" id="frameid" value="" name="frameid" />
 -->
<!-- 
<?php
	// echo $_SERVER['REMOTE_ADDR'] . "<BR>";
	// echo $_SERVER['HTTP_USER_AGENT'];
	$a = session_id();
	if(empty($a)) session_start();
	echo "SID: ".SID."<br>session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];
// session_id(): al1bihbi97ms358o2ge2sbs2i0;

?>
 -->

</body>
</html>

<!--
// Test for update amount
// $wheatAmount = 5;
// $query = "UPDATE ingredient SET amount = $wheatAmount WHERE ingredient_name = 'Wheat'";
// $r = mysql_query($query);
-->