<?php

include(dirname(__FILE__). "/../lib/renderpage.php");
include(dirname(__FILE__). "/../lib/checkcache.php");
include(dirname(__FILE__). "/../cfg/nmcgraph_cfg.php");
include(dirname(__FILE__). "/../lib/buildgraph.php");

//var_dump($_POST);exit;
if ( isset( $_POST ) && isset( $_POST["day"]) )
{ $date=$_POST["day"]; }
else if ( isset( $_GET ) && isset( $_GET["day"] ) )
{ $date=$_GET["day"]; }
else $date=date("Y-m-d");

$month=substr($date,5,2);
$day=substr($date,8.2);
$year=substr($date,0,4);
$date_daybefore = mktime(0, 0, 0, $month, $day-1, $year);
$date_nextday = mktime(0, 0, 0, $month, $day+1, $year);
$date_daybefore=date('Y-m-d', $date_daybefore);
$date_nextday=date('Y-m-d', $date_nextday);

//echo $month." ".$day." ".$year."<br />";

if ( !checkdate(substr($date,5,2),substr($date,8.2),substr($date,0,4))) { echo "wrong date : ".$date; exit;}

if ( isset( $_POST ) && isset( $_POST["xsize"] ) && is_numeric($_POST["xsize"]) && $_POST["xsize"] <=1024 )
{ $xsize = $_POST["xsize"];   }
else if ( isset( $_GET ) && isset( $_GET["xsize"]) && is_numeric($_GET["xsize"] && $_GET["xsize"] <=1024 ) )
{ $xsize = $_GET["xsize"];  }
else $xsize=800;
if ( isset( $_POST ) && isset( $_POST["ysize"] ) && is_numeric($_POST["ysize"]) && $_POST["ysize"] <=768 ) { $ysize = $_POST["ysize"]; }
else if ( isset( $_GET ) && isset( $_GET["ysize"] ) && is_numeric($_GET["ysize"] && $_GET["ysize"] <=768 ) )
{ $ysize = $_GET["ysize"]; }
else $ysize=600;

$minscale=null; $maxscale=null;
$type="daily"; $interval="1-hour";
$imagefilename="../cache/daily/daily_$date.png";
$imagepath="/cache/daily/daily_$date.png";
$altimage=$type." namecoin graph for date $date";
$permalink=$siteurl."/daily/nmc_daily.php?day=".$date;

$link_daybefore=$siteurl."/daily/nmc_daily.php?day=".$date_daybefore;
$link_nextday=$siteurl."/daily/nmc_daily.php?day=".$date_nextday;
$navigation="<a href=".$link_daybefore.">Day before</a> - <a href=".$link_nextday.">Next day</a>"; 
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
renderpage($title, $permalink, $altimage, $imagepath, $graphgendate, $message,$cached,$navigation );

?>
