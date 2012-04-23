<?php

include("../../class/pData.class.php");
include("../../class/pDraw.class.php");
include("../../class/pImage.class.php");
include("../../class/pStock.class.php");
include("../lib/nmcload.php");
include("../lib/renderpage.php");
include("../cfg/nmcgraph_cfg.php");

//echo $_GET["month"] ; exit;
//printf($_POST["month"] );exit;
if ( isset( $_POST ) && isset( $_POST["month"] ) )  
{ $date = $_POST["month"]; }
else if (  isset( $_GET )  && isset( $_GET["month"] ) )
{ $date = $_GET["month"]; }
else $date = "2011-06";

if ( !checkdate(substr($date,5,2),1,substr($date,0,4))) { echo "wrong date : ".$date; exit;}

if ( isset( $_POST ) && isset( $_POST["xsize"] ) && is_numeric($_POST["xsize"]) && $_POST["xsize"] <=1024 ) { $xsize = $_POST["xsize"]; }
else $xsize=800;
if ( isset( $_POST ) && isset( $_POST["ysize"] ) && is_numeric($_POST["ysize"]) && $_POST["ysize"] <=768 ) { $ysize = $_POST["ysize"]; }
else $ysize=600;

$minscale=null; $maxscale=null;
$type="monthly"; $interval="1-day";
$imagefilename="../cache/monthly/monthly_$date.png";
$imagepath="/cache/monthly/monthly_$date.png";
$altimage=$type." namecoin graph for date $date";
$permalink=$siteurl."/monthly/nmc_monthly.php?month=".$date;
$title=$type." namecoin historic data graph for date $date";

//echo $date;exit;
/* Create and populate the pData object */
$MyData = new pData(); 
load_nmc_data($MyData, $date, $type, $minscale, $maxscale, $interval);

// now we have the data, lets build the image

$MyData->setAxisDisplay(0,AXIS_FORMAT_CURRENCY, "฿"  );
//$MyData->addPoints(array("8h","10h","12h","14h","16h","18h"),"Time");
$MyData->setAbscissa("Time");
//$MyData->setAxisName(0,"Price in BTC"); 
//$MyData->setSerieDescription("Time","Hour of the day");

/* Create the pChart object */
$myPicture = new pImage($xsize,$ysize,$MyData);
 

$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,$xsize,$ysize,DIRECTION_VERTICAL,$Settings);
 
/* Draw the border */
$myPicture->drawRectangle(0,0,$xsize-1,$ysize-1,array("R"=>0,"G"=>0,"B"=>0));
 
/* Write the title */
$myPicture->setFontProperties(array("FontName"=>"../../fonts/verdana.ttf","FontSize"=>9));
$myPicture->drawText(70,45,"NMC price in BTC at date $date",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
 
/* Draw the 1st scale */
$myPicture->setGraphArea(70,60,$xsize-40,$ysize-30);
$myPicture->drawFilledRectangle(70,60,$xsize-40,$ysize-30,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));

$AxisBoundaries = array(0=>array("Min"=>$minscale,"Max"=>$maxscale));
$myPicture->drawScale(array("DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries ));
 
/* Draw the 1st stock chart */
$mystockChart = new pStock($myPicture,$MyData);
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>30));
$mystockChart->drawStockChart();
 
/* Reset the display mode because of the graph small size */
//$MyData->setAxisDisplay(0,AXIS_FORMAT_DEFAULT);
 
/* Draw the 2nd scale */
//$myPicture->setShadow(FALSE);
//$myPicture->setGraphArea(500,60,670,190);
//$myPicture->drawFilledRectangle(500,60,670,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
//$myPicture->drawScale(array("Pos"=>SCALE_POS_TOPBOTTOM,"DrawSubTicks"=>TRUE));
 
/* Draw the 2nd stock chart */
//$mystockChart = new pStock($myPicture,$MyData);
//$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>30));
//$mystockChart->drawStockChart();
 
/* Render the picture (choose the best way) */
//$myPicture->autoOutput("pictures/example.drawStockChart.png");
$myPicture->render($imagefilename);
renderpage($title, $permalink, $altimage, $imagepath );

?>
