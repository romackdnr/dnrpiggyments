<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Contact.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include   "../../../functions/myFunctions.php";

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	
	if($name == ""){$name_error = "Please enter your name";$ctr=1;}
	if(!checkEmail($email)) {$email_error = "Please enter your valid email address";$ctr=1;}
	
	if($ctr=="") { 
	 $_POST = sanitize($_POST);
      $contact = $_POST;
	  settype($contact,'object');
	  Contact::updateContact($contact); 
	  $success = "Contacts Successfully Saved!";
	  
	   $updates = 'Update contacts content';
  	  AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
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
<div id="blog_overview">
	<ul class="btn">
	  	<li><a href="<?=$ROOT_URL?>_admin/modules_contact/view/">Back</a></li>
    </ul>    
</div>    
<? $contact = Contact::findContact($_REQUEST['id']); ?>
  <form id="blog_page" action="<? $PHP_SELF; ?>" method="post">
    <h3>ACM Contacts</h3>
    <fieldset style="width:1050px;">
      <legend>Contacts Panel</legend>
      <ul>
        <li>
          <label for="title">Name</label>
           <input type="text" id="title" name="name" value="<?=stripslashes($contact->fldContactName)?>">   
           <? if(isset($name_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$name_error?></b></div>
           <? } ?>
        </li>
        <li>
          <label for="email">Email</label>
           <input type="text" id="email" name="email" value="<?=$contact->fldContactEmail?>">   
            <? if(isset($email_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$email_error?></b></div>
           <? } ?>      
        </li>
       <li>
          <label for="subject">Address</label>
           <input type="text" id="address" name="address" value="<?=stripslashes($contact->fldContactAddress)?>">         
        </li>
        <li>
          <label for="subject">City / State</label>
           <input type="text" id="city" name="city" value="<?=stripslashes($contact->fldContactCity)?>">         
        </li>
          <li>
          <label for="subject">Postal Code</label>
           <input type="text" id="zip" name="zip" value="<?=stripslashes($contact->fldContactZip)?>">         
        </li>
        <li>
          <label for="phone">Phone</label>
           <input type="text" id="phone" name="phone" value="<?=stripslashes($contact->fldContactPhone)?>">         
        </li>

        <li>
          <label for="blog.editor">
            <textarea cols="" rows="" id="blog.editor" name="comments"><?=stripslashes($contact->fldContactMessage)?></textarea>
          </label>
        </li>
  
      </ul>
    </fieldset>
    <ul class="submission">
    <input type="hidden" name="Id" value="<?=$contact->fldContactID?>">
      <li><input type="submit" name="submit" value="Save Contacts"></li>
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