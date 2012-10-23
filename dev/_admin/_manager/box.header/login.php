<? ob_start(); ?>
<? session_start(); ?>
<? require_once 'php_inheritance.php' ?>
<?php 
include   "../classes/Database.php";
include   "../classes/Connection.php";
include_once "../includes/bootstrap.php";    
include   "../classes/Administrator.php";
include   "../classes/Blogs.php";
include   "../classes/Cart.php";
include   "../classes/Category.php";
include   "../classes/Client.php";
include   "../classes/Contact.php";
include   "../classes/Country.php";
include   "../classes/Forum.php";
include   "../classes/ForumAnswer.php";
include   "../classes/ForumCategory.php";
include   "../classes/ForumReply.php";
include   "../classes/Newsletter.php";
include   "../classes/Pages.php";
include   "../classes/PhotoGallery.php";
include   "../classes/Products.php";
include   "../classes/Shipping.php";
include   "../classes/ShippingRate.php";
include   "../classes/State.php";
include   "../classes/TempCart.php";
include   "../classes/Sitemap.php";
include   "../classes/Modules.php";
include   "../classes/AdminAction.php";
include   "../classes/VideoGallery.php";
include   "../includes/security.funcs.inc";
include   "../includes/Pagination.php";
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>  
  <? include '_manager/box.header/emulator.php'; ?>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />	
  <title> Welcome to Piggyments Admin Control Panel </title>
  <!--[if IE]>
    <script src="_assets/js/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" media="screen" href="_assets/css/core1.css" />
  <? emptyblock('headercodes') ?>
  <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
  <script language="javascript">
    var theImages = new Array() 
	var theValue = new Array() 
    theImages[0] = '_assets/images/captcha1.jpg'
    theImages[1] = '_assets/images/captcha2.jpg'
    theImages[2] = '_assets/images/captcha3.jpg'
    theImages[3] = '_assets/images/captcha4.jpg'
	theValue[0] = 'dog';
	theValue[1] = 'rooster';
	theValue[2] = 'design';
	theValue[3] = 'company';
    var j = 0
    var p = theImages.length;
    var preBuffer = new Array()
    for (i = 0; i < p; i++){
       preBuffer[i] = new Image()
       preBuffer[i].src = theImages[i]
    }
    var whichImage = Math.round(Math.random()*(p-1));
    function showImage(){
    document.write('<img src="'+theImages[whichImage]+'">');
	document.getElementById('security').value= theValue[whichImage];
    }
  </script>
</head>

<body>
<div id="wrapper">
	<? emptyblock('section') ?>
</div>

<!--#extracodes#-->
<? emptyblock('extracodes') ?>
<!--#extracodes#-->
<? include '_manager/box.header/ie6update.php'; ?>
</body>
</html>