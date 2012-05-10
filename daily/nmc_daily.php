<?php

include("../lib/renderpage.php");
include("../lib/checkcache.php");
include("../cfg/nmcgraph_cfg.php");
include("../lib/buildgraph.php");

//var_dump($_POST);exit;
if ( isset( $_POST ) && isset( $_POST["day"]) )
{ $date=$_POST["day"]; }
else if ( isset( $_GET ) && isset( $_GET["day"] ) )
{ $date=$_GET["day"]; }
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

$graphgendate = buildgraph( $MyData, $xsize, $ysize, $title,$minscale, $maxscale  );

}
renderpage($title, $permalink, $altimage, $imagepath, $graphgendate, $message,$cached );

?>
