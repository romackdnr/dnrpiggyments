<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Category.php";
include   "../../../classes/Pages.php";
include   "../../../classes/Products.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include_once('functions/myFunctions.php');
include_once('thumbnail/thumbnail_images.class.php');
include_once('functions/myFunctions.php');
?>
<?
			
	if(isset($_POST['submit'])) {
						
			$_POST = sanitize($_POST);
		    $pages = $_POST;
		    settype($pages,'object');
			Pages::updatePages($pages); 
			$success = "Page Successfully Saved!";
			
			$updates = 'Update Page Content';
			AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
	
	$page = Pages::findPages($_REQUEST['id']);
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/core3.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/page.css" /> 
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_manager/tinymce/tiny_mce.js"></script>
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/tiny.mods.js"></script>
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/tiny1.mods.js"></script>
</head>

<body>
  <? if(isset($success)) { ?>
  	<div class="alert"> <?=$success?> </div>
  <? } ?>
  
  <form id="form_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
  
    <fieldset>
      <legend>Modify Page</legend>
      <ul>
        <li><label for="page_name"> Page Name: </label>
          <input type="text" id="page_name" name="name" value="<?=stripslashes($page->fldPagesName)?>"></li>
                 
        <li><label for="page.editor"> Content Manager: </label>
          <textarea cols="" rows="" id="page.editor" name="content"><?=stripslashes($page->fldPagesDescription)?></textarea></li>
          
      </ul>
    </fieldset>
    
   
    
    <!--<div class="iecol1 center"><button type="submit">Save Page</button> &nbsp; <button type="reset">Clear Page</button></div> -->
    <ul class="submission">
      <input type="hidden" name="Id" value="<?=$page->fldPagesID?>">
    	<li><button type="submit" name="submit">Save Page</button></li>
      <li><button type="reset">Clear Page</button></li>
    </ul>
    
    
  </form>

</body>
</html>