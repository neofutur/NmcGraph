<?php

function update_csv_file ( $filename, $trade_array )
{
 $tdate="";

 date_default_timezone_set('NZ');


 //know last trade_id in file
 $last_in_file  = last_tradeid_in_file ($filename);
 $last_in_array = last_tradeid_in_array($trade_array);
 //printf(" updating $filename last_in_file $last_in_file last_in_array $last_in_array \n");
 //var_dump($trade_array);
 $trade_array =array_reverse($trade_array);
 //var_dump($trade_array);

 if ( $last_in_array > $last_in_file  )
 {
  //we need to append new trades to this file
  $csvfile=fopen ($filename,"a+") or die("can't open file");
  foreach( $trade_array as $trade )
  {
   //var_dump($trade);
   $tid=$trade->id;
   //printf("tid : $tid\n");
   if ($tid > $last_in_file )
   {
    //printf("adding $tid > $last_in_file \n");
    //csv format :
    //27200,sell,0.64000000000000000000,0.00427900000000000000,2012-03-23 01:23:04.585516
    //2012-03-24 15:41:06.000000
    //line = 27245,buy,231,0.0044,2012-03-24 15:41:06.000000

    $tdate = date("Y-m-d H:i:s.u",$trade->date);
    //printf("tdate = $tdate\n");
    $tprice  = sprintf( "%01.8f", $trade->price );  //8 decimals
    $tamount = sprintf( "%01.8f", $trade->amount ); //8 decimals

    $line=$tid.",buy,".$tamount.",".$tprice.",".$tdate."\n";
    //printf("line = $line \n");
    fwrite($csvfile,$line);
   }
  }
  fclose($csvfile);
  return true;
 }
 else return false; //file updated
}

function last_tradeid_in_array ( $array )
{
 $last_trade_id=null;
 $tid="";

 if ( isset ( $array ) && isset($array[0]) )
 {
 //parse array
  foreach( $array as $trade )
  {
   /*
   object(stdClass)#14 (4) { ["date"]=>   string(10) "1332612408"
                             ["price"]=>  float(0.0043329)
			     ["amount"]=> float(15.5)
			     ["id"]=>     string(5) "27247"
                           }
   */
   //printf("<pre>");var_dump($trade);printf("</pre>");

   $tid=$trade->id;
   //printf("id : $tid\n");
   if ( $last_trade_id == null || $tid>$last_trade_id ) $last_trade_id = $tid;
  }
  //printf("last in array : $last_trade_id\n");
  return $last_trade_id;
 }
 else return null;
}

function last_tradeid_in_file ( $filename )
{
 $maxline=100;
 $last_trade_id=null;

 if ( isset($filename ) )
 {
  //printf("file : $filename\n");
  //open file
  $csvfile=fopen ($filename,"r") or die("can't open file");

  //read all
  while ( $rawline= fgetcsv( $csvfile, $maxline ) )
  {
   //printf("$rawline\n");
   $tid=$rawline[0];
   if ( $tid )
   {
    //printf("last_trade_id : $last_trade_id tid: $tid\n");
    if ($last_trade_id = null || $tid > $last_trade_id )
     $last_trade_id=$tid;
   }

   //var_dump($rawline);
  }
  //printf("last in file : $last_trade_id \n");
  fclose ( $csvfile );

  return $last_trade_id;
  //return last tradeid_in_file

 }
 else return null;
}
?>
