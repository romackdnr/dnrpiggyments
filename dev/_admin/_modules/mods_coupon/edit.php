<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Coupon.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include   "../../../functions/myFunctions.php";

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$code = $_POST['code'];

	
	if($name == ""){$name_error = "Please enter your coupon name";$ctr=1;}
	if($code == ""){$lastname_error = "Please enter your coupon code";$ctr=1;}

	
	if($ctr=="") { 
	
	if(isset($_POST['isFreeShipping'])) {
		  $isFreeShipping = 1;
	  } else {
		  $isFreeShipping = 0;
	  }
	  
	 $_POST = sanitize($_POST);
      $coupons = $_POST;
	  settype($coupons,'object');
	  $coupons->isFreeShipping = $isFreeShipping;
	  Coupon::updateCoupon($coupons); 
	  $success = "Copun Code Successfully Saved!";
	  
	   $updates = 'Add new coupon code content';
  	  AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
}

?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/core3.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/modules.css" /> 
  
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_manager/tinymce/tiny_mce.js"></script>
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_event/js/tiny.mods.js"></script>
  
</head>

<body>
	<? if(isset($success)) { ?>
		<div class="alert"> <?=$success?> </div>
    <? } ?>    
<div id="blog_overview">
	<ul class="btn">
	  	<li><a href="<?=$ROOT_URL?>_admin/modules_coupon/view/">Back</a></li>
    </ul>    
</div>    
<? $coupon = Coupon::findCoupon($_REQUEST['id']);?>
  <form id="blog_page" action="<? $PHP_SELF; ?>" method="post">
    <h3>ACM Coupon Code</h3>
    <fieldset style="width:1050px;">
      <legend>Coupon Code Panel</legend>
      <ul>
        <li>
          <label for="title">Coupon Code</label>
           <input type="text" id="title" name="code" value="<?=stripslashes($coupon->fldCouponCode)?>">   
           <? if(isset($code_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$code_error?></b></div>
           <? } ?>
        </li>
         <li>
          <label for="title">Coupon name</label>
           <input type="text" id="title" name="name" value="<?=stripslashes($coupon->fldCouponName)?>">   
           <? if(isset($name_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$name_error?></b></div>
           <? } ?>
        </li>
        <li>
          <label for="amount">Amount</label>
           $<input type="text" id="amount" name="amount" value="<?=$coupon->fldCouponPrice?>">   
           
        </li>
        <li>
          <label for="percent">Percent</label>
           <input type="text" id="percent" name="percent" value="<?=$coupon->fldCouponPercent?>">   
           
        </li>
        <li>
          <label for="shipping">Free Shipping</label>
          <? 
		  	if($coupon->fldCouponFreeShipping == 1) {
				$checked = "checked ='checked'";	
			} else {
				$checked = "";
			}
		 ?>
          <input type="checkbox" name="isFreeShipping" <?=$checked?>>         
        </li>
      
  
      </ul>
    </fieldset>
    <ul class="submission">
       <input type="hidden" name="Id" value="<?=$coupon->fldCouponID?>">
      <li><input type="submit" name="submit" value="Save Coupon Code"></li>
      <li><input type="reset" value="Clear Forms"></li>
    </ul>
  </form>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>