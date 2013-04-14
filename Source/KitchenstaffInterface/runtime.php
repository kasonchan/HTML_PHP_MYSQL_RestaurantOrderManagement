<?php

echo "time";
function runtime()
{
echo "<div id= \"hour\"></div>";

setTimeout(60);
$hour = 0;
$minute = 0;
$second = 0;
for($i = 0; $i < 59; $i++){
$second = 0;
if($second > 59)
{
$second = 0;
$minute++;
}

if($minute > 59)
{
$minute = 0;
$hour++;
}

if(hour > 23)
{
$hour = 0;
}

echo $minute . " min";
echo $second . " sec";
}

$(document).ready(function(){
setTimeout(function() { $("hour").load("runtime"); }, 10000); }; 


}
?>