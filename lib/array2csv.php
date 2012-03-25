<?php

function json2csv( $json, $filename)
{
 if ( !isset($json ) )
 {
  $json='[{"date":"1332630605","price":0.00431559,"amount":10.85000000,"id":"27260"}
,{"date":"1332625346","price":0.00431559,"amount":27.67000000,"id":"27259"}
,{"date":"1332625346","price":0.00431991,"amount":189.00000000,"id":"27258"}
,{"date":"1332625346","price":0.00432857,"amount":234.00000000,"id":"27257"}
,{"date":"1332618575","price":0.00433290,"amount":9.18226800,"id":"27256"}
,{"date":"1332617983","price":0.00450000,"amount":23.03427000,"id":"27255"}
,{"date":"1332617682","price":0.00450000,"amount":281.36277619,"id":"27254"}
,{"date":"1332617682","price":0.00445000,"amount":99.00000000,"id":"27253"}
,{"date":"1332617682","price":0.00440000,"amount":135.04763943,"id":"27252"}
,{"date":"1332617682","price":0.00439999,"amount":102.58958438,"id":"27251"}
,{"date":"1332617682","price":0.00439998,"amount":182.00000000,"id":"27250"}
,{"date":"1332617182","price":0.00433290,"amount":95.16100000,"id":"27249"}
,{"date":"1332613916","price":0.00433290,"amount":109.00000000,"id":"27248"}
,{"date":"1332612408","price":0.00433290,"amount":15.50000000,"id":"27247"}
,{"date":"1332612374","price":0.00436810,"amount":18.00000000,"id":"27246"}
,{"date":"1332603666","price":0.00440000,"amount":231.00000000,"id":"27245"}
]';
 }

 $json_obj = json_decode ($json);

 $fp = fopen($filename, 'w') or die("can't open file");

 foreach ($json_obj as $fields) 
 {
  fputcsv($fp, $fields);
 }

 fclose($fp);
}

function json2array($json)
{
 //var_dump($json);
 /*
 if ( !isset($json ) )
 {
  $json='[{"date":"1332630605","price":0.00431559,"amount":10.85000000,"id":"27260"}
,{"date":"1332625346","price":0.00431559,"amount":27.67000000,"id":"27259"}
,{"date":"1332625346","price":0.00431991,"amount":189.00000000,"id":"27258"}
,{"date":"1332625346","price":0.00432857,"amount":234.00000000,"id":"27257"}
,{"date":"1332618575","price":0.00433290,"amount":9.18226800,"id":"27256"}
,{"date":"1332617983","price":0.00450000,"amount":23.03427000,"id":"27255"}
,{"date":"1332617682","price":0.00450000,"amount":281.36277619,"id":"27254"}
,{"date":"1332617682","price":0.00445000,"amount":99.00000000,"id":"27253"}
,{"date":"1332617682","price":0.00440000,"amount":135.04763943,"id":"27252"}
,{"date":"1332617682","price":0.00439999,"amount":102.58958438,"id":"27251"}
,{"date":"1332617682","price":0.00439998,"amount":182.00000000,"id":"27250"}
,{"date":"1332617182","price":0.00433290,"amount":95.16100000,"id":"27249"}
,{"date":"1332613916","price":0.00433290,"amount":109.00000000,"id":"27248"}
,{"date":"1332612408","price":0.00433290,"amount":15.50000000,"id":"27247"}
,{"date":"1332612374","price":0.00436810,"amount":18.00000000,"id":"27246"}
,{"date":"1332603666","price":0.00440000,"amount":231.00000000,"id":"27245"}
]';
 }
 */

 $array = json_decode($json);
 //var_dump($array);
 return $array;
}

 function array2csv($filename, $mode, $array, $delim = ',', $enclosure = '"' )
 {
    if (empty($array) && !is_array($array)) {
        return false;
    }

    $sock = fopen('php://memory', 'w+') or die("can't open file");
    
    if ($sock === false) {
        return false;
    }

    // length written
    $length = 0;

    foreach ($array as $row) {
        $tmp = fputcsv($sock, $row, $delim, $enclosure);
        
        if ($tmp === false) {
            return false;
        }
        
        $length += $tmp;
    }

    fseek($sock, 0);

    $csv = fread($sock, $length);
    fclose($sock);

    return $csv;
}

?>
