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
	  $product_id = Products::addProducts($products,$full_path); 
	  $success = "Product Successfully Saved!";
	  
	  if(isset($_POST['options'])) {
		  foreach($_POST['options'] as $options) {
			  $option = explode(';',$options);
			  $category_id = $option[0];
			  $option_id = $option[1];
			  ProductsOption::addProductsOption($category_id,$option_id,$product_id);
		  }
	  }
	  
	   $updates = 'Add new products content';
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
  			<li><a href="<?=$ROOT_URL?>_admin/modules_products/view/">Back</a></li>    		
    	</ul>
</div>        
  <form id="store_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
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
					if($categories->fldCategoryID == $_REQUEST['category_id']) {
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
					?>
                    		<option value="<?=$subcats->fldCategoryID?>">&nbsp;&nbsp;&raquo; <?=$subcats->fldCategoryName?></option>
                    <? } ?>
            <? } ?>
          </select>
        </li>
        
        <li>
          <label for="title">Product Name</label>
          <input type="text" id="title" name="name">
        </li>
        
         <li>
          <label for="title">Product Price</label>
          $<input type="text" id="title" name="price">
        </li>
        <li>
          <label for="title">Product Weight</label>
          <input type="text" id="title" name="weight">
        </li>
        
        <li>
          <label for="cover">Upload Image <span class="smaller"><em>(Max image size of 2Mb)</em></span></label>
          <input type="file" id="cover" name="image">
        </li>
         <li>
          <label for="title">Product Overview</label>
           <textarea rows="" cols="" name="overview"></textarea>
        </li>
        <li>
          <label for="title">Additional Information</label>
           <textarea rows="" cols="" name="information"></textarea>
        </li>
        <li>
         
          <label for="title">Product Description</label>
          <label for="store.editor">
          		<textarea cols="" rows="" id="store.editor" name="content"> </textarea>
          </label>
        </li>
        <li>
          <label for="title">isAvailable</label>
          <input type="checkbox" name="isAvailable" style="width:15px !important;">
        </li>
        <li>
          <label for="title">isFeatured</label>
          <input type="checkbox" name="isFeatured" style="width:15px !important;">
        </li>
         <li>
          <label for="position">Position</label>
          <input type="text" id="position" name="position">
        </li>
      </ul>
      
        
    </fieldset>
    
    <fieldset style="width:1065px;">
      <legend>Options Panel</legend>
      <ul>
        
        <? 
			$optionsCat = OptionsCategory::displayAllOptionsCategory();
			foreach($optionsCat as $optionsCats) { 
				$option = Options::displayAllOptions($optionsCats->fldOptionsCategoryID);
		?>
        <li>
          <label for="title"><strong><?=$optionsCats->fldOptionsCategoryName?></strong> : &nbsp;&nbsp;</label>
          <?
		  	foreach($option as $options) { 
		  ?>
          		<input type="checkbox" name="options[]" value="<?=$optionsCats->fldOptionsCategoryID . ';' . $options->fldOptionsID?>" style="width:10px; display:inline;"> <?=$options->fldOptionsName?> &nbsp;
          <? } ?>
        </li>
        <? } ?>
       
        
      </ul>
      
        
    </fieldset>
    <ul class="submission">
      <li><input type="submit" name="submit" value="Add Products"></li>
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