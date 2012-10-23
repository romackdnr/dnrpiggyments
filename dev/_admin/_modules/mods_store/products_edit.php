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

$category_options = OptionsCategory::displayAllOptionsCategory();
$product_id = $_REQUEST['Id'];

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
	
	if(isset($_POST['isAvailable'])) {
		$isAvailable = 1;
	} else {
		$isAvailable = 0;
	}
	
	if(isset($_POST['isFeatured'])) {
		$isFeatured = 1;
	} else {
		$isFeatured = 0;
	}
	
	$_POST = sanitize($_POST);
	$products = $_POST;
	settype($products,'object');
	$products->isAvailable = $isAvailable;
	$products->isFeatured = $isFeatured;

	Products::updateProducts($products,$full_path); 
	$success = "Product Successfully Changed!";
	
	$diff_options = array();
	$new_options = array();
	$retained_options = array();
	$retained_option_counter = 0;
	$added_option_counter = 0;
	$new_option_counter = 0;
	$diff_option_counter = 0;

/***************************************************************************************************************************************
 * ALGORITHM FORM OPTIONS PANEL
 ***************************************************************************************************************************************/
	// Traverse All Categories and retreive New Options
	foreach($category_options as $cat)
	{
		$category_id = $cat->fldOptionsCategoryID;
		$new_cat_options = $_POST['options' . $category_id];

		if(isset( $new_cat_options ))
		{
			foreach ($new_cat_options as $option_id)
			{
				$new_options[$new_option_counter]['fldProductsOptionProductsId'] = $product_id;
				$new_options[$new_option_counter]['fldProductsOptionCategoryId'] = $category_id;
				$new_options[$new_option_counter]['fldProductsOptionMainId'] 	 = $option_id;

				if( !ProductsOption::isOptionSettingExists($product_id, $category_id, $option_id) )
				{
					$added_options[$added_option_counter] = $new_options[$new_option_counter];
					$added_option_counter++;
				}
				
				$new_option_counter++;
			}
		}
	}

	// Retrieve OLD Options
	$old_options = ProductsOption::getProductOptions($product_id);

	if(!empty($old_options))
	{
		// We can get the Options that should be retained
		//   by intersecting the NEW options from OLD options
		foreach($old_options as $old_option)
		{
			$pid 			= $old_option['fldProductsOptionProductsId'];
			$category_id 	= $old_option['fldProductsOptionCategoryId'];
			$option_id 		= $old_option['fldProductsOptionMainId'];

			// Compare One Old Option from New Options List, Delete Old Option once not found in New Options
			if( ProductsOption::isOptionInOptionList($old_option, $new_options) )
			{
				$retained_options[$retained_option_counter] = $old_option;
				$retained_option_counter++;
			}
			else
			{
				$diff_options[$diff_option_counter] = $old_option;
				$diff_option_counter++;
				ProductsOption::deleteProductsOption($pid, $category_id, $option_id);
			}
		}

		foreach($new_options as $option)
		{
			$pid 			= $option['fldProductsOptionProductsId'];
			$category_id 	= $option['fldProductsOptionCategoryId'];
			$option_id 		= $option['fldProductsOptionMainId'];
			
			if( !ProductsOption::isOptionInOptionList($option, $diff_options) ) {
				ProductsOption::addProductsOption($category_id, $option_id, $pid);
			}
		}
	} 
	else
	{
		if(!empty($added_options))
		{
			foreach($added_options as $option)
			{
				$pid 			= $option['fldProductsOptionProductsId'];
				$category_id 	= $option['fldProductsOptionCategoryId'];
				$option_id 		= $option['fldProductsOptionMainId'];

				ProductsOption::addProductsOption($category_id, $option_id, $pid);
			}
		}			
	}

/***************************************************************************************************************************************
 * END OF ALGORITHM FORM OPTIONS PANEL
 ***************************************************************************************************************************************/

	$updates = 'Update products content';
	AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
}

$products = Products::findProducts($product_id); 
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/core3.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/modules.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/select2/select2.css" /> 
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_manager/tinymce/tiny_mce.js"></script>
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_store/js/tiny.mods.js"></script>
</head>

<body>
<? if(isset($success)) { ?>
	<div class="alert"> <?=$success?> </div>
<? } ?>
<div id="store_overview">
    	<ul class="btn">
  			<li><a href="<?=$ROOT_URL?>_admin/modules_products/view/">Back</a></li>    		
    	</ul>
