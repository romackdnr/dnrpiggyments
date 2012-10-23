<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/VideoGallery.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include "functions/myFunctions.php";
?>
<?
	if(isset($_POST['submit'])) {
		
			include ("upload_class.php"); //classes is the map where the class file is stored (one above the root)

			$max_size = 1024*250; // the max. size for uploading
		
			$my_upload = new file_upload;
		
			if($_FILES['image']['name'] != '') {
		
		
					$my_upload->upload_dir = "../../../videos/"; // "files" is the folder for the uploaded files (you have to create this folder)
					$my_upload->extensions = array(".jpeg", ".gif", ".bmp",".jpg",".png");// specify the allowed extensions here
				// $my_upload->extensions = "de"; // use this to switch the messages into an other language (translate first!!!)
					$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)
					$my_upload->rename_file = true;
				
					$my_upload->the_temp_file = $_FILES['image']['tmp_name'];
					$my_upload->the_file = $_FILES['image']['name'];
					$my_upload->http_error = $_FILES['image']['error'];
					$my_upload->replace = 'y';
					//$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
					//$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename
				
					$new_name = 'Videos'.GetSID(7);
					//$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
					if ($my_upload->upload($new_name)) { // new name is an additional filename information, use this to rename the uploaded file
						$full_path = $my_upload->upload_dir.$my_upload->file_copy;
						$info = $my_upload->get_uploaded_file_info($full_path);
						// ... or do something like insert the filename to the database
					}
			} else {
				$full_path = "";
			}
			
			$_POST = sanitize($_POST);
		    $photos = $_POST;
		    settype($photos,'object');
			VideoGallery::addVideoGallery($photos,$full_path); 
			$success = "Videos Successfully Saved!";
			
			$updates = 'Add new videos content';
  	    AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/core3.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/modules.css" /> 
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_manager/tinymce/tiny_mce.js"></script>
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_video/js/tiny.mods.js"></script>
</head>

<body>
 <? if(isset($success)) { ?>
	<div class="alert"> <?=$success?> </div>
  <? } ?>  
<div id="photo_overview">
    	<ul class="btn">
			<li><a href="<?=$ROOT_URL?>_admin/video_gallery/">Back</a></li>
        </ul>   
</div>        
  <form id="photo_page" action="<? $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
    <h3>ACM Video Gallery</h3>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    <fieldset style="width:1065px;">
      <legend>Video Panel</legend>
      <ul>
        <li>
          <label for="title">Video Name</label>
          <input type="text" id="title" name="name">
        </li>
        <li>
          <label for="category">Video Category</label>
          <input type="text" id="category" name="category">
        </li>
        <li>
          <label for="cover">Upload Video Cover <span class="smaller"><em>(Max image size of 5Mb)</em></span></label>
          <input type="file" id="cover" name="image">
        </li>
        <li style="margin-top:50px;">
          <label for="video.editor">Video Description</label>
          <textarea cols="" rows="" id="video.editor" name="description"> </textarea>
        </li>
      </ul>
      
      <fieldset id="preview">
      	<legend>Preview</legend>
        <div class="previewbox">  </div>        
      </fieldset>      
    </fieldset>
    <ul class="submission">
      <li><button type="submit" name="submit">Save Video</button></li>
      <li><button type="reset">Clear Forms</button></li>
    </ul>
  </form>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>