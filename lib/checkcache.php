<?php
function checkcache( $imagefilename)
{
 $current_time = time(); $expire_time = 3600; $file_time = @filemtime($imagefilename);
 if(file_exists($imagefilename) && ($current_time - $expire_time < $file_time)) 
 {
  //echo 'returning from cached file';
  $graphgendate = $file_time;
  return $graphgendate;
 }
 else return null;
}
?>
