<?
	if(isset($_POST['submit_register'])) {
		
		$address = $_POST['address'];
		$address1 = $_POST['address1'];
		$city = $_POST['city'];
		$state_valid = $_POST['state'];
		$zip = $_POST['zip'];
		$contact = $_POST['contact_no'];
		$country_code = $_POST['country'];
		$email = $_POST['email_address'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$phone = $_POST['phone'];
		
		$ctr="";
		
		if($lastname == ""){$lastname_error = "Please enter your lastname";$ctr=1;}
		if($firstname == ""){$firstname_error = "Please enter your firstname";$ctr=1;}
		if($contact == ""){$contact_error = "Please enter your contact no";$ctr=1;}
		if($address == ""){$address_error = "Please enter your address";$ctr=1;}
		if($city == ""){$city_error = "Please enter your city";$ctr=1;}
		if($zip == ""){$zip_error = "Please enter your zip";$ctr=1;}
		if(!checkEmail($email)) {$email_error = "Please enter your valid email address";$ctr=1;}
		if($email != $email1){$email1_error = "Email Address and Verify Email Address is not identical";$ctr=1;}
		if($username == ""){$username_error = "Please enter your username";$ctr=1;}
		if($password == ""){$password_error = "Please enter your password";$ctr=1;}
		if($password != $password1){$password1_error = "Password and Verify Password is not identical";$ctr=1;}
		
		if($state_valid == "0"){$error = "Please select your state";$ctr=1;}

		if(Client::countClientEmail($email)==1) {
			$error = "Email Address already in used";$ctr=1;
		}
		
		if(Client::countClientUsername($username)==1) {
			$error = "Username already in used";$ctr=1;
		}
		
		if($ctr=="") {
			//save customer information and send confirmation email
			$_POST = sanitize($_POST);
		    $client = $_POST;
		    settype($client,'object');
			$client_id = Client::addClient($client); 
			
			//send email to client
			$name = $contact_person ;
 			 require("includes/class.phpmailer.php");
			 $mail = new PHPMailer();
			 $email_from = "info@dermalfx.com";
			 $name_from = "DermalFx";
			 $mail->From = $email_from;
			 $mail->FromName = $name_from;
			 $emailto = $email;
			 
			 $mail->AddAddress($emailto);
			 $mail->IsHTML(true); // set email format to HTML
			 $all_html = implode('',file('includes/client_email.php'));
			
			 
			 $all_html = str_replace("%%username%%", $username, $all_html);
			 $all_html = str_replace("%%phone%%", $phone, $all_html);
			 $all_html = str_replace("%%password%%", $password, $all_html);
			 $all_html = str_replace("%%firstname%%", $firstname, $all_html);
			 $all_html = str_replace("%%lastname%%", $lastname, $all_html);			
			 $all_html = str_replace("%%address%%", $address, $all_html);
			 $all_html = str_replace("%%address1%%", $address1, $all_html);
			 $all_html = str_replace("%%city%%", $city, $all_html);
			 $all_html = str_replace("%%state%%", $state_valid, $all_html);
			 $all_html = str_replace("%%country%%", $country_code, $all_html);
			 $all_html = str_replace("%%zip%%", $zip, $all_html);
			 $all_html = str_replace("%%email%%", $email, $all_html);
			 
			 
			 
			 $mail->Subject = 'Welcome to dermalfx.com';
			  //$alt_body = $_POST['body'];
			 $mail->Body    = $all_html;
			 
			  //$mail->AltBody = $alt_body;
			 if($mail->Send()){}
			
			$_SESSION['client_id']	 = $client_id;
			$xclient = session_id();
			$condition = "fldTempCartClientID='$xclient'";
				if(TempCart::countTempcartbyCondition($condition)>=1) {
					//change the client id
					TempCart::updateTempcartClient($_SESSION['client_id'],$xclient);
					$links = $ROOT_URL.'billing-info/';
					header("Location: $links");
				} else {				
					$links = $ROOT_URL.'thankyou/';
					header("Location: $links");		
				}
			
			 
		}
	}
?>
<form method="post" action="<? $PHP_SELF;?>">
<table width="56%" border="0" cellspacing="1" cellpadding="1">
 
   <? if(isset($error)) { ?>
   <tr>
	   <td class="error"><?=$error?></td>
   </tr>                	                    
   <? } ?>
  <tr>
    <td colspan="3"><table width="559" border="0" cellspacing="1" cellpadding="1">
     
      <tr>
        <td height="35">Last name</td>
        <td height="35">:</td>
        <td height="35"><input name="lastname" type="text" class="validate[required,length[0,100]] text-input" id="contact_person" value="<?=$lastname?>" size="35">
        <? if(isset($lastname_error)) { ?>
        	<div class="error"><?=$lastname_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
      <tr>
        <td height="35">First name</td>
        <td height="35">:</td>
        <td height="35"><input name="firstname" type="text" class="validate[required,length[0,100]] text-input" id="contact_person" value="<?=$firstname?>" size="35">
          <? if(isset($firstname_error)) { ?>
        	<div class="error"><?=$firstname_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
        <td height="35">Contact No</td>
        <td height="35">:</td>
        <td height="35"><input name="phone" type="text" class="validate[required,custom[telephone]] text-input" id="contact_no" value="<?=$contact?>" size="35">
         <? if(isset($contact_error)) { ?>
        	<div class="error"><?=$contact_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
        <td height="35">Address</td>
        <td height="35">:</td>
        <td height="35"><input name="address" type="text" class="validate[required,length[0,100]] text-input" id="address" value="<?=$address?>" size="35">
         <? if(isset($address_error)) { ?>
        	<div class="error"><?=$address_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
        <td height="35">Address 1</td>
        <td height="35">:</td>
        <td height="35"><input name="address1" type="text" id="address1" value="" size="35"></td>
      </tr>
      <tr>
        <td height="35">City</td>
        <td height="35">:</td>
        <td height="35"><input name="city" type="text" class="validate[required,length[0,100]] text-input" id="city" value="<?=$city?>" size="35">
          <? if(isset($city_error)) { ?>
        	<div class="error"><?=$city_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
        <td height="35">State</td>
        <td height="35">:</td>
        <td height="35">
        <select name ="state" class="select_state">
                	
                	<? 
						$state = State::findAll();
						foreach($state as $states) {
								if($states->tStateID == 'CA') { 
					?>                    		
                        			<option value="<?=$states->tStateID?>" selected="selected"><?=$states->tStateName?></option>
                      			<? } else { ?>
                                	<option value="<?=$states->tStateID?>"><?=$states->tStateName?></option>
                                <? } ?>
                    <? } ?>
                    
                </select>
        </td>
      </tr>
      <tr>
        <td height="35">Country</td>
        <td height="35">:</td>
        <td height="35">
        <select name ="country" class="select_text">                	
                	<? 
						$country = Country::findAll();
						foreach($country as $countries) {
							if($countries->country_code == 'US') { 
					?>
                    		<option value="<?=$countries->country_code?>" selected="selected"><?=$countries->country_name?></option>
                        <? } else { ?>
                        	<option value="<?=$countries->country_code?>"><?=$countries->country_name?></option>
                        <? } ?>
                    <? } ?>
                </select>
        </td>
      </tr>
      <tr>
        <td height="35">Zip</td>
        <td height="35">:</td>
        <td height="35">
        <input name="zip" type="text" class="validate[required,custom[onlyNumber],length[0,5]] text-input" id="zip" value="<?=$zip?>" size="35">
         <? if(isset($zip_error)) { ?>
        	<div class="error"><?=$zip_error?></div>
        <? } ?>
        </td>
      </tr>
     
      <tr>
        <td height="35">Email Address</td>
        <td height="35">:</td>
        <td height="35">
        <input name="email_address" type="text" class="validate[required,custom[email]] text-input" id="email" value="<?=$email?>" size="35">
          <? if(isset($email_error)) { ?>
        	<div class="error"><?=$email_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
        <td height="35">Confirm Email Address</td>
        <td height="35">:</td>
        <td height="35">
        <input name="email1" type="text" class="validate[required,confirm[email]] text-input" id="email1" value="<?=$email1?>" size="35">
        <? if(isset($email1_error)) { ?>
        	<div class="error"><?=$email1_error?></div>
        <? } ?>
        </td>
      </tr>
       <tr>
        <td height="35">Username</td>
        <td height="35">:</td>
        <td height="35">
        <input name="username" type="text" class="validate[required,custom[onlyNumber],length[0,5]] text-input" id="username" value="<?=$username?>" size="35">
          <? if(isset($username_error)) { ?>
        	<div class="error"><?=$username_error?></div>
        <? } ?>
        </td>
      </tr>
       <tr>
        <td height="35">Password</td>
        <td height="35">:</td>
        <td height="35">
        <input name="password" type="password" class="validate[required,length[0,250]] text-input" id="password" value="<?=$password?>" size="35">
         <? if(isset($password_error)) { ?>
        	<div class="error"><?=$password_error?></div>
        <? } ?>
        </td>
      </tr>
       <tr>
        <td height="35">Confirm Password</td>
        <td height="35">:</td>
        <td height="35">
        <input name="password1" type="text" class="validate[required,confirm[password]] text-input" id="password1" value="<?=$password1?>" size="35">
         <? if(isset($password1_error)) { ?>
        	<div class="error"><?=$password1_error?></div>
        <? } ?>
        </td>
      </tr>
      <tr>
        <td height="35" colspan="3" align="center">
          <input type="submit" value="Register &rarr;" name="submit_register">
          </td>
      </tr>
    </table></td>
  </tr>
  </table>
</form>