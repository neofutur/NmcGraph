<?php

function renderpage($title, $permalink, $altimage, $imagepath )
{
echo "<html><head><title>$title</title></head><body>";
echo "<a href=\"".$permalink."\"> permalink </a><br /><br />";
echo"<img alt=\"".$altimage."\" src=".$imagepath."/>";
echo "</body></html>";
}

?>
