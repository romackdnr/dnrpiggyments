<? include '_manager/box.header/base.php' ?>



	<? startblock('section') ?> 
      <div id="container">
      	<h2>Modules Management</h2>
        <span>Welcome to your Modules Manager</span>

        <div class="hr-clear" style="margin-bottom:20px;"><!-- Clear Section --></div>        

        <div id="modules">
          <div id="module_box" class="col1">
            <h3>Content Structures</h3>
            <ul>
              <li class="newsletter"><a href="<?=$ROOT_URL?>_admin/modules_contact/view/" rel="shadowbox;width=1110;height=700" title="Contact Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Contact <span>Manage your contacts</span></a></li>
              
                 <li class="newsletter"><a href="<?=$ROOT_URL?>_admin/modules_client/view/" rel="shadowbox;width=1110;height=700" title="Client Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Client <span>Manage your clients</span></a></li>
                 
                
              
            <? if(Modules::countModules(1)==1) { //modules for newsletter ?>
              <li class="newsletter"><a href="<?=$ROOT_URL?>_admin/modules_newsletter/view/" rel="shadowbox;width=1110;height=700" title="Newsletter Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Newsletter <span>Manage your newsletter</span></a></li>
            <? } ?>  
            
            <? if(Modules::countModules(2)==1) { //modules for photo gallery ?>
              <li class="photo"><a href="<?=$ROOT_URL?>_admin/photo_gallery/" rel="shadowbox;width=1110;height=700" title="Photo Gallery Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Photo Gallery <span>Manage your dynamic photo gallery</span></a></li>
            <? } ?>
             
             <? if(Modules::countModules(3)==1) { //modules for video gallery ?> 
              <li class="video"><a href="<?=$ROOT_URL?>_admin/video_gallery/" rel="shadowbox;width=1110;height=700" title="Video Gallery Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Video Gallery <span>Manage your dynamic video gallery</span></a></li>
              <? } ?>
              
              <? if(Modules::countModules(4)==1) { //modules for blogs ?> 
              <li class="blog"><a href="<?=$ROOT_URL?>_admin/modules_blogs/view/" rel="shadowbox;width=1110;height=700" title="Blog Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Blog Modules <span>Additional settings for Blog</span></a></li>
              <? } ?>
              
              <? if(Modules::countModules(6)==1) { //modules for store ?>
              <li class="store"><a href="<?=$ROOT_URL?>_admin/modules_category/view/" rel="shadowbox;width=1110;height=700" title="Simple Category Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Category Modules <span>Additional settings for <br> Simple E-Cart</span></a></li>
              <? } ?>
              
               <li class="store"><a href="<?=$ROOT_URL?>_admin/modules_products/view/" rel="shadowbox;width=1110;height=700" title="Simple Product Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Product Modules <span>Additional settings for <br> Products</span></a></li>
               
                <li class="store"><a href="<?=$ROOT_URL?>_admin/modules_category_options/view/" rel="shadowbox;width=1110;height=700" title="Options Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Options Modules <span>Additional settings for <br> Options</span></a></li>
             
              
              <? if(Modules::countModules(5)==1) { //modules for forum ?>
           		   <li class="forum last"><a href="<?=$ROOT_URL?>_admin/modules_forum_category/view/" rel="shadowbox;width=1110;height=700" title="Forum Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Forum Modules <span>Additional settings for Forum</span></a></li>
              <? } ?>
              <? if(Modules::countModules(7)==1) { //modules for users ?>
             		 <li class="members"><a href="_manager/includes/.install_module.php" rel="shadowbox;width=640;height=480" title="Members Modules Not Found"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> User Modules <span>Manage your members panel</span></a></li>
              <? } ?>
              <? if(Modules::countModules(8)==1) { //modules for users ?>
             		 <li class="members"><a href="<?=$ROOT_URL?>_admin/modules_news/view/" rel="shadowbox;width=1110;height=700" title="News Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> News Modules <span>Manage your News and Events</span></a></li>
              <? } ?>
			            
               <li class="members"><a href="<?=$ROOT_URL?>_admin/modules_orders/view/" rel="shadowbox;width=1110;height=700" title="Orders Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Orders Modules <span>Manage your Orders</span></a></li>
               
                <li class="members"><a href="<?=$ROOT_URL?>_admin/modules_testimonials/view/" rel="shadowbox;width=1110;height=700" title="Testimonials Modules"><img src="<?=$ROOT_URL?>_admin/_assets/images/icons/advanced.png" width="32" height="32" alt=""> Testimonials Modules <span>Manage your Testimonials</span></a></li>
                 
                
               	 
            </ul>
          </div>
        </div>
        <div class="hr-clear"><!-- Clear Section --></div>
        

      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/modules.css" />
<link rel="stylesheet" type="text/css" href="<?=$ROOT_URL?>_admin/_assets/shadowbox/shadowbox.css">
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/shadowbox/shadowbox.js"></script>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2, h3');

	Shadowbox.init({
		language:'en',
		players:['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
		modal:true
	});
</script>
<? endblock() //End of Extra Codes ?>
