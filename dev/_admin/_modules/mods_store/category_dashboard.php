<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Category.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

//delete photo
if(isset($_REQUEST['delete'])) {
	Category::deleteCategory($_REQUEST['delete']);
	
		 $updates = 'Delete product category content';
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

	<div id="store_overview">
    	<ul class="btn">
  			<li><a href="<?=$ROOT_URL?>_admin/modules_category/add/">Add New Item</a></li>
    	</ul>
    <h3>Category Overview</h3>
  
    <table id="page_manager">
    
      <thead>
        <tr class="headers">
          <td width="30"> ID </td>
          <td width="100">Category Name</td>          
          <td width="150" align="center">Action</td>
        </tr>
      </thead>
    
      <tbody id="alter_rows">
       <?php
				 $count_record=Category::countCategory(0);
				 
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
					$category=Category::findAll($pg[1],0);
			?>
		  	<? if($count_record == 0) { ?>
            	  <tr>
                  	<td colspan="3" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Record Found</td>
                  </tr>
            <? } else { 
					foreach($category as $categories) { 
					
			?>		
                <tr>
                  <td> <?=$categories->fldCategoryID?> </td>
                  
                  <td><?=$categories->fldCategoryName?></td>                  
                  <td align="center"><a href="<?=$ROOT_URL?>_admin/modules_category/edit/<?=$categories->fldCategoryID?>/"><img src="<?=$ROOT_URL?>_admin/_modules/mods_store/images/modify.png" width="14" height="16" alt="mod" /></a> <a href="<?=$ROOT_URL?>_admin/modules_category/delete/<?=$categories->fldCategoryID?>/" title="Delete Page" onClick="return confirm(&quot;Are you sure you want to completely remove this Category from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Category.\n&quot;)"><img src="<?=$ROOT_URL?>_admin/_modules/mods_store/images/delete.gif" width="16" height="16" alt="del" /></a> </td>
                </tr>
                
                <? 
					$subCat = Category::displayAllCategory($categories->fldCategoryID);
					if(!empty($subCat)) {
				?>
                	<tr>
                    	<td colspan="3" style="padding-left:200px;">
                        	<p><strong>Sub Category of <?=$categories->fldCategoryName?></strong></p>
                        	<table id="page_manager" style="width:60% !important;>
    
                              <thead>
                                <tr class="headers">
                                  <td width="30"> ID </td>
                                  <td width="100">Category Name</td>      
                                  <td width="100">Position</td>          
                                  <td width="150" align="center">Action</td>
                                </tr>
                              </thead>
                            
                              <tbody id="alter_rows">	
							<?		
                              foreach($subCat as $subCats) {
                            ?>
                                  <tr>
                                      <td> <?=$subCats->fldCategoryID?> </td>
                                      
                                      <td><?=$subCats->fldCategoryName?></td>   
                                      <td><?=$subCats->fldCategoryPosition?></td>                  
                                      <td align="center"><a href="<?=$ROOT_URL?>_admin/modules_category/edit/<?=$subCats->fldCategoryID?>/"><img src="<?=$ROOT_URL?>_admin/_modules/mods_store/images/modify.png" width="14" height="16" alt="mod" /></a> <a href="<?=$ROOT_URL?>_admin/modules_category/delete/<?=$subCats->fldCategoryID?>/" title="Delete Page" onClick="return confirm(&quot;Are you sure you want to completely remove this Category from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Category.\n&quot;)"><img src="<?=$ROOT_URL?>_admin/_modules/mods_store/images/delete.gif" width="16" height="16" alt="del" /></a> </td>
                                    </tr>       
                            <? } //foreach subcat?>	
                         </tbody>
                         </table>   	
                	  </td>
                    </tr>		
                <? } //if empty subcat?>
                
        <? } } ?>
        
      </tbody>
      
      <tfoot>
      <th colspan="5" align="right" height="30">
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
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_acm/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>