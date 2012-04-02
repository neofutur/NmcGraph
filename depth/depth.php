<?php
require_once("../lib/loaddepth.php");
require_once("../lib/getdepth.php");

include("../../class/pData.class.php");
include("../../class/pDraw.class.php");
include("../../class/pImage.class.php");
include("../../class/pStock.class.php");
include("../lib/nmcload.php");

$minscale=0;$maxscale=0;

$MyData = new pData();

load_nmc_depth($MyData,5,$minscale,$maxscale);

//$MyData->AddAllSeries();  
$MyData->SetAbsciseLabelSerie("values");  
$MyData->SetSerieName("Depth","Depth");  
$MyData->SetSerieName("Orders","Orders");  
$MyData->SetSerieName("totNmc","totNmc");  

$Test = new pChart(700,230);  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(50,30,680,200);  
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Test->drawGraphArea(255,255,255,TRUE);  
 $Test->drawScale($MyData->GetData(),$MyData->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);     
 $Test->drawGrid(4,TRUE,230,230,230,50);  
  
 // Draw the 0 line  
 $Test->setFontProperties("Fonts/tahoma.ttf",6);  
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
  
 // Draw the bar graph  
 $Test->drawBarGraph($MyData->GetData(),$MyData->GetDataDescription(),TRUE);  
  
 // Finish the graph  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->drawLegend(596,150,$MyData->GetDataDescription(),255,255,255);  
 $Test->setFontProperties("Fonts/tahoma.ttf",10);  
 $Test->drawTitle(50,22,"Example 12",50,50,50,585);  
 $Test->Render("example12.png");  
?>
