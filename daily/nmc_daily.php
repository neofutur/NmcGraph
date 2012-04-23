<?php

include("../../class/pData.class.php");
include("../../class/pDraw.class.php");
include("../../class/pImage.class.php");
include("../../class/pStock.class.php");
include("../lib/nmcload.php");
include("../lib/renderpage.php");
include("../cfg/nmcgraph_cfg.php");

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

$current_time = time(); $expire_time = 3600*24*365; $file_time = @filemtime($imagefilename);
if(file_exists($imagefilename) && ($current_time - $expire_time < $file_time)) {
 //echo 'returning from cached file';
 //return file_get_contents($file);
}
else
{
/* Create and populate the pData object */
$MyData = new pData(); 
load_nmc_data($MyData, $date, $type, $minscale, $maxscale);
//var_dump($MyData);

//printf("minscale: $minscale maxscale: $maxscale <br />\n");

$MyData->setAxisDisplay(0,AXIS_FORMAT_CURRENCY, "฿"  );
//$MyData->addPoints(array("8h","10h","12h","14h","16h","18h"),"Time");
//$MyData->setAbscissa("Months");
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
$myPicture->drawRectangle(0,0,$xsize-1,$ysize-1,array("R"=>0,"G"=>0,"B"=>0));
 
/* Write the title */
$myPicture->setFontProperties(array("FontName"=>"../../fonts/verdana.ttf","FontSize"=>9));
$myPicture->drawText(70,45,"NMC price in BTC at date $date",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
 
/* Draw the 1st scale */
$myPicture->setGraphArea(70,60,$xsize-40,$ysize-30);
$myPicture->drawFilledRectangle(70,60,$xsize-40,$ysize-30,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));

// Y scale
$AxisBoundariesY = array(0=>array("Min"=>$minscale,"Max"=>$maxscale));
$myPicture->drawScale(array("DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundariesY ));

//X scale
//$AxisBoundariesX = array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
//$MyData->setSerieDescription("Labels","Months");
//$MyData->setAbscissa("Labels");
$MyData->setXAxisDisplay(0,AXIS_FORMAT_TIME,"H");
//$myPicture->drawScale(array("DrawXLines"=>array(0)));
 
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
}
renderpage($title, $permalink, $altimage, $imagepath );

/*echo "<html><head></head><body>";
echo "<a href=\"".$permalink."\"> permalink </a><br /><br />";
echo"<img alt=\"".$altimage."\" src=".$imagepath."/>";
echo "</body></html>";
*/
?>
