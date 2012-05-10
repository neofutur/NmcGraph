<?php

include(dirname(__FILE__). "/../../class/pData.class.php");
include(dirname(__FILE__). "/../../class/pDraw.class.php");
include(dirname(__FILE__). "/../../class/pImage.class.php");
include(dirname(__FILE__). "/../../class/pStock.class.php");
include(dirname(__FILE__). "/../lib/nmcload.php");
include(dirname(__FILE__). "/../lib/renderpage.php");
include(dirname(__FILE__). "/../cfg/nmcgraph_cfg.php");

$date="alltime";
/*
if ( isset( $_POST ) && isset( $_POST["year"] ) )
{ $date = $_POST["year"]; }
else if (  isset( $_GET )  && isset( $_GET["year"] ) )
{ $date = $_GET["year"]; }
*/
//if ( !checkdate(1,1,substr($date,0.4))) { echo "wrong date : ".$date; exit;}

if ( isset( $_POST ) && isset( $_POST["xsize"] ) && is_numeric($_POST["xsize"]) && $_POST["xsize"] <=1024 ) { $xsize = $_POST["xsize"]; }
else $xsize=800;
if ( isset( $_POST ) && isset( $_POST["ysize"] ) && is_numeric($_POST["ysize"]) && $_POST["ysize"] <=768 ) { $ysize = $_POST["ysize"]; }
else $ysize=600;

$minscale=null; $maxscale=null;
$type="alltime"; $interval="1-month";
$imagefilename="../cache/alltime/alltime.png";
$imagepath="/cache/alltime/alltime.png";
$altimage=$type." namecoin graph ";
$permalink=$siteurl."/alltime/nmc_alltime.php";
$title=$type." ( by month ) namecoin historic data graph";
$graphgendate = "";
$message="alltime graph is cached one month";

$current_time = time(); $expire_time = 3600*24*30; $file_time = @filemtime($imagefilename);
if(file_exists($imagefilename) && ($current_time - $expire_time < $file_time)) {
 //echo 'returning from cached file';
 $graphgendate = $file_time;
}
else
{

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
 
/* Draw the background */
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,$xsize,$ysize,$Settings);
 
/* Overlay with a gradient */
$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,$xsize,$ysize,DIRECTION_VERTICAL,$Settings);
 
/* Draw the border */
$myPicture->drawRectangle(0,0,$xsize -1,$ysize -1,array("R"=>0,"G"=>0,"B"=>0));
 
/* Write the title */
$myPicture->setFontProperties(array("FontName"=>"../../fonts/verdana.ttf","FontSize"=>9));
$myPicture->drawText(70,45,$title,array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
 
/* Draw the 1st scale */
$myPicture->setGraphArea(70,60,$xsize -40,$ysize -30);
$myPicture->drawFilledRectangle(70,60,$xsize -40,$ysize -30,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));

//$MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"),"Labels");
//$MyData->setSerieDescription("Labels","Months");
//$MyData->setAbscissa("Labels");

$AxisBoundaries = array(0=>array("Min"=>$minscale,"Max"=>$maxscale));
$myPicture->drawScale(array("DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries ));
//$myPicture->drawScale(array("DrawSubTicks"=>FALSE,"CycleBackground"=>TRUE ));
//$myPicture->drawScale(array("DrawYLines"=>array(0))); 
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
$graphgendate = $current_time;
}

renderpage($title, $permalink, $altimage, $imagepath, $graphgendate, $message );


?>
