<? 
	if(isset($_POST['submit'])) {
			$_POST = sanitize($_POST);
		    $admin = $_POST;
		    settype($admin,'object');
			Administrator::addAdministratorSite($admin); 
			$success = "Administrator Successfully Saved!";
	}
	
	if(isset($_POST['update'])) {
			$_POST = sanitize($_POST);
		    $admin = $_POST;
		    settype($admin,'object');
			Administrator::updateAdministratorSite($admin); 
			$success = "Administrator Successfully Changed!";
	}
	
	$administrator = Administrator::findAdministratorClient();
?>					
  <? if(isset($success)) { ?>	
        <div class="alert"> <?=$success?> </div>
  <? } ?>      
        
        <form id="profile_page" action="<? $PHP_SELF; ?>" method="post">
        
        <fieldset class="col1" style="width:47%;">
          <legend>Personal Profile</legend>
          <ul>
            <li><label> Full Name: </label>
              <input type="text" id="field[]" name="real_name" value="<?=$administrator->fldAdministratorRealName?>"></li>
            <li><label> Username: </label>
              <input type="text" id="field[]" name="username" value="<?=$administrator->fldAdministratorusername?>"></li>
            <li><label> Password: </label>
              <input type="text" id="field[]" name="password"></li>
            <li><label> Email: </label>
              <input type="text" id="field[]" name="email" value="<?=$administrator->fldAdministratorEmail?>"></li>
            <li><label> Phone: </label>
              <input type="text" id="field[]" name="phone" value="<?=$administrator->fldAdministratorPhone?>"></li>
          </ul>
        </fieldset>
        
        <fieldset class="col2" style="width:47%;">
          <legend>Contact &amp; Networks Info</legend>
          <ul>
            <li><label> Site Name: </label>
              <input type="text" id="field[]" name="sitename" value="<?=$administrator->fldAdministratorSitename?>"></li>
            <li><label> Blog: </label>
              <input type="text" id="field[]" name="blog" value="<?=$administrator->fldAdministratorBlog?>"></li>
            <li><label> Facebook: </label>
              <input type="text" id="field[]" name="facebook" value="<?=$administrator->fldAdministratorFaceBook?>"></li>
            <li><label> Twitter: </label>
              <input type="text" id="field[]" name="twitter" value="<?=$administrator->fldAdministratorTwitter?>"></li>
            <li><label> LinkedIn: </label>
              <input type="text" id="field[]" name="linkedin" value="<?=$administrator->fldAdministratorLinkedin?>"></li>
          </ul>
        </fieldset>
        
        <div class="hr-clear"></div>

        <fieldset style="width:1045px;">
          <legend>About Yourself/Company</legend>
          <ul>
            <li><label> Biographical Info: </label>
              <textarea cols="" rows="" name="about"><?=stripslashes($administrator->fldAdministratorAbout)?></textarea></li>
          </ul>
        </fieldset>

        <div class="iecol1 center">
        <? if(empty($administrator)) { ?>
	        <button type="submit" name="submit">Save Profile</button> &nbsp; <button type="reset">Clear Profile</button></div>
        <? } else { ?>
        	<input type="hidden" name="Id" value="<?=$administrator->fldAdministratorID?>" />
        	<button type="submit" name="update">Update Profile</button> &nbsp; <button type="reset">Clear Profile</button></div>
        <? } ?>    
        </form>
