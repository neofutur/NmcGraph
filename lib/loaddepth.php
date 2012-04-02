<?php
require_once("../lib/getdepth.php");

//$minscale=0;$maxscale=0;

//load_nmc_depth(null,5,$minscale,$maxscale);

function load_nmc_depth($MyData, $type=4, &$minscale, &$maxscale,$valuerange=10,$totX=1000 )
{
 $date = "2011-06-09";
 $round=$type-1;

 //printf ("avant load");
 $filename = "../data/depth/$type/nmcdepth_$date.csv";
 //printf("$filename <br />\n");
 //printf("filename : $filename <br />\n"); exit;
 if ( !file_exists($filename ) )
 {
  //printf("$MyData, $csvfile, $date, $minscale, $maxscale, $interval");
  $bids=array();$asks=array();
  if ( getdepth($bids,$asks) )
  {
   //printf ("<pre>");var_dump($bids);printf("</pre><br />\n");
   //printf ("<pre>");var_dump($asks);printf("</pre><br />\n");
  //if ( $depth_array )
  //{
  groupbids($bids,$round,$MyData,$valuerange,$totX);
  groupasks($asks,$round,$MyData,$valuerange,$totX);

  // echo "a";
   //write to data file
  // $csvfile=fopen ($filename,"w") or die("can't open file"); 
   //archive depth once an hour
   //load data for stats
   //foreach ( $depth_array as $line )
   //{
   
   //groupdata
   
   //}
   //writedepth ($MyData, $csvfile, $date, $minscale, $maxscale, $interval);
   // fclose($csvfile);                                                                                         i
  }else return false;
 }
 else
 {
  // loaddepth from file
  

  //loaddepth ($MyData, $csvfile, $date, $minscale, $maxscale, $interval);
  //echo"b"; 
 }
}

function loaddepth(&$MyData, &$csvfile, $date, &$minscale, &$maxscale, $interval)
{

}

function groupbids( $bids=null, $round=3,$MyData,$limit=10,$totX=1000 )
{
 $init=0;
 $totalrange = "0"; $totalorders = "0"; $totalquantity = "0";
 $nmcs=array();
 $volumes=array();
 $orders=array();
 $values=array();
 $totalranges=1;

 //$orders=array();
 //$values=array();

 foreach ( $bids as $bid )
 {
  
  if ( $totalranges > $limit ) break;
  
  // price quantity
  $price = $bid[0]; $quantity = $bid[1];
  $value=$price*$quantity;

  //var_dump($bid);
  $current=round($price,$round);
  //printf("$current , $price <br />\n");
  if ( $init == 0 ){ $range = $current;$init=1;}

  if ( $current == $range )
  {
   
   $totalrange  += $value;
   $totalorders +=1;
   $totalquantity += $quantity;
  }
  else
  {
   //new range
   $totalranges++;
   //flush old range to graphdata
   //$nmcs[] = $totalquantity; 
   //array_push( $nmcs,    $totalquantity);
   //var_dump($volumes);
//   if ($volumes)
//    if ( $totalrange > 0.00001 ) $volumes[] = (string)$totalrange;
//    else $volumes[] = null;
   $orders[]  =$totalorders;
   $volumes[] =$totalrange;
   $nmcs[]    =$totalquantity/$totX;
   $values[]  =$range;

   //printf("\n<br />range $range : $totalquantity NMC in $totalorders orders for a total of $totalrange BTC <br />\n");

   $hole = $range - $current;
   $precision=0.00011;
 
   if ( $hole > $precision ) 
   {
    for ( $i=0.0001; $i<$hole; $i+=$precision )
    {
     //push hole data rows
     $value= $range;
     $range-=0.0001;
     //$nmcs[]= $nmc; $volumes[]= $volumes; $orders []= $orders; $values []= $value;
     $orders[]  = 0;
     $volumes[] =0;
     $nmcs[]    =0;
     $values[]  =$range;
     $totalranges++;

     //printf("hole $range<br />\n"); 

    }
   //printf("current: $current range : $range hole : $hole precision : $precision<br />");

   }

   //new range
   $totalrange =  0; $totalorders = 0;$totalquantity=0; 

   $totalrange  = $totalrange + $value;
   $totalquantity += $quantity;
   $totalorders +=1;
  
   $range = $current;
  }
 }
//echo "<pre>"; var_dump($orders); echo "/<pre>";
//echo "<pre>"; var_dump($volumes); echo "/<pre>";
//echo "<pre>"; var_dump($nmcs); echo "/<pre>";
//echo "<pre>"; var_dump($values); echo "/<pre>";


$MyData->addPoints($volumes,"Depth");
$MyData->addPoints($orders,"Orders");
$MyData->addPoints($nmcs,"totNmc");
$MyData->addPoints($values,"Values");

}

function groupasks( $bids=null, $round=3,$MyData )
{

}
