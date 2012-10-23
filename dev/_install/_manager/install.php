<? 
	if(isset($_POST['submit'])) {
		//check the database connection
		$hostname = $_POST['host'];
		$dbUsername = $_POST['username'];
		$dbPassword = $_POST['password'];
		$dbName = $_POST['database_name'];
		$table_prefix = $_POST['table_prefix'];				
		$administrator_username = $_POST['administrator_username'];
		$administrator_realname = $_POST['administrator_realname'];
		$administrator_email= $_POST['administrator_email'];
		$administrator_password= $_POST['administrator_password'];
		$administrator_password1= $_POST['administrator_password1'];
		
		if($hostname == "") {$hostname_error = "Please enter your Database Hostname";$ctr=1;}
		if($dbUsername == "") {$username_error = "Please enter your Database Username";$ctr=1;}
		if($dbPassword == "") {$password_error = "Please enter your Database Password";$ctr=1;}
		if($dbName == "") {$database_error = "Please enter your Database Name";$ctr=1;}
		if($table_prefix == "") {$table_error = "Please enter your table prefix";$ctr=1;}
		if($administrator_username == "") {$administrator_username_error = "Please enter your Administrator Username";$ctr=1;}
		if($administrator_password == "") {$administrator_password_error = "Please enter your Administrator Password";$ctr=1;}
		if($administrator_realname == "") {$administrator_realname_error = "Please enter your Administrator Real Name";$ctr=1;}
		if($administrator_password != $administrator_password1) {$administrator_confirm_error = "Password and Confirm Password is not Identical";$ctr=1;}
		if(!isset($_POST['modules'])){$modules_error = "Please select your modules";$ctr=1;}
		if($ctr=="") {

		$connect = mysql_connect($hostname,$dbUsername,$dbPassword);
		$db = mysql_select_db($dbName,$connect);
		
		//CREATE A BASIC TABLE
		
		//FOR CONNECTION//
   		mysql_query("CREATE TABLE tblConnection(fldDatabaseID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(fldDatabaseID), 
													    fldDatabaseHost VARCHAR(250), 
														fldDatabaseUsername VARCHAR(250), 
														fldDatabasePassword VARCHAR(250), 
														fldDatabaseName VARCHAR(250), 
														fldTablePrefix VARCHAR(250))") or die(mysql_error());
		   //SAVE THE DATA CONNECTION
		   mysql_query("INSERT INTO tblConnection (fldDatabaseHost, fldDatabaseUsername, fldDatabasePassword, fldDatabaseName, fldTablePrefix) VALUES ('$hostname','$dbUsername','$dbPassword','$dbName','$table_prefix')");
		   
		   
		   //FOR MODULES//		   
	   		mysql_query("CREATE TABLE ".$table_prefix."_tblModules(fldModulesID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldModulesID), 
													    fldModulesName VARCHAR(250), 														
														fldModulesNameID VARCHAR(100))") or die(mysql_error());
		   
		   //FOR ADMINISTRATOR//		  		   
	   		mysql_query("CREATE TABLE ".$table_prefix."_tblAdministrator(fldAdministratorID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldAdministratorID), 
													    fldAdministratorusername VARCHAR(250), 	
														fldAdministratorRealName VARCHAR(250),														
														fldAdministratorPhone VARCHAR(250),
														fldAdministratorSitename VARCHAR(250),
														fldAdministratorBlog VARCHAR(250),
														fldAdministratorFaceBook VARCHAR(250),
														fldAdministratorTwitter VARCHAR(250),
														fldAdministratorLinkedin VARCHAR(250),
														fldAdministratorAbout TEXT,														
														fldAdministratorPassword VARCHAR(250), 	
														fldAdministratorEmail VARCHAR(250))") or die(mysql_error());
			
			 //FOR Admin Actions//		  		   
	   		mysql_query("CREATE TABLE ".$table_prefix."_tblAction(fldActionID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldActionID), 
													    fldActionUsername VARCHAR(250), 	
														fldActionUpdates VARCHAR(250),																												
														fldActionDateTime DateTime)") or die(mysql_error());
			
		   //FOR PAGES//				 
	   		mysql_query("CREATE TABLE ".$table_prefix."_tblPages(fldPagesID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldPagesID), 
													    fldPagesName VARCHAR(250), 	
														fldPagesTitle VARCHAR(250), 	
														fldPagesNavigation VARCHAR(250), 															
														fldPagesDescription TEXT, 
														fldPagesDateModified DATE, 
														fldPagesMetaTitle TEXT, 
														fldPagesMetaDescription TEXT, 													
														fldPagesGoogleMetaTags TEXT, 
														fldPagesGoogleMetaAnalytics TEXT, 
														fldPagesMetaKeywords TEXT)") or die(mysql_error());
			 //FOR CONTACT//		  		   
	   		mysql_query("CREATE TABLE ".$table_prefix."_tblContact(fldContactID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldContactID), 
													    fldContactName VARCHAR(250), 	
														fldContactPhoneNo VARCHAR(100), 	
														fldContactEmail VARCHAR(250), 	
														fldContactSubject VARCHAR(250), 	
														fldContactMessage TEXT)") or die(mysql_error());
			
			//FOR SITEMAP//		  		   
	   		mysql_query("CREATE TABLE ".$table_prefix."_tblSitemap(fldsitemapID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldsitemapID), 
													    fldSitemapLocation VARCHAR(250), 	
														fldSitemapModification DATE, 	
														fldSitemapChange VARCHAR(250), 															
														fldSitemapPriority TEXT)") or die(mysql_error());
			
   			
   			//SAVE THE DEFAULT ADMINISTRATOR			
			$password = md5($administrator_password);
			   mysql_query("INSERT INTO ".$table_prefix."_tblAdministrator (fldAdministratorusername, fldAdministratorRealName, fldAdministratorPassword, fldAdministratorEmail) VALUES ('$administrator_username','$administrator_realname','$password','$administrator_email')");
			   
			   /*****************TABLE FOR CLIENT*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblClient(fldClientID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldClientID), 
													    fldClientFirstName VARCHAR(250), 
														fldClientLastname VARCHAR(250), 
														fldClientAddress VARCHAR(250), 
														fldClientAddress1 VARCHAR(250), 
														fldClientCity VARCHAR(100), 
														fldClientState VARCHAR(100), 
														fldClientCountry VARCHAR(100), 
														fldClientEmail VARCHAR(250), 
														fldClientPhoneNo VARCHAR(150), 
														fldClientUsername VARCHAR(100),
														fldClientPassword VARCHAR(250),														
														fldClientRegDate DATE)") or die(mysql_error());	
				/*****************END TABLE FOR CLIENT*******************/
   			
			//GET THE MODULES
				//1. Newsletter
				//2. Photo Gallery
				//3. Video Gallery
				//4. Blog Modules
				//5. Forum Modules
				//6. Store Modules
				//7. User Modules
			foreach( $_POST['modules'] as $modules) {
				if($modules == 1) {
					$modules_name = 'Newsletter';
					//CREATE TABLE FOR NEWSLETTER//					
					mysql_query("CREATE TABLE ".$table_prefix."_tblNewsletter(fldNewsletterID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldNewsletterID), 
													    fldNewsletterName VARCHAR(250), 															
														fldNewsletterDescription TEXT)") or die(mysql_error());					
				} else if($modules ==2) {					
  					$modules_name = 'Photo Gallery';
					//CREATE TABLE FOR PHOTO GALLERY//					
					mysql_query("CREATE TABLE ".$table_prefix."_tblPhotoGallery(fldPhotoGalleryID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldPhotoGalleryID), 
													    fldPhotoGalleryName VARCHAR(250), 
														fldPhotoGalleryCategory VARCHAR(250), 
														fldPhotoGalleryDescription TEXT, 
														fldPhotoGalleryImage VARCHAR(250))") or die(mysql_error());	
				} else if($modules == 3) {					
  					$modules_name = 'Video Gallery';
					//CREATE TABLE FOR VIDEO GALLERY//					
					mysql_query("CREATE TABLE ".$table_prefix."_tblVideoGallery(fldVideoGalleryID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldVideoGalleryID), 
													    fldVideoGalleryName VARCHAR(250), 
														fldVideoGalleryCategory VARCHAR(250), 
														fldVideoGalleryDescription TEXT, 
														fldVideoGalleryImage VARCHAR(250))") or die(mysql_error());	
				} else if($modules == 4) {
					$modules_name = 'Blogs';
					//CREATE TABLE FOR BLOGS//						
					mysql_query("CREATE TABLE ".$table_prefix."_tblBlogs(fldBlogsID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldBlogsID), 
													    fldBlogsName VARCHAR(250),
														fldBlogsAuthor VARCHAR(250),
														fldBlogsCategory VARCHAR(250),
														fldBlogsTags VARCHAR(250),
														fldBlogsDescription TEXT, 
														fldBlogsDate DATE)") or die(mysql_error());	
				} else if($modules == 5) {
					$modules_name = 'FORUM';
						//CREATE TABLE FOR FORUM//	
						
						/********************TABLE FOR FORUM***********************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblForum(fldForumID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldForumID), 
													    fldForumClientID VARCHAR(250),
														fldForumCategoryID VARCHAR(250),
														fldForumClientName VARCHAR(250),
														fldForumTitle VARCHAR(250),
														fldForumCountView VARCHAR(250),
														fldForumContent TEXT, 
														fldForumDate DATE)") or die(mysql_error());	
						/********************END TABLE FOR FORUM***********************/
						
						/********************TABLE FOR FORUM CATEGORY***********************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblForumCategory(fldForumCategoryID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldForumCategoryID), 
													    fldForumCategoryTitle VARCHAR(250),
														fldForumCategoryMainCatID VARCHAR(100),														
														fldForumCategoryContent TEXT)") or die(mysql_error());	
						/********************END TABLE FOR FORUM CATEGORY ***********************/
						
						/********************TABLE FOR FORUM REPLY***********************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblForumReply(fldForumReplyID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldForumReplyID), 
													    fldForumReplyClientID VARCHAR(250),
														fldForumReplyCategoryID VARCHAR(250),
														fldForumReplyForumID VARCHAR(250),
														fldForumReplyClientName VARCHAR(250),
														fldForumReplyTitle VARCHAR(250),
														fldForumReplyStatus VARCHAR(250),
														fldForumReplyMessage TEXT, 
														fldForumReplyDate DATE)") or die(mysql_error());	
						/********************END TABLE FOR FORUM REPLY***********************/
						
						/********************TABLE FOR FORUM ANSWER***********************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblForumAnswer(fldForumAnswerID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldForumAnswerID), 
													    fldForumAnswerClientID VARCHAR(250),														
														fldForumAnswerForumID VARCHAR(250),
														fldForumAnswerClientName VARCHAR(250),
														fldForumAnswerReplyID VARCHAR(250),
														fldForumAnswerTitle VARCHAR(250),
														fldForumAnswerContent TEXT, 
														fldForumAnswerDate DATE)") or die(mysql_error());	
						/********************END TABLE FOR FORUM ANSWER***********************/
					
				} else if($modules == 6) {
					$modules_name = 'STORE';
					//CREATE TABLE FOR STORE//			
					
						/*****************TABLE FOR CATEGORY*******************/
						mysql_query("CREATE TABLE ".$table_prefix."_tblCategory(fldCategoryID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldCategoryID), 
													    fldCategoryName VARCHAR(250), 
														fldCategoryDescription TEXT, 
														fldCategoryImage VARCHAR(250))") or die(mysql_error());	
						/*****************END TABLE FOR CATEGORY*******************/
						
						/*****************TABLE FOR PRODUCTS*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblProducts(fldProductsId INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldProductsId), 
													    fldProductsCategoryID VARCHAR(100), 
														fldProductsName VARCHAR(250), 
														fldProductsDescription TEXT, 
														fldProductsPrice VARCHAR(100), 
														fldProductsWeight VARCHAR(100), 
														fldProductsImage VARCHAR(250))") or die(mysql_error());	
						/*****************END TABLE FOR PRODUCTS*******************/
						
						/*****************TABLE FOR TEMPCART*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblTempCart(fldTempCartID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldTempCartID), 
													    fldTempCartProductID VARCHAR(100), 
														fldTempCartClientID VARCHAR(100), 
														fldTempCartProductName VARCHAR(250), 
														fldTempCartProductPrice VARCHAR(100), 
														fldTempCartQuantity VARCHAR(100), 
														fldTempCartDate DATE)") or die(mysql_error());	
						/*****************END TABLE FOR TEMPCART*******************/
						  
						/*****************TABLE FOR CART*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblCart(fldCartID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldCartID), 
													    fldCartProductID VARCHAR(100), 
														fldCartClientID VARCHAR(100), 
														fldCartProductName VARCHAR(250), 
														fldCartProductPrice VARCHAR(100), 
														fldCartQuantity VARCHAR(100), 
														fldCartOrderNo VARCHAR(250), 
														fldCartStatus VARCHAR(100), 
														fldCartDate DATE)") or die(mysql_error());	
						/*****************END TABLE FOR CART*******************/
						
						
						
						/*****************TABLE FOR SHIPPING*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblShipping(fldShippingID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldShippingID), 
													    fldShippingClientID VARCHAR(100), 
														fldShippingFirstName VARCHAR(250), 
														fldShippingLastname VARCHAR(250), 
														fldShippingAddress VARCHAR(250), 
														fldShippingAddress1 VARCHAR(250), 
														fldShippingCity VARCHAR(100), 
														fldShippingState VARCHAR(100), 
														fldShippingCountry VARCHAR(100), 
														fldShippingEmail VARCHAR(250), 																											
														fldShippingPhoneNo VARCHAR(100))") or die(mysql_error());	
						/*****************END TABLE FOR SHIPPING*******************/
						
						
  
  
  
  
  
						/*****************TABLE FOR SHIPPING RATE*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblShippingRate(fldShippingRateID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldShippingRateID), 
													    fldShippingRateOrderNo VARCHAR(250), 
														fldShippingRateName VARCHAR(250), 																																							
														fldShippingRateAmount VARCHAR(100))") or die(mysql_error());	
						/*****************END TABLE FOR SHIPPING RATE*******************/
						
				} else if($modules == 7) {
					$modules_name = 'USER MODULES';
				} else if ($modules == 8) {
					$modules_name = 'NEWS MODULES';
					 /*****************TABLE FOR NEWS*******************/						
						mysql_query("CREATE TABLE ".$table_prefix."_tblNews(fldNewsID INT NOT NULL AUTO_INCREMENT, 
													   PRIMARY KEY(fldNewsID), 
													    fldNewsTitle VARCHAR(250), 
														fldNewsDescription TEXT, 																																							
														fldNewsDate DATE)") or die(mysql_error());	
						/*****************END TABLE FOR NEWS*******************/
				}
				
				//SAVE MODULES				   
				mysql_query("INSERT INTO ".$table_prefix."_tblModules (fldModulesName, fldModulesNameID) VALUES ('$modules_name','$modules')");
			} // for each modules
			
			
			//REDIRECT TO LOGIN PAGE
			header("Location: ../_admin/index.php");
   
		} // if ctr
   
	}
