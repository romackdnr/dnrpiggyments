<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Testimonials.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

if(isset($_POST['submit'])) {
	 $_POST = sanitize($_POST);
      $testimonials = $_POST;
	  settype($testimonials,'object');
	  Testimonials::updateTestimonials($testimonials); 
	  $success = "testimonials Successfully saved!";
	  
	   $updates = 'Update testimonials content';
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
  
  
</head>

<body>
	<? if(isset($success)) { ?>
		<div class="alert"> <?=$success?> </div>
    <? } ?>    
<div id="blog_overview">
	<ul class="btn">
	  	<li><a href="<?=$ROOT_URL?>_admin/modules_testimonials/view/">Back</a></li>
    </ul>    
</div>    
<? $testi = Testimonials::findTestimonials($_REQUEST['id']); ?>
  <form id="blog_page" action="<? $PHP_SELF; ?>" method="post">
    <h3>ACM Testimonials</h3>
    <fieldset style="width:1050px;">
      <legend>News Panel</legend>
      <ul>
        <li>
          <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?=stripslashes($testi->fldTestimonialsName)?>">
        </li>
        <li>
          <label for="description">
            <textarea cols="" rows="" id="description" name="description"><?=stripslashes($testi->fldTestimonialsDescription)?></textarea>
          </label>
        </li>
        <li>
        	<label id="website">Website</label>
            <input type="text" id="website" name="website" value="<?=$testi->fldTestimonialsWebsite?>">
              
        </li>
      </ul>
    </fieldset>
    <ul class="submission">
      <input type="hidden" name="Id" value="<?=$_REQUEST['id']?>">
      <li><input type="submit" name="submit" value="Save Testimonials"></li>
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