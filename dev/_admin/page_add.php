<? include '_manager/box.header/base.php' ?>



	<? startblock('section') ?> 
      <div id="container">
      	<h2>Page Management</h2>
        <span>Welcome to your Page Manager</span>
        
        <div class="hr-clear"><!-- Clear Section --></div>
        
        <div id="page_tabs">
          
          <ul id="pt_selectors">
            <li id="pt_btab"><a href="<?=$ROOT_URL?>_admin/page_pages/">View All Page</a></li>
          </ul>
          
          <div id="pt_ftab">
          	<? include '_manager/includes/page_add.php'; ?>
          </div>
        </div>
        <!-- /End Page Tabs -->
      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" href="<?=$ROOT_URL?>_admin/_assets/css/page.css">
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_manager/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/tiny.mods.js"></script>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2');
</script>
<? endblock() //End of Extra Codes ?>
