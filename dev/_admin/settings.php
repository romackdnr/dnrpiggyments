<? include '_manager/box.header/base.php' ?>



	<? startblock('section') ?> 
      <div id="container">
      	<h2>Administrator Settings</h2>
        <span>Welcome to your Admin Settings.</span>

        <div class="hr-clear" style="margin-bottom:10px;"><!-- Clear Section --></div>
                
        <? include '_manager/includes/profile_manager.php'; ?>
        
      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/profile.css" />
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2, h3');
</script>
<? endblock() //End of Extra Codes ?>
