<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/VideoGallery.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

//delete photo
if(isset($_REQUEST['delete'])) {
	VideoGallery::deleteVideoGallery($_REQUEST['delete']);
	
	$updates = 'Delete videos content';
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
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_modules/mods_video/css/photoswitcher.css" />
	<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
  <script type="text/javascript" src="<?=$ROOT_URL?>_admin/_modules/mods_video/js/photoswitcher.js"></script>
</head>

<body>

	<div id="photo_overview">
    	<ul class="btn">
			<li><a href="<?=$ROOT_URL?>_admin/video_upload/">Upload New Video</a></li>
        </ul>    
    
    <h3>Video Overview</h3>

    <a href="#" class="switch_thumb"><!-- Switch Thumb --></a>
    <ul class="display">
    <?php
				 $count_record=VideoGallery::countVideoGallery();
				 
				if(!isset($_REQUEST['page']))
					{
						$page = 1;
					}
					else
					{
					$page = $_GET[page];
					}
					$pagination = new Pagination;
					//for display
					$pg = $pagination->page_pagination(20, $count_record, $page, 20);
					//$result_prod = mysql_query($query_Recordset2.$pg[1]);
					$video=VideoGallery::findAll($pg[1]);
			?>
		  	<? if($count_record == 0) { ?>
            	<li>
                  <div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Record Found</div>
                </li>
            <? } else { 
					foreach($video as $videos) { 
						$image = substr($videos->fldVideoGalleryImage,9);
			?>		
                  <li>
                    <div class="content_block"> <a href="#"><img src="<?=$ROOT_URL?><?=$image?>" width="215"  alt=""></a>
                      <h3><a href="#"><?=$videos->fldVideoGalleryName?></a></h3>
                      <p>Category: <?=$videos->fldVideoGalleryCategory?></p>
                      <p><?=$videos->fldVideoGalleryDescription?></p>
                      <p><a href="<?=$ROOT_URL?>_admin/video_edit/<?=$videos->fldVideoGalleryID?>/<?=$videos->fldVideoGalleryName?>/">Edit</a> | 
                      <a href="<?=$ROOT_URL?>_admin/video_delete/<?=$videos->fldVideoGalleryID?>/<?=$videos->fldVideoGalleryName?>/" onClick="return confirm(&quot;Are you sure you want to completely remove this Videos from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Videos.\n&quot;)">Delete</a></p>
                    </div>
                  </li>
          <? } // foreach?>
      <? } //if record count?>
     
    </ul>
    
    <table id="page_manager" style="width:1070px;">
    
      <tfoot>
      <th align="right" height="30">
          <dl>
            <dt class="col1"><?=$pg[0]?></dt>
            <dd class="col2"></dd>
          </dl>
        </th>
      </tfoot>
    
    </table>
    <!-- /End Fetching Data Tables -->

	</div>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>