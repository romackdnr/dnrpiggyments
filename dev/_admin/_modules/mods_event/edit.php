<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/News.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

if(isset($_POST['submit'])) {
	 $_POST = sanitize($_POST);
      $news = $_POST;
	  settype($news,'object');
	  News::updateNews($news); 
	  $success = "News Successfully Changed!";
	  
	  $updates = 'Update news and events content';
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
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_event/js/tiny.mods.js"></script>
</head>

<body>
	<? if(isset($success)) { ?>
		<div class="alert"> <?=$success?> </div>
    <? } ?>    

<? $news = News::findNews($_REQUEST['id']); ?>
<div id="blog_overview">
	<ul class="btn">
	  	<li><a href="<?=$ROOT_URL?>_admin/modules_news/view/">Back</a></li>
    </ul>    
</div> 

  <form id="blog_page" action="<? $PHP_SELF; ?>" method="post">
    <h3>ACM News</h3>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    <fieldset style="width:1050px;">
      <legend>News Panel</legend>
      <ul>
        <li>
          <label for="title">
            <input type="text" id="title" name="name" onClick="if (this.value == 'News Title') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'News Title'; }" value="<?=stripslashes($news->fldNewsTitle)?>">
          </label>
        </li>
        <li>
          <label for="blog.editor">
            <textarea cols="" rows="" id="blog.editor" name="description"><?=stripslashes($news->fldNewsDescription)?></textarea>
          </label>
        </li>
        <li>
        	News Date : <input name="date_news" type="text" id="date_news" value="<?=$news->fldNewsDate?>" /> eg. Y-m-d
              
        </li>
      </ul>
    </fieldset>
    <ul class="submission">
    	<input type="hidden" name="Id" value="<?=$news->fldNewsID?>">
      <li><input type="submit" name="submit" value="Publish News"></li>
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