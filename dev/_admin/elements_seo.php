<? include '_manager/box.header/base2.php' ?>


	<? startblock('section') ?> 
      <div id="container" class="ebg">
      	<h2>Elements Management</h2>
        <span>Welcome to your Elements Manager</span>
        
        <div class="hr-clear"><!-- Clear Section --></div>        

        <div id="page_tabs">
          
          <ul id="pt_selectors">
          	<li id="et_btab1"><a href="<?=$ROOT_URL?>_admin/elements_google/">Google Manager</a></li>
            <li id="et_btab2"><a href="<?=$ROOT_URL?>_admin/elements_seo/">SEO Manager</a></li>
            <li id="et_btab3"><a href="<?=$ROOT_URL?>_admin/elements_sitemap/">Sitemap Manager</a></li>
          </ul>
          
          <div id="et_ftab">
          	<? include '_manager/includes/seo_manager.php'; ?>
          </div>
        </div>
        <!-- /End Page Tabs -->

      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/elements.css" />
<link rel="stylesheet" type="text/css" href="<?=$ROOT_URL?>_admin/_assets/shadowbox/shadowbox.css">
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/alternate_color.js"></script>
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
