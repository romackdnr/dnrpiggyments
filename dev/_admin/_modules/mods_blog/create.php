<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Blogs.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

if(isset($_POST['submit'])) {
	 $_POST = sanitize($_POST);
      $blogs = $_POST;
	  settype($blogs,'object');
	  Blogs::addBlogs($blogs); 
	  $success = "Blogs Successfully Published!";
	  
	  $updates = 'Add new blogs content';
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
<div id="blog_overview">
	<ul class="btn">
	  	<li><a href="<?=$ROOT_URL?>_admin/modules_blogs/view/">Back</a></li>
    </ul>    
</div>    
  <form id="blog_page" action="<? $PHP_SELF; ?>" method="post">
    <h3>ACM Blog</h3>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    <fieldset style="width:1050px;">
      <legend>Blog Panel</legend>
      <ul>
        <li>
          <label for="title">
            <input type="text" id="title" name="name" onClick="if (this.value == 'Blog Title') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Blog Title'; }" value="Blog Title">
          </label>
        </li>
        <li>
          <label for="blog.editor">
            <textarea cols="" rows="" id="blog.editor" name="description"> </textarea>
          </label>
        </li>
        <li>
          <label for="author">Author</label>
          <input type="text" id="author" name="author">
        </li>
        <li>
          <label for="tag">Post Tags</label>
          <input type="text" id="tag" name="tags">
        </li>
        <li>
          <label for="category">Post Category</label>
          <input type="text" id="category" name="category">
        </li>
      </ul>
    </fieldset>
    <ul class="submission">
      <li><button type="submit" name="submit">Publish Blog</button></li>
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