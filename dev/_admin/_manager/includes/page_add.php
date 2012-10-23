<?
	if(isset($_POST['submit'])) {
			
			$_POST = sanitize($_POST);
		    $page = $_POST;
		    settype($page,'object');
			Pages::addPages($page); 
			$success = "Page Successfully Saved!";
			
			$updates = 'Add New Page Content';
			AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
?>
		<? if(isset($success)) { ?>
            <div class="alert"> Page Successfully Saved! </div>
        <? } ?>    

            <form id="form_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
            
              <fieldset>
                <legend>New Page</legend>
                <ul>
                  <li><label for="page_name"> Page Name: </label>
                    <input type="text" id="page_name" name="name"></li>
                  
                    
                  <li><label for="page.editor"> Content Manager: </label>
                    <textarea cols="80" rows="10" id="page.editor" name="content"> </textarea></li>
                   
                </ul>
              </fieldset>
              
             
              
              <div class="iecol1 center"><button type="submit" name="submit">Save Page</button> &nbsp; <button type="reset">Clear Page</button></div>
              
            </form>
