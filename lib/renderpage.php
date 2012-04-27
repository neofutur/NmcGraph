<?php

function renderpage($title, $permalink, $altimage, $imagepath, $graphdate, $message="" )
{
$dategen = date ( "Y-m-d G:i:s T Y", $graphdate );

echo "<html><head><title>$title</title>\n";
echo "<link rel=\"stylesheet\" href=\"../demos.css\" />\n";
echo "</head><body>\n";

include("../header.php");

echo "<a href=\"".$permalink."\"> permalink </a> - graph generated on : <b>$dategen</b> - ";
if ( isset ( $message ) ) echo $message."<br /><br />";
echo"<img alt=\"".$altimage."\" src=".$imagepath."/>";
include( "../footer.php");
echo "</body></html>";
}

?>
