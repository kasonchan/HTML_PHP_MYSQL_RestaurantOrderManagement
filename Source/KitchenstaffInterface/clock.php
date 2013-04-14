<?php

function displaytime(){
$some = 12;
?>
<div id="hour"></div>
<script type="text/javascript">

var some = "<?php echo $some; ?>";
var current = new Date(<?php echo date('y,n,j,G,i,s'); ?>);

var curhour = current.getHours();       // hour
var curminute = current.getMinutes();     // minutes
var cursecond = current.getSeconds();     // seconds
var hour = 0;
var minute = 0;
var second = 0;


hour = hour;
minute = minute;
// function that process and display data
function currenttime() {
  second++;
  if (second>59) {
    second = 0;
    minute++;
  }
  if (minute>59) {
    minute = 0;
    hour++;
  }
  if (hour>23) {
    hour = 0;
  }

  var output = "<font size='4'><b><font size='1'>Current Time</font><br />"+hour+":"+minute+":"+second+"</b></font>"

  document.getElementById("hour").innerHTML = output;
}

// call the function when page is loaded and then at every second
window.onload = function(){
  setInterval("currenttime()", 1000);
}
</script>

<?php
}
?>