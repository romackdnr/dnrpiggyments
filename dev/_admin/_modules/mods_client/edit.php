<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Client.php";
include   "../../../classes/State.php";
include   "../../../classes/Country.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
include   "../../../functions/myFunctions.php";

if(isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email_address'];
	
	if($firstname == ""){$firstname_error = "Please enter your firstname";$ctr=1;}
	if($lastname == ""){$lastname_error = "Please enter your lastname";$ctr=1;}
	
	if($ctr=="") { 
	 $_POST = sanitize($_POST);
      $client = $_POST;
	  settype($client,'object');
	  Client::updateClient($client); 
	  $success = "Client Successfully Saved!";
	  
	   $updates = 'Update clients content';
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
	  	<li><a href="<?=$ROOT_URL?>_admin/modules_client/view/">Back</a></li>
    </ul>    
</div>    
<? $client = Client::findClient($_REQUEST['id']); ?>
  <form id="blog_page" action="<? $PHP_SELF; ?>" method="post">
    <h3>ACM Clients</h3>
    <fieldset style="width:1050px;">
      <legend>Clients Panel</legend>
      <ul>
        <li>
          <label for="title">First name</label>
           <input type="text" id="title" name="firstname" value="<?=stripslashes($client->fldClientFirstName)?>">   
           <? if(isset($firstname_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$firstname_error?></b></div>
           <? } ?>
        </li>
         <li>
          <label for="title">Last name</label>
           <input type="text" id="title" name="lastname" value="<?=stripslashes($client->fldClientLastname)?>">   
           <? if(isset($lastname_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$lastname_error?></b></div>
           <? } ?>
        </li>
        <li>
          <label for="email">Email</label>
           <input type="text" id="email" name="email_address" value="<?=$client->fldClientEmail?>">   
            <? if(isset($email_error)) { ?>      
           		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00"><b><?=$email_error?></b></div>
           <? } ?>      
        </li>
        <li>
          <label for="address">Address</label>
           <input type="text" id="address" name="address" value="<?=stripslashes($client->fldClientAddress)?>">         
        </li>
        <li>
          <label for="address1">Address 1</label>
           <input type="text" id="address1" name="address1" value="<?=stripslashes($client->fldClientAddress1)?>">         
        </li>
         <li>
          <label for="city">City</label>
           <input type="text" id="city" name="city" value="<?=stripslashes($client->fldClientCity)?>">         
        </li>
        <li>
          <label for="state">State</label>
           <select name ="state" class="select_state">
                	
                	<? 
						$state = State::findAll();
						foreach($state as $states) {
								if($states->tStateID == $client->fldClientState) { 
					?>                    		
                        			<option value="<?=$states->tStateID?>" selected="selected"><?=$states->tStateName?></option>
                      			<? } else { ?>
                                	<option value="<?=$states->tStateID?>"><?=$states->tStateName?></option>
                                <? } ?>
                    <? } ?>
                    
                </select>
        </li>
          <li>
          <label for="state">Country</label>
              <select name ="country" class="select_text">                	
                	<? 
						$country = Country::findAll();
						foreach($country as $countries) {
							if($countries->country_code == $client->fldClientCountry) { 
					?>
                    		<option value="<?=$countries->country_code?>" selected="selected"><?=$countries->country_name?></option>
                        <? } else { ?>
                        	<option value="<?=$countries->country_code?>"><?=$countries->country_name?></option>
                        <? } ?>
                    <? } ?>
                </select>
        </li>
          <li>
          <label for="zip">Zip Code</label>
           <input type="text" id="zip" name="zip" value="<?=stripslashes($client->fldClientZip)?>">         
        </li>
         <li>
          <label for="phone">Contact Number</label>
           <input type="text" id="phone" name="phone" value="<?=stripslashes($client->fldClientPhoneNo)?>">         
        </li>
      
  
      </ul>
    </fieldset>
    <ul class="submission">
    <input type="hidden" name="Id" value="<?=$client->fldClientID?>">
      <li><input type="submit" name="submit" value="Save Clients"></li>
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