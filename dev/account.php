<?php include 'manager/_pi/base.php'; ?>
<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];
		$links = $ROOT_URL.'billing-info.html';
		header("Location: $links");	
	} else {
		$client_id = session_id();
	}
?>
<?
	
	
	if(isset($_POST['login'])) {			
		//check if the login information is valid
		$_POST = sanitize($_POST);
		$client = $_POST;
		settype($client,'object');
		if(Client::checkLogin($client)==1) {
			    $clients = Client::getInfo($client);			
				$_SESSION['client_id']	 = $clients->fldClientID;	
				$xclient = session_id();
				$condition = "fldTempCartClientID='$xclient'";
				if(TempCart::countTempcartbyCondition($condition)>=1) {
					//change the client id
					TempCart::updateTempcartClient($_SESSION['client_id'],$xclient);
					$links = $ROOT_URL.'billing-info.html';
					header("Location: $links");					
				} else {				
					$links = $ROOT_URL;
					header("Location: $links");			
				}
		} else {		
			$error = "Invalid username or password";
		}
	}
?>




	<? startblock('section') ?>
  <aside>
     <?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Login or Create Account</h1>
      <hr />
    </hgroup>

    <ul class='account_info col1'>
      <li id=account_login>
        <h3><img src="<?=$root?>assets/images/icons/icon_page_white.gif" width="16" height="16" alt=""> New Customers</h3>
        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
        
        <div class='button_layer right'><a href="<?=$root?>registration.html" class=ui_btn>Create an Account</a></div>
      </li>
      <li id=account_register class=last>
       
        <form action="" method="post" class=multiform>
          <h3><img src="<?=$root?>assets/images/icons/icon_page_white_text.gif" width="16" height="16" alt=""> Registered Customers</h3>
          <p>If you have an account with us, please log in.</p>
          <dl>
            <dt><label>Username *</label>
              <input type="text" name="username" class=:required size="50"></dt>
            <dt><label>Password *</label>
              <input type="password" name="password" class=:required size="50"></dt>
              
          </dl>
           <?
			if(isset($error)) {
		?>
        	<div class="error"><?=$error?></div>
        <? } ?>
          <button type="submit" class=btn_submit name="login">Login</button>
        </form>
        <div class='button_layer left'><a href="<?=$root?>forgot-password.html" class=ui_txt>Forgot Username / Password?</a></div>
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
