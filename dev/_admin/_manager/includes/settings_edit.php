<?
	if(isset($_POST['submit'])) {
			
			$_POST = sanitize($_POST);
		    $adminstrator = $_POST;
		    settype($adminstrator,'object');
			Administrator::updateAdministratorSite($adminstrator); 
			$success = "Administrator Successfully Saved!";
			
			$updates = 'Add New Administrator Content';
			AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
?>
		<? if(isset($success)) { ?>
            <div class="alert"> Administrator Successfully Saved! </div>
        <? } ?>    
		<? 
			$admin  = Administrator::findAdministrator($_REQUEST['id']);
		?>
            <form id="form_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
            
              <fieldset>
                <legend>Update Administrator</legend>
                <ul>
                  <li><label for="page_name"> Username: </label>
                    <input type="text" id="page_name" name="username" value="<?=stripslashes($admin->fldAdministratorusername)?>"></li>
                  
                  <li><label for="password"> Password: </label>
                    <input type="password" id="password" name="password"></li>   
                  
                  <li><label for="real_name"> Real Name: </label>
                    <input type="text" id="real_name" name="real_name" value="<?=stripslashes($admin->fldAdministratorRealName)?>"></li> 
                    <li><label for="email"> Email Address: </label>
                    <input type="text" id="email" name="email" value="<?=stripslashes($admin->fldAdministratorEmail)?>"></li> 
                </ul>
              </fieldset>
              
             	<input type="hidden" name="Id" value="<?=$admin->fldAdministratorID?>" />
              
              <div class="iecol1 center"><button type="submit" name="submit">Save Administrator</button></div>
              
            </form>
