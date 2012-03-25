<?php

function gettrades()
{
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
 return $new_trade_array;
}
?>
