<?php

function renderpage($title, $permalink, $altimage, $imagepath, $graphdate, $message="", $cached=false )
{
$dategen = date ( "Y-m-d G:i:s T Y", $graphdate );

echo "<html><head><title>$title</title>\n";
echo "<link rel=\"stylesheet\" href=\"../demos.css\" />\n";
echo "</head><body>\n";

include(dirname(__FILE__). "/../header.php");
if ( $cached == true )
 $cache_message="cached graph";
else
 $cache_message="new graph generated now";
echo "<a href=\"".$permalink."\"> permalink </a> - graph generated on : <b>$dategen</b> - ";
if ( isset ( $message ) ) echo $message." -  $cache_message "."<br /><br /><br />";
echo"<img alt=\"".$altimage."\" src=".$imagepath."/>";
include(dirname(__FILE__). "/../footer.php");
echo "</body></html>";
}

?>
