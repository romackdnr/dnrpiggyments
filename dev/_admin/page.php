<? include '_manager/box.header/base2.php' ?>
	<? startblock('section') ?> 
      <div id="container">
      	<h2>Page Management</h2>
        <span>Welcome to your Page Manager</span>
        
        <div class="hr-clear"><!-- Clear Section --></div>
        
        <div id="page_tabs">
          
          <ul id="pt_selectors">
            <li id="pt_btab"><a href="<?=$ROOT_URL?>_admin/page_new/">Create Page / Meta Tags</a></li>
          </ul>
          
          <div id="pt_ftab">
          	<? include '_manager/includes/page_manager.php'; ?>
          </div>
        </div>
        <!-- /End Page Tabs -->
        
      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" href="<?=$ROOT_URL?>_admin/_assets/shadowbox/shadowbox.css">
<link rel="stylesheet" type="text/css" href="<?=$ROOT_URL?>_admin/_assets/css/page.css">
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/alternate_color.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/shadowbox/shadowbox.js"></script>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2');
	
	$("#pt_btab").show(); //Hide Create New Page

	Shadowbox.init({
		language:'en',
		players:['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
		modal:true
	});
</script>
<? endblock() //End of Extra Codes ?>
