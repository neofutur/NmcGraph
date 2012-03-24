<?php

include("../../class/pData.class.php");
include("../../class/pDraw.class.php");
include("../../class/pImage.class.php");
include("../../class/pStock.class.php");
include("../lib/nmcload.php");

if ( isset( $_POST ) && isset( $_POST["day"] ) && is_numeric($_POST["day"]) )
{
 //received as 03/15/2012 -> 2012-03-01
 $date=$_POST["day"];
 //$date = substr($_POST["day"], 0,4) . "-".substr($_POST["day"],0,2)."-".substr($_POST["day"],8,2);
 //echo $date;exit;
}
else $date="2011-06-10";

$minscale=null; $maxscale=null;
$type="daily"; $interval="1-hour";

/* Create and populate the pData object */
$MyData = new pData(); 
load_nmc_data($MyData, $date, $type, $minscale, $maxscale);
//var_dump($MyData);

//printf("minscale: $minscale maxscale: $maxscale <br />\n");

$MyData->setAxisDisplay(0,AXIS_FORMAT_CURRENCY, "฿"  );
//$MyData->addPoints(array("8h","10h","12h","14h","16h","18h"),"Time");
$MyData->setAbscissa("Time");
//$MyData->setAxisName(0,"Price in BTC"); 
//$MyData->setSerieDescription("Time","Hour of the day");

/* Create the pChart object */
$myPicture = new pImage(700,230,$MyData);
 
/* Draw the background */
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);
 
/* Overlay with a gradient */
$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
 
/* Draw the border */
$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));
 
/* Write the title */
$myPicture->setFontProperties(array("FontName"=>"../../fonts/verdana.ttf","FontSize"=>9));
$myPicture->drawText(70,45,"NMC price in BTC at date $date",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
 
/* Draw the 1st scale */
$myPicture->setGraphArea(70,60,660,190);
$myPicture->drawFilledRectangle(70,60,660,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));

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
$myPicture->autoOutput("pictures/example.drawStockChart.png");

?>
