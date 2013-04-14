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

<?php 
	$count = 0;

	$url="http://rss.cnn.com/rss/cnn_showbiz.rss";    //go to url                                                                                
	$rss = file_get_contents($url);                                            //read the contents of a file into a string

	function PIPHP_RSSToHTML($rss)
	{      //function to create an XML object in $xml

		$xml  = simplexml_load_string($rss);  //XML object created from $rss

		// $out="";                               // converted HTML

		foreach($xml->channel->item as $item)
		{   
			if($count <= 5)
			{
				//get the title from every item
				$ttitle = @$item->title;                                    //suppress error message
				$out.="$ttitle<BR>";                                    //add to $out
				$count = $count + 1;
			}
		}
		
		return "$out";
	}
	
		$result = PIPHP_RSSToHTML($rss);                 //print title
		echo "$result";

?>
<input type="button"  class=Button value="Back" onClick="history.go(-1)" class="MouseOutButton">
</body>
</html>