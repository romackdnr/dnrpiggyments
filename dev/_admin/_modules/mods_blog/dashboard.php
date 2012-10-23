<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Blogs.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

//delete photo
if(isset($_REQUEST['delete'])) {
	Blogs::deleteBlogs($_REQUEST['delete']);
	
	 $updates = 'Delete blogs content';
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
</head>

<body onLoad="javascript:alternatecolor('alter_rows');">

	<div id="blog_overview">
    	<ul class="btn">
	  		<li><a href="<?=$ROOT_URL?>_admin/modules_blogs/add/">Add New Post</a></li>
        </ul>
  
    <h3>Posts Overview</h3>
  
    <table id="page_manager">
    
      <thead>
        <tr class="headers">
          <td width="70"> ID </td>
          <td width="410">Post</td>
          <td width="220">Author</td>
          <td width="140">Categories</td>
          <td width="100">Tags</td>
          <td width="150" align="center">Action</td>
        </tr>
      </thead>
    
      <tbody id="alter_rows">
        <?php
				 $count_record=Blogs::countBlogs();
				 
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
					$blog=Blogs::findAll($pg[1]);
			?>
		  	<? if($count_record == 0) { ?>
            	  <tr>
                  	<td colspan="6" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Record Found</td>
                  </tr>
            <? } else { 
					foreach($blog as $blogs) { 
			?>
            
                    <tr>
                      <td> <?=$blogs->fldBlogsID?> </td>
                      <td><?=$blogs->fldBlogsName?></td>
                      <td><?=$blogs->fldBlogsAuthor?></td>
                      <td><?=$blogs->fldBlogsCategory?></td>
                      <td><?=$blogs->fldBlogsTags?></td>
                      <td align="center"><a href="<?=$ROOT_URL?>_admin/modules_blogs/edit/<?=$blogs->fldBlogsID?>/"><img src="<?=$ROOT_URL?>_admin/_modules/mods_blog/images/modify.png" width="14" height="16" alt="mod" /></a> <a href="<?=$ROOT_URL?>_admin/modules_blogs/delete/<?=$blogs->fldBlogsID?>/" title="Delete Page" onClick="return confirm(&quot;Are you sure you want to completely remove this Blogs from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Blogs.\n&quot;)"><img src="<?=$ROOT_URL?>_admin/_modules/mods_blog/images/delete.gif" width="16" height="16" alt="del" /></a> </td>
                    </tr>
        <? } }?>
       
      </tbody>
      
      <tfoot>
      <th colspan="6" align="right" height="30">
          <dl>
            <dt class="col1"><?=$pg[0]?></dt>
            <dd class="col2"></dd>
          </dl>
        </th>
      </tfoot>
    
    </table>
    <!-- /End Fetching Data Tables -->
    
   
  
</div>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/alternate_color.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>