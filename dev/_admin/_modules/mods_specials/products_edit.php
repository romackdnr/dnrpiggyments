<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Category.php";
include   "../../../classes/Products.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include_once('thumbnail/thumbnail_images.class.php');
include_once('functions/myFunctions.php');

if(isset($_POST['submit'])) {
	 
	 include ("upload_class.php"); //classes is the map where the class file is stored (one above the root)

	$max_size = 1024*250; // the max. size for uploading

	$my_upload = new file_upload;

	if($_FILES['image']['name'] != '') {


	$my_upload->upload_dir = "../../../products_image/"; // "files" is the folder for the uploaded files (you have to create this folder)
	$my_upload->extensions = array(".jpeg", ".gif", ".bmp",".jpg",".png");// specify the allowed extensions here
// $my_upload->extensions = "de"; // use this to switch the messages into an other language (translate first!!!)
	$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)
	$my_upload->rename_file = true;

	$my_upload->the_temp_file = $_FILES['image']['tmp_name'];
	$my_upload->the_file = $_FILES['image']['name'];
	$my_upload->http_error = $_FILES['image']['error'];
	$my_upload->replace = 'y';
	//$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
	//$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename

	$new_name = 'Products'.GetSID(7);
	//$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
	if ($my_upload->upload($new_name)) { // new name is an additional filename information, use this to rename the uploaded file
		$full_path_name = $my_upload->upload_dir.$my_upload->file_copy;
		$info = $my_upload->get_uploaded_file_info($full_path_name);
		$full_path = $my_upload->file_copy;
		// ... or do something like insert the filename to the database
	}

			
			
			

	} else {
			$full_path = "";
	}
	
	$isSpecials=1;
	
	 $_POST = sanitize($_POST);
      $products = $_POST;
	  settype($products,'object');
	   $products->isSpecials=$isSpecials;
	  Products::updateProducts($products,$full_path); 
	  $success = "Product Successfully Changed!";
	  
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
  			<li><a href="<?=$ROOT_URL?>_admin/modules_specials/view/">Back</a></li>    		
    	</ul>
</div>        
<? $products = Products::findProducts($_REQUEST['id']); ?>
  <form id="store_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
    <h3>ACM Simple E-Cart (Products)</h3>
   
    <fieldset style="width:1065px;">
      <legend>Special Products Panel</legend>
      <ul>
        
        <li>
          <label for="title">Product Name</label>
          <input type="text" id="title" name="name" value="<?=stripslashes($products->fldProductsName)?>">
        </li>
         <li>
          <label for="size">Product Size</label>
          <input type="text" id="size" name="size" value="<?=stripslashes($products->fldProductsSize)?>">
        </li>
         <li>
          <label for="title">Product Price</label>
          $<input type="text" id="title" name="price" value="<?=stripslashes($products->fldProductsPrice)?>">
        </li>
         <li>
          <label for="title">Product Price Value</label>
          $<input type="text" id="title" name="price_value" value="<?=stripslashes($products->fldProductsValue)?>">
        </li>
        <li>
          <label for="title">Product Weight</label>
          <input type="text" id="title" name="weight" value="<?=stripslashes($products->fldProductsWeight)?>">
        </li>
        
        <li>
          <label for="cover">Upload Image <span class="smaller"><em>(Max image size of 2Mb)</em></span></label>
          <input type="file" id="cover" name="image">
          <? if($products->fldProductsImage != '') { 
		  		$image = $products->fldProductsImage;
		  ?>
          		<img src="<?=$ROOT_URL?>products_image/<?=$image?>" width="120">
          <? } ?>
        </li>
        <li>
          <label for="store.editor">Product Description
          <textarea cols="" rows="" id="store.editor" name="content"><?=stripslashes($products->fldProductsDescription)?></textarea>
          </label>
        </li>
       
       <li>
          <label for="benefits">Product Benefits</label>
          <textarea cols="" rows="" id="benefits" name="benefits"><?=stripslashes($products->fldProductsBenefits)?></textarea>
        </li>
        <li>
          <label for="howto">How to Use</label>
          <textarea cols="" rows="" id="howto" name="howto"><?=stripslashes($products->fldProductsHowto)?></textarea>
        </li>
         <li>
          <label for="ingredients">Ingredients</label>
          <textarea cols="" rows="" id="ingredients" name="ingredients"><?=stripslashes($products->fldProductsIngredients)?></textarea>
        </li>
        <li>
          <label for="use">Use With</label>
          <textarea cols="" rows="" id="use" name="usewith"><?=stripslashes($products->fldProductsUse)?></textarea>
        </li>
      </ul>
      
        
    </fieldset>
    <ul class="submission">
    <input type="hidden" name="Id" value="<?=$products->fldProductsId?>">
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