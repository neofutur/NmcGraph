<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>Namecoin historical data from exchange.bitparking.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="neoNMCdata v 0.1 [13]" />
<link rel="alternate" type="application/rss+xml" title="Syndicate the whole site" href="http://bitcoin.gw.gd/spip.php?page=backend" />
<link rel="stylesheet" href="./themes/base/jquery.ui.all.css" />
<script type="text/javascript" src="./jquery-1.7.1.js"></script>
<script type="text/javascript" src="./jquery.validate.js"></script>
<script type="text/javascript" src="./ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="./ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="./ui/jquery.ui.datepicker.js"></script>

<link rel="stylesheet" href="./css/ui-lightness/jquery-ui-1.8.18.custom.css" />
<link rel="stylesheet" href="./demos.css" />
<script type="text/javascript" >
/* <![CDATA[ */
 $(function() {
  $( "#day" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "-1D", dateFormat: 'yy-mm-dd', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeMonth: true, changeYear: true });
  });
 $(function() {
  $( "#month" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "+1D", dateFormat: 'yy-mm', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeMonth: true, changeYear: true });
  });
 $(function() {
  $( "#year" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "-1D", dateFormat: 'yy', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeYear: true });
  });
 $(function() {
  $( "#year2" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "-1D", dateFormat: 'yy', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeYear: true });
  });
 $(document).ready(function() {
  $( '.xsize').keydown(function(event) {
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
  $( '.ysize').keydown(function(event) {
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });

});
/* ]]> */ 
</script>

</head>
<body>
<h1> welcome on namecoin.gw.gd, still alpha version, but already providing historical data for namecoin</h1>
<br />
<h2>daily data</h2>
<br />
<table>
<tr>
<td>
<div class="demo">
<form action="./daily/nmc_daily.php" method="post">
<label for="day">choose day</label>
<input type="text" id="day" name="day" class="datepicker" />
<br />Optionnaly choose the <label for="xsize1">width</label>
<input type="text" class="xsize" id="xsize1" name="xsize" value="800" />
<br />and <label for="ysize1">Height</label> for your graph
<input type="text" class="ysize" id="ysize1" name="ysize" value="600" />
<input type="submit" value="go !" />
</form>
<b> max size for graphs is 1024x768 </b>
</div>
</td>
<td>
 <?php $today= date("Y-m-d"); $yesterday=date("Y-m-d",time() - 60 * 60 * 24) ; $thedaybefore = date("Y-m-d",time() - 60 * 60 * 48); ?>
<h3>or</h3> <form action="./daily/nmc_daily.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $today ;?>" name="day" /> <input type="submit" value="today" /> </form>
</td>
<td>
 <h3>or</h3> <form action="./daily/nmc_daily.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $yesterday ;?>" name="day" /> <input type="submit" value="yesterday" /> </form>
</td>
<td>
 <h3>or</h3> <form action="./daily/nmc_daily.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $yesterday ;?>" name="day" /> <input type="submit" value="the day before" /> </form>
</td>

</tr>
</table>

<h2>monthly data</h2>
<table>
<tr><td>
<div class="demo">
<form action="./monthly/nmc_monthly.php" method="post">
<label for="month">Choose month</label>
<input type="text" id="month" name="month" class="datepicker" />
<br />Optionnaly choose the <label for="xsize2">width</label>
<input type="text" class="xsize" id="xsize2" name="xsize"  value="800" />
<br />and <label for="ysize2">Height</label> for your graph
<input type="text" class="ysize" id="ysize2" name="ysize" value="600" />
<input type="submit" value="Go !" />
</form>
<b> max size for graphs is 1024x768 </b>
</div>
</td>
<td>
 <?php $thismonth= date("Y-m"); $lastmonth=date("Y-m",time() - 60 * 60 * 24 * 30) ; $themonthbefore = date("Y-m",time() - 60 * 60 * 24 * 60); ?>
<h3>or</h3> <form action="./monthly/nmc_monthly.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $thismonth;?>" name="month" /> <input type="submit" value="this month" /> </form>
</td>
<td>
 <h3>or</h3> <form action="./monthly/nmc_monthly.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $lastmonth;?>" name="month" /> <input type="submit" value="last month" /> </form>
</td>
<td>
 <h3>or</h3> <form action="./monthly/nmc_monthly.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $themonthbefore;?>" name="month" /> <input type="submit" value="the month before" /> </form>
</td>

</tr>
</table>


<h2>yearly data, per month</h2>
<div class="demo">
<form action="./yearly/nmc_yearly.php" method="post">
<label for="year">choose year</label>
<input type="text" id="year" name="year" class="datepicker" />
<br />Optionnaly choose the <label for="xsize3">width</label>
<input type="text" class="xsize" id="xsize3" name="xsize" value="800" />
<br />and <label for="ysize3">Height</label> for your graph
<input type="text" class="ysize" id="ysize3" name="ysize" value="600"  />
<input type="submit" value="go !" />
</form>
<b> max size for graphs is 1024x768 </b>
</div>

<h2>yearly data, per week</h2>
<table><tr>
<td>
<div class="demo">
<form action="./yearly/nmc_yearlyw.php" method="post">
<label for="year2">choose year</label>
<input type="text" id="year2" name="year2" class="datepicker" />
<br />Optionnaly choose the <label for="xsize4">width</label>
<input type="text" class="xsize" id="xsize4" name="xsize" value="800" />
<br />and <label for="ysize4">Height</label> for your graph
<input type="text" class="ysize" id="ysize4" name="ysize" value="600"  />
<input type="submit" value="go !" />
</form>
<b> max size for graphs is 1024x768 </b>
</div>
</td>
<td>
 <?php $thisyear= date("Y"); $lastyear=date("Y",time() - 60 * 60 * 24 * 365) ; $theyearbefore = date("Y",time() - 60 * 60 * 24 * 730); ?>
<h3>or</h3> <form action="./yearly/nmc_yearlyw.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $thisyear;?>" name="year2" /> <input type="submit" value="this year" /> </form>
</td>
<td>
 <h3>or</h3> <form action="./yearly/nmc_yearlyw.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $lastyear;?>" name="year2" /> <input type="submit" value="last year" /> </form>
</td>
<td>
 <h3>or</h3> <form action="./yearly/nmc_yearlyw.php" method="post"> <input type="hidden" value="800" name="xsize1" /> <input type="hidden" value="600" name="ysize1" /><input type="hidden" value="<?php echo $theyearbefore;?>" name="year2" /> <input type="submit" value="the year before" /> </form>
</td>
</tr>
</table>

</body>
</html>

