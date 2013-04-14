<html>
<title>Edit Menu</title>
<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
<h>Edit Menu</h>
<br>
</head>
<body>
<form method = "post" action = "editmenu.php">
<div id="right-sidebar" class = "verticalline"> 
<br><br><br>
<div style="padding-left: 39px"><input type = "Submit" value="Edit Menu" class = "button3"></div></br></br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<wrap><h2>Kitchen Staff Interface</h2></wrap>
</div>
</form>
<?php
if ($_POST['val'] > 0) {
  $val = $_POST['val']; 
} else {
  $val=0;
}
function bread() {
  $val = 1;
}
function meat() {
  $val = 2;
}
function veggie() {
  $val = 3;
}
function dressing() {
  $val = 4;
}
function drink() {
  $val = 5;
}
function dessert() {
  $val = 6;
}


?>


<!-- <div>
<form method = "post" action = "">
<indent></indent><indent></indent>
<indent></indent><input type="button" value="Bread" onclick = "return ChangePage1()" class = "button2" />
<indent></indent><input type="button" value="Meat" onclick = "return meatpage()" class = "button2"/>
<indent></indent><input type="button" value="Veggie" onclick = "return ChangePage3()" class = "button2"/>
<indent></indent><input type="button" value="Dressing" onclick = "return ChangePage4()" class = "button2"/>
<indent></indent><input type="button" value="Drink" onclick = "return ChangePage5()" class = "button2"/>
<indent></indent><input type="button" value="Dessert" onclick = "return ChangePage6()" class = "button2"/>
</form>
</div> -->

<div>
<?php
  if ($val == 0) {
    echo '<iframe src = "bread.php" scrolling= "auto" class = "frame" id = "breadid"></iframe>';
  } else if ($val == 1) {
    echo '<iframe src = "bread.php" scrolling= "auto" class = "frame"></iframe>';    
  } else if ($val == 2) {
    echo '<iframe src = "meat.php" scrolling= "auto" class = "frame" id = "meatid"></iframe>';
  } else if ($val == 3) {
    echo '<iframe src = "veggie.php" scrolling= "auto" class = "frame" id = "veggieid"></iframe>';
  } else if ($val == 4) {
    echo '<iframe src = "dressing.php" scrolling= "auto" class = "frame" id = "dressingid"></iframe>';
  } else if ($val == 5) {
    echo '<iframe src = "drink.php" scrolling= "auto" class = "frame" id = "drinkid"></iframe>';
  } else {
    echo '<iframe src = "desert.php" scrolling= "auto" class = "frame" id = "dessertid"></iframe>';
  }
?>
</div>
</br>


<script language="javascript" type="text/javascript">
var id1 = "breadid"
var newPage1 = "bread.php";

function ChangePage1() 
{
var iFrameObject1 = document.getElementById(id1);
iFrameObject1.src = newPage1;
}

var id2 = "meatid"
var newPage2 = "meat.php";

function meatpage() 
{
var iFrameObject2 = document.getElementById("id2");
iFrameObject2.src = "http://www.google.com/";
}

var id3 = "veggieid"
var newPage3 = "veggie.php";

function ChangePage3() 
{
var iFrameObject = document.getElementById(id3);
iFrameObject.src = newPage3;
}

var id4 = "dressingid"
var newPage4 = "dressing.php";

function ChangePage4() 
{
var iFrameObject = document.getElementById(id4);
iFrameObject.src = newPage4;
}

var id5 = "drinkid"
var newPage5 = "drink.php";

function ChangePage5() 
{
var iFrameObject = document.getElementById(id5);
iFrameObject.src = newPage5;
}

var id6 = "dessertid"
var newPage6 = "dessert.php";

function ChangePage6() 
{
var iFrameObject = document.getElementById(id6);
iFrameObject.src = newPage6;
}
</script>

</body>
</html>
