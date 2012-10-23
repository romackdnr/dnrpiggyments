<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];
		$links = $ROOT_URL.'billing-info/';
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
					$links = $ROOT_URL.'billing-info/';
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

<div id="ecom_login">
        	<h3>Login or Create an Account</h3>
        	<div class="ebox">
          	<h4>New Customers</h4>
            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
            
            <a href="<?=$ROOT_URL?>register/" name="create">create an account</a>    
            <br />
			<a href="<?=$ROOT_URL?>quick-checkout/" name="checkout">Quick Checkout</a>            
          </div>
          <form class="eform" action="<? $PHP_SELF; ?>" method="post">
          	<h4>Registered Customers</h4>
            <p>If you have an account with us, please log in.</p>
            <? if(isset($error)) { ?>
            	<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold"><?=$error?></p>
            <? } ?>
            <ul>
            	<li><label><strong>Username</strong> *</label> <input type="text" name="username" class="validate[required,custom[email]] text-input"></li>
              <li><label><strong>Password</strong> *</label> <input type="password" name="password" class="validate[required,length[6,11]] text-input"></li>
            </ul>
            <p class="smaller right" title="required">* Required Fields</p>
            <div class="right"><a href="<?=$ROOT_URL?>forgot-password/">Forgot Username or Password?</a> <input type="submit" name="login" value="Login"></div>            
          </form>
        </div>