<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/ForumCategory.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include_once('thumbnail/thumbnail_images.class.php');
include_once('functions/myFunctions.php');

if(isset($_POST['submit'])) {
	 	 	 
	 $_POST = sanitize($_POST);
      $category = $_POST;
	  settype($category,'object');
	  ForumCategory::addForumCategory($category); 
	  $success = "Forum Category Successfully Saved!";	
	  
	  $updates = 'Add new forum category content';
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
  			<li><a href="<?=$ROOT_URL?>_admin/modules_forum_category/view/">Back</a></li>
    		<li><a href="<?=$ROOT_URL?>_admin/modules_forum/view/">Forum</a></li>
    	</ul>
</div>        
  <form id="store_page" action="" method="post" enctype="multipart/form-data">
    <h3>ACM Forum Category</h3>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    <fieldset style="width:1065px;">
      <legend>Forum Category Panel</legend>
      <ul>
      	<li>          
          <label for="title">Main Category</label> 
          <select name="MainCatID">
          	<option value="0">no main category</option>
          <? 
		  		$category= ForumCategory::displayAll(0);
				foreach($category as $categories) { 
		  ?>
          			<option value="<?=$categories->fldForumCategoryID?>"><?=$categories->fldForumCategoryTitle?></option>
          <? } ?>
          </select>
        </li>
      
        <li>
          <label for="title">Category Name</label>          
          <input type="text" id="title" name="title">
        </li>
        
        
        
        <li>
          <label for="store.editor">Category Description</label>
          <textarea cols="" rows="" id="store.editor" name="content"></textarea>
        </li>
      </ul>
      
        
    </fieldset>
    <ul class="submission">
      <li><button type="submit" name="submit">Add Category</button></li>
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