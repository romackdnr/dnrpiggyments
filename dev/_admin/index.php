<? include '_manager/box.header/login.php' ?>
<?
	if(isset($_POST['login'])) {
		$security = $_POST['security'];
		$code = $_POST['code'];		
		if($security == $code) { 
		
				$_POST = sanitize($_POST);
				$administrator = $_POST;
				settype($administrator,'object');
				$login = Administrator::findAdministratorLogin($administrator); 
				if(empty($login)) {
					$error = "User access not found.";
				} else {
					$_SESSION['admin_id'] = $login->fldAdministratorID;
					$_SESSION['admin_name'] = $login->fldAdministratorRealName;
					$links = $ROOT_URL.'_admin/modules_pages/';
					header("Location: $links");
					
				}
		} else {
			$error = "Invalid Security Code";
		}
	}
	
	//recover your password
	if(isset($_POST['recover'])) {
		$email = $_POST['email'];
		$admin = Administrator::findAdministratorByEmail($email);
	
	if(empty($admin)) {
			$error = "Email address not on list";
	} else {
		$username = $admin->fldAdministratorusername;
		$admin_name = $admin->fldAdministratorRealName;
		$admin_id = $admin->fldAdministratorID;
		
		
		$password = "P@ssw@rd";
		//change the password
		Administrator::changePassword($admin_id,$password);
		
		//send email to owner
		require("includes/class.phpmailer.php");
  	    $mail = new PHPMailer();
				 $to = $email;	
				$name = $admin_name;
				$from = "info@redandwhitemarketing.com";	
				$mail->From = $from;
				$mail->FromName = "Red and White Marketing";
				$mail->AddAddress($to);
				$mail->IsHTML(true); // set email format to HTML
				$all_html = implode('',file('includes/change_password.php'));
				
				$all_html = str_replace("%%name%%", $admin_name, $all_html);
				$all_html = str_replace("%%username%%", $username, $all_html);
				$all_html = str_replace("%%password%%", $password, $all_html);
											
				//name of client						 																														
				$mail->Subject = "Change Password";
				//$alt_body = $_POST['body'];
				$mail->Body    = $all_html;
				//$mail->AltBody = $alt_body;
				if($mail->Send()){
				$mail->ClearAddresses();
				}
				
			$error = "Password Successfully Sent";	
	
	}
	}
?>


	<? startblock('section') ?> 

	<!-- /Template Start Here -->
  <figure>
  
  <form action="<? $PHP_SELF; ?>" method="post" id="securitylogin">
  		
      <div class="label">Sign in to</div>
      <h2>Piggyments</h2>
      <? if(isset($error)) { ?>
	      <span><?=$error?></span>
      <? } ?>    
  		<fieldset>
        <p>
          <label for="un">Username</label>
          <input type="text" id="un" name="username">
        </p>
        <p>
          <label for="pw">Password</label>
					<input type="password" id="pw" name="password">
        </p>
      </fieldset>
		<input type="hidden" name="security" value="" id="security">
      <div class="captcha"><label>Enter Shown Code</label>
      	<input type="text" maxlength="7" name="code" id="code"> <script language="javascript" type="text/javascript">showImage();</script></div>
     
      <input type="submit" name="login" value="Sign in">
      
  </form>  
  <div align="center">Copyright <?=date('Y')?>. Dog and Rooster, Inc.</div>
  
  </figure>
	<!-- /Template End Here -->
  
  <footer>
  	forgot your password? <a id="clickme" name="Recover Your Password Now!">click here</a>
    <form action="<? $PHP_SELF; ?>" method="post" class="recover">
    	<input type="text" name="email" onClick="if (this.value == 'Enter your Email Address') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Enter your Email Address'; }" value="Enter your Email Address">
      <button type="submit" name="recover"> Recover Password </button>
    </form>
  </footer>
  
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" media="screen" href="_assets/css/jgrowl.css" />
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="_assets/js/jquery.js"></script>
<script type="text/javascript" src="_assets/js/jgrowl.js"></script>
<script type="text/javascript" src="_assets/js/jlabel.js"></script>
<script type="text/javascript" src="_assets/js/jsmanager.js"></script>

<script type="text/javascript" src="_assets/js/cufon.js"></script>
<script type="text/javascript" src="_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2');
</script>
<? endblock() //End of Extra Codes ?>
