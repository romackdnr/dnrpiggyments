        <? 
			if(isset($_POST['submit'])) {
					$_POST = sanitize($_POST);
					$sitemap = $_POST;
					settype($sitemap,'object');
					Sitemap::addSitemap($sitemap); 
					$success = "Sitemap Successfully Added!";
					
					$updates = 'Add new sitemap content';
					AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
			}
			
			if(isset($_REQUEST['delete'])) {
				Sitemap::deleteSitemap($_REQUEST['delete']);
				$updates = 'Delete sitemap content';
				AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
			}
			
			if(isset($_REQUEST['id'])) {
				$sitemap_info = Sitemap::findSitemap($_REQUEST['id']);
			}
			
			if(isset($_POST['update'])) {
					$_POST = sanitize($_POST);
					$sitemap = $_POST;
					settype($sitemap,'object');
					Sitemap::updateSitemap($sitemap); 
					$success = "Sitemap Successfully Changed!";
					
					$updates = 'Update sitemap content';
					AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
			}
		?>
        <div id="sitemap">
        	<h3>SlickPlan Sitemap Management</h3>
          <p>View your current Site Online Flow Chart.</p>
          
          <iframe id="slickplan" allowtransparency="yes" align="top" width="1050" height="500" longdesc="SlickPlan Sitemap Visual Creator" frameborder="0" title="SlickPlan Sitemap" src="http://www.slickplan.com/project/8230"> </iframe>
          
          
        	<h3>XML Sitemap File List</h3>
          <p>Update and modify your XML Sitemap.</p>
		<? if(isset($success)) { ?>
	          <div class="alert"> <?=$success?> </div>
        <? } ?>      

          <form id="sitemap_page" action="<?=$ROOT_URL?>_admin/elements_sitemap/" method="post">
            <fieldset>
              <legend>Sitemap Page</legend>
              <? if(isset($_REQUEST['id'])) {?>
              	                    <ul>
                    <li><label> Location: </label>
                      <input type="text" id="field[]" name="location" onClick="if (this.value == 'http://domain.com') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'http://domain.com'; }" value="<?=$sitemap_info->fldSitemapLocation?>"></li>
                    <li><label> Last Modification: </label>
                      <input type="text" id="field[]" name="modification" onClick="if (this.value == 'YYYY-MM-DD') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'YYYY-MM-DD'; }" value="<?=$sitemap_info->fldSitemapModification?>"></li>
                    <li><label> Change Update Frequency: </label>
                      <input type="text" id="field[]" name="change" onClick="if (this.value == 'Weekly, Monthly') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Weekly, Monthly'; }" value="<?=$sitemap_info->fldSitemapChange?>"></li>
                    <li><label> Priority: </label>
                      <input type="text" id="field[]" name="priority" onClick="if (this.value == 'Priority #') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Priority #'; }" value="<?=$sitemap_info->fldSitemapPriority?>"></li>
                  </ul>
                  </fieldset>
            
            <div class="iecol1 center">
            <input type="hidden" name="Id" value="<?=$sitemap_info->fldsitemapID?>" />
            <button type="submit" name="update">Update Sitemap</button> &nbsp; <button type="reset">Clear Page</button></div>
	
              <? } else { ?>
                  <ul>
                    <li><label> Location: </label>
                      <input type="text" id="field[]" name="location" onClick="if (this.value == 'http://domain.com') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'http://domain.com'; }" value="http://domain.com"></li>
                    <li><label> Last Modification: </label>
                      <input type="text" id="field[]" name="modification" onClick="if (this.value == 'YYYY-MM-DD') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'YYYY-MM-DD'; }" value="YYYY-MM-DD"></li>
                    <li><label> Change Update Frequency: </label>
                      <input type="text" id="field[]" name="change" onClick="if (this.value == 'Weekly, Monthly') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Weekly, Monthly'; }" value="Weekly, Monthly"></li>
                    <li><label> Priority: </label>
                      <input type="text" id="field[]" name="priority" onClick="if (this.value == 'Priority #') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Priority #'; }" value="Priority #"></li>
                  </ul>
             
            </fieldset>
            
            <div class="iecol1 center"><button type="submit" name="submit">Add Sitemap</button> &nbsp; <button type="reset">Clear Page</button></div>
             <? } ?>
          </form>

          <table id="sitemap_manager">
          
            <thead>
              <tr class="headers">
                <td width="25"> ID </td>
                <td width="150">Location</td>
                <td width="130">Last Modification</td>
                <td width="150">Update Frequecy</td>
                <td width="100">Priority</td>
                <td width="100" align="center">Actions</td>
              </tr>
            </thead>
          
            <tbody id="alter_rows">
           <?php
				 $count_record=Sitemap::countSitemap();
				 
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
					$sitemap=Sitemap::findAll($pg[1]);
			?>
		  	<? if($count_record == 0) { ?>
            	<tr>
                	<td colspan="6" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Record Found</td>
                </tr>
            <? } else { 
					foreach($sitemap as $sitemaps) { 
			?>
              <tr>
                <td> <?=$sitemaps->fldsitemapID?> </td>
                <td><?=$sitemaps->fldSitemapLocation?></td>
                <td><?=$sitemaps->fldSitemapModification?></td>
                <td><?=$sitemaps->fldSitemapChange?></td>
                <td><?=$sitemaps->fldSitemapPriority?></td>
                <td align="center"><a href="<?=$ROOT_URL?>_admin/elements_sitemap_edit/<?=$sitemaps->fldsitemapID?>/" title="Modify Page"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/modify.png" width="14" height="16" alt="mod" /></a> <a href="<?=$ROOT_URL?>_admin/elements_sitemap_delete/<?=$sitemaps->fldsitemapID?>/" title="Delete Page" onClick="return confirm(&quot;Are you sure you want to completely remove this Sitemap from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Sitemap.\n&quot;)"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/delete.gif" width="16" height="16" alt="del" /></a></td>
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
          
          <div class="hr-clear"><!-- Clear Section --></div>

 				</div>
        <!-- /Sitemap -->
