<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>Namecoin historical data from exchange.bitparking.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="neoNMCdata v 0.1 [13]" />
<link rel="alternate" type="application/rss+xml" title="Syndicate the whole site" href="http://bitcoin.gw.gd/spip.php?page=backend" />
<link rel="stylesheet" href="./themes/base/jquery.ui.all.css" />
<script type="text/javascript" src="./jquery-1.7.1.js"></script>
<script type="text/javascript" src="./ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="./ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="./ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="./css/ui-lightness/jquery-ui-1.8.18.custom.css" />
<link rel="stylesheet" href="./demos.css" />
<script type="text/javascript" >
 $(function() {
  $( "#day" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "-1D", dateFormat: 'yy-mm-dd', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeMonth: true, changeYear: true });
  });
 $(function() {
  $( "#month" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "+1D", dateFormat: 'yy-mm', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeMonth: true, changeYear: true });
  });
 $(function() {
  $( "#year" ).datepicker({ minDate: new Date(2011, 5, 1), maxDate: "-1D", dateFormat: 'yy', showOtherMonths: true, selectOtherMonths: true,  navigationAsDateFormat: true , autoSize: true, changeYear: true });
  });
</script>

</head>
<body>
<h1> welcome on namecoin.gw.gd, still alpha version, but already providing historical data for namecoin</h1>


<h2>daily data</h2>
<div class="demo">
<form action="./daily/nmc_daily.php" method="post">
<label for="day">choose day</label>
<input type="text" id="day" name="day" class="datepicker" />
<input type="submit" value="go !" />
</form>
</div>

<h2>monthly data</h2>
<div class="demo">
<form action="./monthly/nmc_monthly.php" method="post">
<label for="month">Choose month</label>
<input type="text" id="month" name="month" class="datepicker" />
<input type="submit" value="Go !" />

</form>
</div>


<h2>yearly data</h2>
<div class="demo">
<form action="./yearly/nmc_yearly.php" method="post">
<label for="day">choose year</label>
<input type="text" id="year" name="year" class="datepicker" />
<input type="submit" value="go !" />
</form>
</div>

</body>
</html>

