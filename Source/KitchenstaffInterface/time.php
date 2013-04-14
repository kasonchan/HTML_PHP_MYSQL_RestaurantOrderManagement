<?php

function displaytime(){
$some = 12;
?>
<div id="hour"></div>
<script type="text/javascript">

var some = "<?php echo $some; ?>";
var hour = 0;
hour = ("0" + hour).slice(-2)

var minute = 0;
minute = ("0" + minute).slice(-2)

var second = 0;
second = ("0" + second).slice(-2)

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

  var output = "<b><font size='4'>Wait Time</font><br />"+hour+":"+minute+":"+second+"</b></font>"

  document.getElementById("hour").innerHTML = output;
}

// call the function when page is loaded and then at every second
window.onload = function()
{
  setInterval("currenttime()", 1000);
}
</script>

<?php
}
?>