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

<? 
	if(!isset($_SESSION['admin_id'])) {
		header("Location: index.php");
	}
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
	<? include '_manager/box.header/emulator.php'; ?>
  <meta name="Keywords" content="" />
  <meta name="Description" content="" />
  <title> Welcome to Piggyments Admin Control Panel </title>
  <!--[if IE]>
    <script src="<?=$ROOT_URL?>_admin/_assets/js/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/core2.css" />
  <? emptyblock('headercodes') ?>
  <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
</head>

<body onLoad="javascript:alternatecolor('alter_rows');">
<div id="wrapper">
	
	<!-- /Template Start Here -->
  <figure>
  	<header>
    	<h1 title="Welcome to Dog and Rooster Admin Panel"><!-- Dog and Rooster Logo --></h1>
      <strong>Welcome Administrator!</strong>
      
      <nav id="menunav1">
      	<div id="menu">
        	<ul class="panel1">
          	<li><a href="<?=$ROOT_URL?>_admin/modules_pages/"></a></li>
          </ul>
        	<ul class="panel2">
          	<li><a href="<?=$ROOT_URL?>_admin/settings_pages/"></a></li>
          </ul>
        	<ul class="panel3">
          	<li><a href="<?=$ROOT_URL?>_admin/Adminlogout/"></a></li>
          </ul>
        </div>
      </nav>
      <nav id="menunav2">
      	<ul>
        	<li><a href="<?=$ROOT_URL?>_admin/welcome/">Overview</a></li>
          <li><a href="<?=$ROOT_URL?>_admin/page_pages/">Page Management</a></li>
          <li><a href="<?=$ROOT_URL?>_admin/modules_pages/">Modules</a></li>
          
        </ul>
      </nav>
    </header>
    
    
    <section>
    	<div class="stop"></div>
      <!-- /Inter-Section Start Block -->

			<? emptyblock('section') ?>
      
      <!-- /Inter-Section End Block -->
			<div class="sbottom"></div>
    </section>  
  
  
  </figure>
	<!-- /Template End Here -->

  <footer>
    <small>Copyright <?=date('Y')?>. Dog and Rooster, Inc.</small>
  </footer>

<!--#extracodes#-->
<? emptyblock('extracodes') ?>
<!--#extracodes#-->
</div>
<? include '_manager/box.header/ie6update.php'; ?>
</body>
</html>
