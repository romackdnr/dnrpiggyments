<?
	//delete page
	if(isset($_REQUEST['delete'])) {
		Pages::deletePages($_REQUEST['delete']);
		
		
		$updates = 'Delete page management content';
		AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
	}
?>
        <table id="page_manager">        
        	<thead>
          	<tr class="headers">
            	<td width="70"> ID </td>
              
              <td width="650">Page Name</td>
              <td width="150">Action</td>
            </tr>
          </thead>
       
        	<tbody id="alter_rows">
          
		  	 <?php
				 $count_record=Pages::countPages();
				 
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
					$page=Pages::findAll($pg[1]);
			?>
		  	<? if($count_record == 0) { ?>
            	<tr>
                	<td colspan="4" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Record Found</td>
                </tr>
            <? } else { 
					foreach($page as $pages) { 
			?>
                    <tr>
                        <td> <?=$pages->fldPagesID?></td>
                    
                      <td><?=$pages->fldPagesName?></td>
                      <td align="center"><a href="<?=$ROOT_URL?>_admin/editPage/<?=$pages->fldPagesID?>/" rel="shadowbox;width=1110;"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/modify.png" width="14" height="16" alt="mod" /></a> <a href="<?=$ROOT_URL?>_admin/page_pagesDelete/<?=$pages->fldPagesID?>/" title="Delete Page" onClick="return confirm(&quot;Are you sure you want to completely remove this Page from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Page.\n&quot;)"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/delete.gif" width="16" height="16" alt="del" /></a></td>
                    </tr>
           <? } //foreach ?>
          <? } //if count record?>  
          	
          </tbody>
          
          <tfoot>
          	<th colspan="4" align="right" height="30">
            	<dl>
              	<dt class="col1"><?=$pg[0]?></dt>
                <dd class="col2"></dd>
              </dl>
            </th>
          </tfoot>
        
        </table>
        <!-- /End Fetching Data Tables -->
