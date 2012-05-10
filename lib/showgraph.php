<?php


function showgraph( $date, $xsize ="640", $ysize="480Â", $type, $interval )
{
include("cfg/nmcgraph_cfg.php");
$minscale=null; $maxscale=null;
$imagefilename="../cache/daily/daily_$date.png";
$imagepath="/cache/daily/daily_$date.png";
$altimage=$type." namecoin graph for date $date";
$permalink=$siteurl."/daily/nmc_daily.php?day=".$date;
$title=$type." namecoin historic data graph for date $date";
$graphgendate = "";
$cached=null;
$message="daily graph is cached one hour";
if ($graphgendate = checkcache( $imagefilename) )
{
 $cached=true;
}
else
{
 $cached=false;
/* Create and populate the pData object */
$MyData = new pData();
load_nmc_data($MyData, $date, $type, $minscale, $maxscale);
//var_dump($MyData);

//printf("minscale: $minscale maxscale: $maxscale <br />\n");

$graphgendate = buildgraph( $MyData, $xsize, $ysize, $title,$minscale, $maxscale, $date, $type, $imagefilename  );

}
 $html_code="<img alt=\"".$altimage."\" src=".$imagepath." />";

 return $html_code;
}

?>