?>
<form method="post" action="<? $PHP_SELF; ?>">
 <table border="0" width="100%">
        	<tr>
            	<td><h2>Connection Information</h2></td>
            </tr>
            <tr>
            	<td><h3>Server Connection and login Information</h3></td>
            </tr>
            <tr>
            	<td>Please enter the name of your server, your login name and your password</td>
            </tr>
  <tr>
              <td>&nbsp;</td>
  </tr>
  <tr>
              <td><table border="0" width="500">
              	<? if(isset($connection_error)) { ?>
                	<tr>
                    	<td colspan="3" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold"><?=$connection_error?></td>
                    </tr>
                <? } ?>
                <tr>
                  <td width="143">Database Host</td>
                  <td width="10">:</td>
                  <td width="340"><input name="host" type="text" size="45" value="<?=$hostname?>">
                  <? if(isset($hostname_error)) { ?>
                  		<div class="error"><?=$hostname_error?></div>
                  <? } ?>
                  </td>
                </tr>
                <tr>
                  <td>Database login name</td>
                  <td>:</td>
                  <td><input name="username" type="text" size="45" id="username" value="<?=$dbUsername?>">
                    <? if(isset($username_error)) { ?>
                  		<div class="error"><?=$username_error?></div>
                  <? } ?>
                  </td>
                </tr>
                <tr>
                  <td>Database Password</td>
                  <td>:</td>
                  <td><input name="password" type="text" size="45" id="password" value="<?=$dbPassword?>">
                   <? if(isset($password_error)) { ?>
                  		<div class="error"><?=$password_error?></div>
                  <? } ?>
                  </td>
                </tr>
              </table></td>
  </tr>
  <tr>
              <td>&nbsp;</td>
  </tr>
  <tr>
              <td><h3>Database Information</h3></td>
  </tr>
  <tr>
              <td>Please enter the name of the database created for Dog And Rooster Admin Control Panel. If there is no databasae yet, the installer will attempt to create a database for you. This may fail on the MYSQL configuration or the database user permissions for your domain/ installation</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
              <td><table border="0" width="500">
              <? if(isset($database_error)) { ?>
                	<tr>
                    	<td colspan="3" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold"><?=$connection_error?></td>
                    </tr>
                <? } ?>
                <tr>
                  <td width="143">Database Name</td>
                  <td width="10">:</td>
                  <td width="340"><input name="database_name" type="text" size="45" id="database_name" value="<?=$dbName?>">
                  <? if(isset($database_error)) { ?>
                  		<div class="error"><?=$database_error?></div>
                  <? } ?>
                  </td>
                </tr>
                <tr>
                  <td>Table prefix</td>
                  <td>:</td>
                  <td><input name="table_prefix" type="text" size="45" id="table_prefix" value="<?=$table_prefix?>">
                     <? if(isset($table_error)) { ?>
                  		<div class="error"><?=$table_error?></div>
                  <? } ?>
                  </td>
                </tr>
              </table></td>
  </tr>
  <tr>
              <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h3>Default Admin User</h3></td>
  </tr>
  <tr>
    <td>Now you'll need to enter some details for the main administrator account. You can fill in your own name here and a password you're not likely to forget. You'll need these to log into Admin once setup is complete</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table border="0" width="565">
      <tr>
        <td width="207">Administrator Username</td>
        <td width="10">:</td>
        <td width="335"><input name="administrator_username" type="text" size="45" id="administrator_username" value="<?=$administrator_username?>">
         <? if(isset($administrator_username_error)) { ?>
                  		<div class="error"><?=$administrator_username_error?></div>
         <? } ?>
        </td>
      </tr>
      <tr>
        <td>Administrator Real Name</td>
        <td>:</td>
        <td><input name="administrator_realname" type="text" size="45" id="administrator_realname" value="<?=$administrator_realname?>">
        <? if(isset($administrator_realname_error)) { ?>
                  		<div class="error"><?=$administrator_realname_error?></div>
         <? } ?>
        </td>
      </tr>
      <tr>
        <td>Administrator Email</td>
        <td>:</td>
        <td><input name="administrator_email" type="text" size="45" id="administrator_email" value="<?=$administrator_email?>"></td>
      </tr>
      <tr>
        <td>Administrator Password</td>
        <td>:</td>
        <td><input name="administrator_password" type="password" size="45" id="administrator_password" >
        <? if(isset($administrator_password_error)) { ?>
                  		<div class="error"><?=$administrator_password_error?></div>
         <? } ?>
        </td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td>:</td>
        <td><input name="administrator_password1" type="password" size="45" id="administrator_password1" >
         <? if(isset($administrator_confirm_error)) { ?>
                  		<div class="error"><?=$administrator_confirm_error?></div>
         <? } ?>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h3>Modules</h3></td>
  </tr>
  <tr>
    <td>Please choose your modules
    <? if(isset($modules_error)) { ?>
       <div class="error"><?=$modules_error?></div>
    <? } ?>
    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table border="0" width="565">
      <tr>
        <td width="207">Newsletter</td>
        <td width="10">:</td>
        <td width="335"><input name="modules[]" type="checkbox" id="modules[]" value="1"></td>
      </tr>
      <tr>
        <td>Photo Gallery</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="2"></td>
      </tr>
      <tr>
        <td>Video Gallery</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="3"></td>
      </tr>
      <tr>
        <td>Blog Modules</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="4"></td>
      </tr>
      <tr>
        <td>Forum Modules</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="5"></td>
      </tr>
      <tr>
        <td>Store Modules</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="6"></td>
      </tr>
      <tr>
        <td>User Modules</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="7"></td>
      </tr>
      <tr>
        <td>News Modules</td>
        <td>:</td>
        <td><input name="modules[]" type="checkbox" id="modules[]" value="8"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="submit" value="Create Now"></td>
  </tr>
  <tr>
            	<td>&nbsp;</td>
            </tr>
        </table>
        
</form>     