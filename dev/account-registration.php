<?php include 'manager/_pi/base.php'; ?>
<?

	if(isset($_POST['register'])) {


		$email = $_POST['email'];
		$password = $_POST['password'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$username = $_POST['username'];

		$ctr="";

		
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
 			 require("includes/class.phpmailer.php");
			 $mail = new PHPMailer();
			 
			 $to = $email;
			 $name_from = "Piggyments";
			 $mail->From = "info@piggyments.com";
			 $mail->FromName = $name_from;
			 $emailto = $to;

			 
			 $mail->AddAddress($emailto);
			 $mail->IsHTML(true); // set email format to HTML
			 $all_html = implode('',file('includes/client_email.php'));

			

			 $all_html = str_replace("%%username%%", $username, $all_html);
			 $all_html = str_replace("%%password%%", $password, $all_html);

			 $all_html = str_replace("%%firstname%%", $firstname, $all_html);
			 $all_html = str_replace("%%lastname%%", $lastname, $all_html);			
			 $all_html = str_replace("%%email%%", $email, $all_html);

			 $mail->Subject = "Welcome to Piggyments";

			  //$alt_body = $_POST['body'];
			 $mail->Body    = $all_html;
		
			  //$mail->AltBody = $alt_body;

			 if($mail->Send()){
				 $mail->ClearAddresses();
			 }
			 
			 //send email to owner
				 
			 //$to = "info@redandwhitemarketing.com";
			 $to = "test1@dogandrooster.net";
			 $name_from = "Piggyments";
			 $mail->From = $email;
			 $mail->FromName = $name;
			 $emailto = $to;

			 
			 $mail->AddAddress($emailto);
			 $mail->IsHTML(true); // set email format to HTML
			 $all_html = implode('',file('includes/client_email.php'));

			

			 $all_html = str_replace("%%username%%", $username, $all_html);
			 $all_html = str_replace("%%password%%", $password, $all_html);

			 $all_html = str_replace("%%firstname%%", $firstname, $all_html);
			 $all_html = str_replace("%%lastname%%", $lastname, $all_html);			
			 $all_html = str_replace("%%email%%", $email, $all_html);

			 $mail->Subject = 'New Client';

			  //$alt_body = $_POST['body'];
			 $mail->Body    = $all_html;
		
			  //$mail->AltBody = $alt_body;

			 if($mail->Send()){
				 $mail->ClearAddresses();
			 }
			 
			
			$_SESSION['client_id']	 = $client_id;
			$xclient = session_id();
			$condition = "fldTempCartClientID='$xclient'";
				if(TempCart::countTempcartbyCondition($condition)>=1) {

					//change the client id
					TempCart::updateTempcartClient($_SESSION['client_id'],$xclient);
					$links = $ROOT_URL.'billing-info.html';
					header("Location: $links");
				} else {				
					$links = $ROOT_URL.'thankyou.html';
					header("Location: $links");		
				}

			
		}

	}

?>




	<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Create Account</h1>
      <hr />
    </hgroup>

    <ul class='accountRegistration'>
      <li id=account_login>
       <?
			if(isset($error)) {
		?>
        	<div class="error"><?=$error?></div>
        <? } ?>
      <form action="" method="post" class=multiform>
        <h3><img src="<?=$root?>assets/images/icons/icon_page_white.gif" width="16" height="16" alt=""> New Customers</h3>
        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>                         
          <dl>
            <dt><label>Last name *</label>
              <input type="text" name="lastname" class=:required size="50"></dt>
            <dt><label>First name *</label>
              <input type="text" name="firstname" class=:required size="50"></dt>   
            <dt><label>Email Address *</label>
              <input type="text" name="email" class=:required :email size="50"></dt> 
            <dt><label>Username *</label>
              <input type="text" name="username" class=:required  size="50"></dt>     
            <dt><label>Password *</label>
              <input type="password" name="password" class=:required size="50"></dt>  
         
          </dl>
          <button type="submit" class=btn_submit name="register">Register</button>
        </form>
      </li>
      
    </ul>
  </article>
	<? endblock() //end section ?>





<? startblock('headercodes') ?>
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>
head.js('assets/js/jvalidates.min.js');
head.ready(function() {

  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

});
<? endblock() //end extracodes ?>
