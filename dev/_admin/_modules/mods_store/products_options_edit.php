<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Category.php";
include   "../../../classes/Products.php";
include   "../../../classes/ProductsOption.php";
include   "../../../classes/Options.php";
include   "../../../classes/OptionsCategory.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include_once('thumbnail/thumbnail_images.class.php');
include_once('functions/myFunctions.php');

if(isset($_POST['submit'])) {
	 
	 
	
	 $_POST = sanitize($_POST);
      $options = $_POST;
	  settype($options,'object');
	 
	  ProductsOption::updateProductsOptions($options); 
	  $success = "Product Options Successfully Changed!";
	  
	  
	  
	  $updates = 'Update products content';
  	    AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
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
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_store/js/tiny.mods.js"></script>
</head>

<body>
<? if(isset($success)) { ?>
	<div class="alert"> <?=$success?> </div>
<? } ?>
<div id="store_overview">
    	<ul class="btn">
  			<li><a href="<?=$ROOT_URL?>_admin/modules_products/options/<?=$_REQUEST['product_id']?>/">Back</a></li>    		
    	</ul>
</div>        
<? 
	$options = ProductsOption::findProductsOption($_REQUEST['id'],$_REQUEST['product_id']); 
	$optionsM = Options::findOptions($options->fldProductsOptionMainId);
?>
  <form id="store_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
    <h3>ACM Simple E-Cart (Product Options)</h3>
   
    <fieldset style="width:1065px;">
      <legend>Options Panel</legend>
      <ul>
         <li>
          <label for="title">Option Name</label>
          <?=$optionsM->fldOptionsName?>
        </li>        
       
         <li>
          <label for="amount">Option Price</label>
          $<input type="text" id="amount" name="amount" value="<?=stripslashes($options->fldProductsOptionAmount)?>">
        </li>
        
         
      </ul>
      
        
    </fieldset>
    
    <ul class="submission">
    <input type="hidden" name="Id" value="<?=$options->fldProductsOptionID?>">
      <li><input type="submit" name="submit" value="Update Products"></li>
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