<? include '_manager/box.header/base2.php' ?>
<? 
	$id = $_GET['id']; 
	
  if($id == 1) {
	  $name = 'google';
  } else if($id ==2) {
	  $name = 'seo';
  } else if($id ==3) {
	  $name = 'sitemap';
  } else {
	  $name = 'google';
  }

?>


	<? startblock('section') ?> 
      <div id="container" class="ebg">
      	<h2>Elements Management</h2>
        <span>Welcome to your Elements Manager</span>
        
        <div class="hr-clear"><!-- Clear Section --></div>        

        <div id="page_tabs">
          
          <ul id="pt_selectors">
          	<li id="et_btab1"><a href="<?=$ROOT_URL?>_admin/elements/1/">Google Manager</a></li>
            <li id="et_btab2"><a href="<?=$ROOT_URL?>_admin/elements/2/">SEO Manager</a></li>
            <li id="et_btab3"><a href="<?=$ROOT_URL?>_admin/elements/3/">Sitemap Manager</a></li>
          </ul>
          
          <div id="et_ftab">
          	<? include '_manager/includes/'.$name.'_manager.php'; ?>
          </div>
        </div>
        <!-- /End Page Tabs -->

      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" media="screen" href="_assets/css/elements.css" />
<link rel="stylesheet" type="text/css" href="_assets/shadowbox/shadowbox.css">
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="_assets/js/jquery.js"></script>
<script type="text/javascript" src="_assets/js/alternate_color.js"></script>
<script type="text/javascript" src="_assets/shadowbox/shadowbox.js"></script>

<script type="text/javascript" src="_assets/js/cufon.js"></script>
<script type="text/javascript" src="_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2, h3');

	Shadowbox.init({
		language:'en',
		players:['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
		modal:true
	});
</script>
<? endblock() //End of Extra Codes ?>
