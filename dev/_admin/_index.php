<?php include '_manager/box_header/login.php' ?>
<?
	if(isset($_POST['login'])) {
		$_POST = sanitize($_POST);
		$administrator = $_POST;
		settype($administrator,'object');
		$login = Administrator::findAdministratorLogin($administrator); 
		if(empty($login)) {
			$error = "User access not found.";
		} else {
			$_SESSION['admin_id'] = $login->fldAdministratorID;
			$_SESSION['admin_name'] = $login->fldAdministratorRealName;
			header("Location: overview.php");
		}
	}
?>


	<?php startblock('section') ?> 

	<!-- /Template Start Here -->
  <figure>
  
  <form action="<? $PHP_SELF; ?>" method="post" id="security_login" name="security_login">
  		
      <div class="label">Sign in to</div>
      <h2>Name of the Admin Site</h2>
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
      <input type="checkbox" id="cb" name="cb" checked value="rememberme"> Remember me on this computer.
      </fieldset>
      
      <button type="submit" id="login" name="login">Sign in</button>
      
  </form>  
  <div align="center">Copyright 2010. Dog and Rooster, Inc.</div>
  
  </figure>
	<!-- /Template End Here -->
  
  <footer>
  	forgot your password? <a id="clickme" name="Recover Your Password Now!">click here</a>
    <form action="" method="post" class="recover">
    	<input type="text" name="password" onClick="if (this.value == 'Enter your Email Address') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Enter your Email Address'; }" value="Enter your Email Address">
      <button type="submit"> Recover Password </button>
    </form>
  </footer>
  
  <?php endblock() //End of Section ?>



<?php startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" media="screen" href="_assets/css/jgrowl.css" />
<?php endblock() //End of Header Codes ?>

<?php startblock('extracodes') ?> 
<script type="text/javascript" src="_assets/js/jquery.js"></script>
<script type="text/javascript" src="_assets/js/jgrowl.js"></script>
<script type="text/javascript" src="_assets/js/jlabel.js"></script>
<script type="text/javascript" src="_assets/js/jsmanager.js"></script>

<script type="text/javascript" src="_assets/js/cufon.js"></script>
<script type="text/javascript" src="_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2');
</script>
<?php endblock() //End of Extra Codes ?>
