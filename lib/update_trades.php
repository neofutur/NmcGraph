<?php

require_once("./array2csv.php");
require_once("./csvtools.php");
require_once("./gettrades.php");

$first_trade_array=array();
$second_trade_array=null;

 // get the json from http://exchange.bitparking.com:8080/api/t

 $opts = array(
 'http'=> array(
 'method'=>   "GET",
 'user_agent'=>    "MozillaXYZ/1.0"));
 $context = stream_context_create($opts);
 $json = file_get_contents('http://exchange.bitparking.com:8080/api/t', false, $context);

 //have the json
 $new_trade_array=json2array($json);
 $new_trade_array=array_reverse($new_trade_array);
 //var_dump($new_trade_array);
 $new_trade_array = gettrades();

 date_default_timezone_set('NZ');
 

  // one or two dates in the json ?
 $first_date =split_by_date  ($new_trade_array,$first_trade_array, $second_trade_array );
 $first_trade_array=array_reverse($first_trade_array);
 if ( $second_trade_array ) $second_trade_array =array_reverse($second_trade_array);

 //echo"first date = $first_date\n";
 if ( isset( $second_trade_array ) )
 {
  $next_day=substr($first_date,8,2)+1;
  $second_date=substr($first_date,0,8).$next_day;
  //echo"second date = $second_date\n";
 }

 $firstdate_month= substr($first_date,0,7);
 $firstdate_year = substr($first_date,0,4);

 $filename_daily    = "../data/daily/namecoin_$first_date.csv";        //namecoin_2011-10-05.csv
 $filename_monthly  = "../data/monthly/namecoin_$firstdate_month.csv"; //namecoin_2011-12.csv
 $filename_yearly   = "../data/yearly/namecoin_$firstdate_year.csv";   //namecoin_2012.csv
 $filename_alltime  = "../data/alltime/namecoin_alltime.csv";

 //printf("files : $filename_daily $filename_monthly $filename_yearly \n");
 update_csv_file($filename_daily,$first_trade_array);
 update_csv_file($filename_monthly,$first_trade_array);
 update_csv_file($filename_yearly,$first_trade_array);
 update_csv_file($filename_alltime,$first_trade_array);

 //var_dump($second_trade_array);

 if ( isset($second_trade_array) )
 {

  $seconddate_month=substr($second_date,0,7);
  $seconddate_year=substr($second_date,0,4);

  $filename_daily     = "../data/daily/namecoin_$second_date.csv";        //namecoin_2011-10-05.csv
  $filename_monthly   = "../data/monthly/namecoin_$seconddate_month.csv"; //namecoin_2011-12.csv
  $filename_yearly    = "../data/yearly/namecoin_$seconddate_year.csv";   //namecoin_2012.csv
  $filename_alltime   = "../data/yearly/namecoin_$seconddate_year.csv";   //namecoin_2012.csv

 //printf("files : $filename_daily $filename_monthly $filename_yearly \n");
 update_csv_file($filename_daily,$first_trade_array);
 update_csv_file($filename_monthly,$first_trade_array);
 update_csv_file($filename_yearly,$first_trade_array);
 update_csv_file($filename_alltime,$first_trade_array);
 }

function split_by_date( $new_trade_array,&$first_trade_array, &$second_trade_array )
{
 $olddate =null;
 $second_trade_array=null;

 foreach( $new_trade_array as $trade )
 {
  $tdate = date("Y-m-d",$trade->date);
  if ( $olddate == null || $tdate == $olddate )
  {
   array_push( $first_trade_array, $trade );
   $olddate=$tdate;
  }
  else
  {
   if (!isset($second_trade_array) ) $second_trade_array=array();

   array_push( $second_trade_array, $trade );
  }
  if ( isset( $second_trade_array )  )
    $second_trade_array = array_reverse($second_trade_array);
 }
 return $olddate;


}

?>
