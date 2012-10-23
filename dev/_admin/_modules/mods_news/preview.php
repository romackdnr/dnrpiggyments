<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Newsletter.php";
include   "../../../classes/Contact.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   
?>
<?
   if(isset($_POST['submit'])) {
   		$email = $_POST['email'];
		$ctr="";
		
		if($email == '0') {$success = "Please select your email address";$ctr=1;}
		
		
		if($ctr=="") {
		
		$id = $_REQUEST['id'];
		$newsletter = Newsletter::findNewsletter($id);
		$content = stripslashes($newsletter->fldNewsletterDescription);	
		$title = stripslashes($newsletter->fldNewsletterName);		
		if($email=='all') {			  
			  //$status = "Active";					
			  $contact = Contact::displayAll();
			  require("includes/class.phpmailer.php");
			  $mail = new PHPMailer();
				
			foreach($contact as $contacts) {		 
				$to = $contacts->fldContactEmail;	
				$name = $contacts->fldContactName;								
				$from = "info@piggyments.com";
				$mail->From = $from;
				$mail->FromName = "Piggyments";
				$mail->AddAddress($to);
				$mail->IsHTML(true); // set email format to HTML
				$all_html = implode('',file($ROOT_URL.'_admin/_modules/mods_news/newsletter.php'));
				
				$all_html = str_replace("%%title%%", $title, $all_html);
				$all_html = str_replace("%%content%%", $content, $all_html);
				$all_html = str_replace("%%name%%", $name, $all_html);
											
				//name of client						 																														
				$mail->Subject = "Newsletter";
				//$alt_body = $_POST['body'];
				$mail->Body    = $all_html;
				//$mail->AltBody = $alt_body;
				if($mail->Send()){
				$mail->ClearAddresses();
				}
				sleep(1);
			  }	
			  
			
		} else {
				require("includes/class.phpmailer.php");
			    $mail = new PHPMailer();
				
				$contact=Contact::findEmail($email);
				$name = $contact->fldContactName;
				
			    $to = $email;								
				//$name = $contact->name;								
				$from = "info@piggyments.com";
				$mail->From = $from;
				$mail->FromName = "Piggyments";
				$mail->AddAddress($to);
				$mail->IsHTML(true); // set email format to HTML
				$all_html = implode('',file($ROOT_URL.'_admin/_modules/mods_news/newsletter.php'));
				
				$all_html = str_replace("%%title%%", $title, $all_html);
				$all_html = str_replace("%%content%%", $content, $all_html);
				$all_html = str_replace("%%name%%", $name, $all_html);
											
				//name of client						 																														
				$mail->Subject = "Newsletter";
				//$alt_body = $_POST['body'];
				$mail->Body    = $all_html;
				//$mail->AltBody = $alt_body;
				if($mail->Send()){
				$mail->ClearAddresses();
				}
			    
			}
			
			$success = "Newsletter successfully sent";
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
   <? $newsletter = Newsletter::findNewsletter($_REQUEST['id']); ?>
    <fieldset style="width:1050px;">
      <legend>Newsletter
      </legend><ul>
        <li>
          <label for="email_address">Email Address</label>          
        	<select name="email">
            	<option value="0">Select email address</option>
            	<option value="all">Select All</option>
                <? 
					$contact = Contact::displayAll();
					foreach($contact as $contacts) {
				?>
                <option value="<?=$contacts->fldContactEmail?>"><?=$contacts->fldContactEmail?> (<?=$contacts->fldContactName?>)</option>
                <? } ?>
            </select>
        </li>    
        <li>
          <?=$newsletter->fldNewsletterName?>
        </li>
        <li> <?=$newsletter->fldNewsletterDescription?></li>
        <li></li>
      </ul>
    </fieldset>
    <ul class="submission">
      <li>
        <input type="submit" name="submit" value="Send Newsletter"></li>
      <li></li>
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