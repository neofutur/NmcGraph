<?php

function renderpage($title, $permalink, $altimage, $imagepath, $graphdate, $message="" )
{
$dategen = date ( "Y-m-d G:i:s T Y", $graphdate );

echo "<html><head><title>$title</title></head><body>";
echo "<a href=\"".$permalink."\"> permalink </a> - graph generated on : <b>$dategen</b> <br /><br />";
if ( isset ( $message ) ) echo $message."<br /><br />";
echo"<img alt=\"".$altimage."\" src=".$imagepath."/>";
include( "../footer.php");
echo "</body></html>";
}

?>
