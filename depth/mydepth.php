<?php   
 /* CAT:Bar Chart */
require_once("../lib/loaddepth.php");
require_once("../lib/getdepth.php");

 /* pChart library inclusions */
 include("../class/pData.class.php");
 include("../class/pDraw.class.php");
 include("../class/pImage.class.php");

//if ( isset( $_POST ) && isset( $_POST["day"]) )
//{ $date=$_POST["day"]; }
//else if ( isset( $_GET ) && isset( $_GET["day"] ) )
//{ $date=$_GET["day"]; }
//if ( !checkdate(substr($date,5,2),substr($date,8.2),substr($date,0,4))) { echo "wrong date : ".$date; exit;}

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

$minscale=0;$maxscale=0;$valuerange=10;$totX=1000;


 /* Create and populate the pData object */
 $MyData = new pData();  

load_nmc_depth($MyData,5,$minscale,$maxscale,$valuerange,$totX);

 $MyData->setAxisName(0,"Values ( K NMC)");
// $MyData->addPoints(array("January","February","March","April","May","Juin","July","August","September"),"Months");
 $MyData->setSerieDescription("Values","Values");
 $MyData->setAbscissa("Values");

 /* Create the pChart object */
 $myPicture = new pImage($xsize,$ysize,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawGradientArea(0,0,$xsize,$ysize,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 $myPicture->drawGradientArea(0,0,$xsize,$ysize,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 $myPicture->drawRectangle(0,0,$xsize-1,$ysize-1,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>10));

 /* Define the chart area */
 $myPicture->setGraphArea(60,40,$xsize-50,$ysize-30);

 /* Draw the scale */
 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 $myPicture->drawScale($scaleSettings);

 /* Write the chart legend */
 $myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $settings = array("Surrounding"=>-30,"InnerSurrounding"=>30);
 $myPicture->drawBarChart($settings);

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("pictures/example.drawBarChart.simple.png");
?>
