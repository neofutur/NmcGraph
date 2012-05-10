<?php
require_once(dirname(__FILE__)."/array2csv.php");

function getdepth(&$bids, &$asks )
{
// get the json from http://exchange.bitparking.com:8080/api/t
 $opts = array(
  'http'=> array(
  'method'=>   "GET",
  'user_agent'=>    "MozillaXYZ/1.0"));
 $context = stream_context_create($opts);
 $json = file_get_contents('http://exchange.bitparking.com:8080/api/o', false, $context);
 //var_dump($json);
 //have the json
 $new_depth_array=json2array($json);
 //var_dump($new_depth_array);
 $asks = $new_depth_array->asks;
 $bids = $new_depth_array->bids;
 //echo "<pre>";var_dump($bids);echo "</pre>";
 //echo "<pre>";var_dump($asks);echo "</pre>";
 if ( $asks && $bids ) return true;
 else return false;
}
?>
