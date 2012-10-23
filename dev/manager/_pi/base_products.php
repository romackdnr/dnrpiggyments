<? require_once('includes/config.php');?>
<?php
	#if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
	#{ header('Location: http://iphone.dogandrooster.com'); exit(); } //remove comments to activate iphone redirection.

	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].dirname($_SERVER['PHP_SELF']);
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].dirname($_SERVER['PHP_SELF'])."/";
		}
		return $pageURL;
	}
	$root = curPageURL(); //record root url.

	function useragent() {
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		//print $useragent;
		if(strchr($useragent,"MSIE")) return 'IE';
	}
	if(useragent()=='IE') {
		$edge = "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> \n";
	} else { $edge = ""; }
	require_once "php_inheritance.php"; //execute template.
?>
<? $products = Products::findProducts($_REQUEST['id']);?>
<!doctype html>
<html lang=en class="no-j">
<head>
  <title><?=$products->fldProductsName?></title>
  <meta charset="utf-8">
  <?=$edge?>
  <meta name="author" content="info@dogandrooster.com">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">
  <meta name="copyright" content="">
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet/less" href="assets/css/core.less?v=3">
  <?=emptyblock('headercodes');?>
  <script src="assets/js/less.min.js"></script>
  <script src="assets/js/modernizr.js"></script>
</head>

<body>
<figure>
  <header>
    <div id=topnav>
    	<? require_once('manager/includes/topnav.php');?>
   </div>
    <h6 class=ir><a href="<?=$root?>" title="Homeapge">Dog and Rooster, Inc.</a></h6>
    <span> <!-- +1 (800) 555-1234 / Monday - Friday, 09:00 AM - 05:00 PM, PST. --> </span>    
    <nav>
    	<div id=menu>
      	<ul class=panel1><li><a href="<?=$root?>"></a></li></ul>
      	<ul class=panel2><li><a href="<?=$root?>about-us.html"></a></li></ul>
      	<ul class=panel3><li><a href="<?=$root?>products-all.html"></a></li></ul>
      	<ul class=panel4><li><a href="<?=$root?>graphic-design.html"></a></li></ul>
      	<ul class=panel5><li><a href="<?=$root?>business-packages.html"></a></li></ul>
      	<ul class=panel6><li><a href="<?=$root?>customer-support.html"></a></li></ul>
      	<ul class=panel7><li><a href="<?=$root?>contact-us.html"></a></li></ul>
      </div>
    </nav>
  </header>
  <section class=clearfix>
    <?=emptyblock('section');?>
  </section>

  <footer>
    <ul id=info_panel>
      <li class='col1 left'><img src="assets/images/icon_paymentcards.png" alt="All Payment Gateway"></li>
      <li class='col2 right'><img src="assets/images/info_contacts.png" alt="+1 (800) 555-1234 / Monday - Friday, 09:00 AM - 05:00 PM, PST."></li>
    </ul>
    <ul id=copyright>
    	<li class='col1 left smaller'>
      	<a href="<?=$root?>">Home</a>
        <a href="<?=$root?>about-us.html">About Us</a>
        <a href="<?=$root?>products-all.html">Products</a>
        <a href="<?=$root?>graphic-design.html">Graphic Design</a>
        <a href="<?=$root?>business-packages.html">Business Packages</a>
        <a href="<?=$root?>customer-support.html">Customer Support</a>
        <a href="<?=$root?>contact-us.html">Contact Us</a>
      </li>
      <li class='col2 right smaller'>
      	Red&amp;White Marketing (c) 2011. Al Rights Reserved. <small>San Diego Web Design by: Dog and Rooster, Inc.</small>
      </li>
    </ul>
  </footer>
</figure>
<script src="assets/js/head.min.js"></script>
<script>
head.js("assets/js/jquery.min.js");
<?=emptyblock('extracodes');?>	
</script>
</body>
</html>
<!--[if lt IE 8]> <div style='clear:both;height:59px;padding:0 0 0 15px;position:absolute;top:0;width:100%;text-align:center; margin:auto;z-index:1000;'> <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div> <![endif]--> 