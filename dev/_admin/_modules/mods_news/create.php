<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Newsletter.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
?>
<?
  if(isset($_POST['submit'])) {
	  $_POST = sanitize($_POST);
      $newsletter = $_POST;
	  settype($newsletter,'object');
	  Newsletter::addNewsletter($newsletter); 
	  $success = "Newsletter Successfully Saved!";
	  
	  $updates = 'Add new newsletter content';
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
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_news/js/tiny.mods.js"></script>
</head>

<body>
 <? if(isset($success)) { ?>
	<div class="alert"> <?=$success?> </div>
 <? } ?>   
<div id="blog_overview">
	<ul class="btn">
		<li><a href="<?=$ROOT_URL?>_admin/modules_newsletter/view/">Back</a></li>
    </ul>    
</div>
  <form id="blog_page" action="" method="post">
    <h3>ACM Newsletter</h3>
 
    <fieldset style="width:1050px;">
      <legend>Newsletter
      </legend><ul>
        <li>
          <label for="title">
            <input type="text" id="title" name="name" onClick="if (this.value == 'Newsletter Title') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Newsletter Title'; }" value="Newsletter Title">
          </label>
        </li>
        <li>
          <label for="blog.editor">
            <textarea cols="" rows="" id="blog.editor" name="message"> </textarea>
          </label>
        </li>
        <li></li>
      </ul>
    </fieldset>
    <ul class="submission">
      <li>
        <input type="submit" name="submit" value="Save Newsletter"></li>
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