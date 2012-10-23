<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Category.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include_once('thumbnail/thumbnail_images.class.php');
include_once('functions/myFunctions.php');

if(isset($_POST['submit'])) {
	 
	 
	 $_POST = sanitize($_POST);
      $category = $_POST;
	  settype($category,'object');
	  Category::updateCategory($category); 
	  $success = "Category Successfully Saved!";	
	  
	 		 $updates = 'Add new product category content';
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
  <script type="text/javascript" src="js/tiny.mods.js"></script>
</head>

<body>
<? if(isset($success)) { ?>
	<div class="alert"> <?=$success?> </div>
<? } ?>
<div id="store_overview">
    	<ul class="btn">
  			<li><a href="<?=$ROOT_URL?>_admin/modules_category/view/">Back</a></li>
    	</ul>
</div>        
<? $categoryContent = Category::findCategory($_REQUEST['id']);?>
  <form id="store_page" action="" method="post" enctype="multipart/form-data">
    <h3>ACM Simple E-Cart (Category)</h3>
   
    <fieldset style="width:1065px;">
      <legend>Category Panel</legend>
      <ul>
      	
        <li>
          <label for="title">Main Category</label>
          <select name="MainCatID">
          	<option value="0">No Main Category</option>
            <?
				$category = Category::displayAllCategory(0);
				foreach($category as $categories) {
					if($categoryContent->fldCategoryMainCatID == $categories->fldCategoryID) {
						$selected = "selected='selected'";
					} else {
						$selected = "";
					}
			?>
            	<option value="<?=$categories->fldCategoryID?>" <?=$selected?>><?=$categories->fldCategoryName?></option>
            <? } ?>
          </select>
        </li>
        
        <li>
          <label for="title">Category Name</label>
          <input type="text" id="title" name="name" value="<?=stripslashes($categoryContent->fldCategoryName)?>">
        </li>
        <li>
          <label for="position">Position</label>
          <input type="text" id="position" name="position" value="<?=stripslashes($categoryContent->fldCategoryPosition)?>">
        </li>
        
      </ul>
      
        
    </fieldset>
    <ul class="submission">
    	<input type="hidden" name="Id" value="<?=$_REQUEST['id']?>">
      <li><button type="submit" name="submit">Save Category</button></li>
      <li><button type="reset">Clear Forms</button></li>
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