</div>        
  <form id="store_page" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <h3>ACM Simple E-Cart (Products)</h3>
   
    <fieldset style="width:1065px;">
      <legend>Products Panel</legend>
      <ul>
         <li>
          <label for="title">Category</label>
          <select name="category_id">
          	<option value="">Choose Category</option>
          	<? 
				$category = Category::displayAllCategory(0);
				foreach($category as $categories) {
					if($categories->fldCategoryID == $products->fldProductsCategoryID) {
						$selected = "selected='selected'";
					} else {
						$selected = "";
					}
			?>
            		<option value="<?=$categories->fldCategoryID?>" <?=$selected?>><?=$categories->fldCategoryName?></option>
                    <?
						//for subcategory
						$subcat = Category::displayAllCategory($categories->fldCategoryID);
						foreach($subcat as $subcats) {
							if($subcats->fldCategoryID == $products->fldProductsCategoryID) {
								$selected = "selected='selected'";
							} else {
								$selected = "";
							}		
					?>
                    		<option value="<?=$subcats->fldCategoryID?>" <?=$selected?>>&nbsp;&nbsp;&raquo; <?=$subcats->fldCategoryName?></option>
                    <? } ?>
            <? } ?>
          </select>
        </li>
        <li>
          <label for="title">Product Name</label>
          <input type="text" id="title" name="name" value="<?=stripslashes($products->fldProductsName)?>">
        </li>
       
         <li>
          <label for="title">Product Price</label>
          $<input type="text" id="title" name="price" value="<?=stripslashes($products->fldProductsPrice)?>">
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
          <label for="title">Product Overview</label>
           <textarea rows="" cols="" name="overview"><?=stripslashes($products->fldProductsOverview)?></textarea>
        </li>
         <li>
          <label for="title">Additional Information</label>
           <textarea rows="" cols="" name="information"><?=stripslashes($products->fldProductsInformation)?></textarea>
        </li>
        <li>
          <label for="store.editor">Product Description
          <textarea cols="" rows="" id="store.editor" name="content"><?=stripslashes($products->fldProductsDescription)?></textarea>
          </label>
        </li>
        
        <li>
          <label for="title">isAvailable</label>
          <?
		  		if($products->fldProductsAvailability ==1) {
					$checked = "checked";
				} else {
					$checked = "";
				}
		  ?>
          <input type="checkbox" name="isAvailable" style="width:15px !important;" <?=$checked?>>
        </li>
        <li>
          <label for="title">isFeatured</label>
          <?
		  		if($products->fldProductsFeatured ==1) {
					$checked = "checked";
				} else {
					$checked = "";
				}
		  ?>
          <input type="checkbox" name="isFeatured" style="width:15px !important;" <?=$checked?>>
        </li>
        <li>
          <label for="position">Position</label>
          <input type="text" id="position" name="position" value="<?=stripslashes($products->fldProductsPosition)?>">
        </li>
         
      </ul>
      
        
    </fieldset>
     <fieldset style="width:1065px;">
      <legend>Options Panel</legend>
      <ul>
		<? foreach($category_options as $cat):
			// $category_options is declared above
			$category_id = $cat->fldOptionsCategoryID;
			$options = Options::displayAllOptions($category_id);
			?>
			<b><?=$cat->fldOptionsCategoryName?></b><br />
			<select multiple style="width:700px" id="options<?=$cat->fldOptionsCategoryID?>" name="options<?=$cat->fldOptionsCategoryID?>[]">
          	<? foreach($options as $option):
          		$option_id = $option->fldOptionsID;
				if( ProductsOption::isOptionSettingExists($product_id, $category_id, $option_id) ):
					$selected = "selected='selected'";
				else:
					$selected = "";
				endif; ?>
				<option <?= $selected ?> value="<?=$option->fldOptionsID?>">
					<?=$option->fldOptionsName?>
				</option>
	        <? endforeach; ?>
            </select>
            <br />
    	<? endforeach; ?>
      </ul>
    </fieldset>
    <ul class="submission">
    <input type="hidden" name="Id" value="<?=$products->fldProductsId?>">
      <li><input type="submit" name="submit" value="Update Products"></li>
      <li><input type="reset" value="Clear Forms"></li>
    </ul>
  </form>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/select2/select2.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
	$(document).ready(function() { 
		<? foreach($category_options as $cat):?>
		$("#options<?=$cat->fldOptionsCategoryID?>").select2(); 
		<? endforeach; ?>
	});
</script>

</body>
</html>