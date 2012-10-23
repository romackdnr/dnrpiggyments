<? include '_manager/box.header/base.php' ?>
<? 
	#Insert Code after this line...
	###############################


?>


	<? startblock('section') ?> 
      <div id="container">
      	<h2>Help - Users Guide</h2>
        <span>Welcome to Dog and Rooster, Inc. Admin Panel user guide.</span>
        
        <div class="hr-clear" style="margin-bottom:10px;"><!-- Clear Section --></div>        
        
        <br>
        <h3>Coming Soon...</h3>
        <p><em>No current settings found.</em></p>
        
        
      </div>
  <? endblock() //End of Section ?>



<? startblock('headercodes') ?> 
<? endblock() //End of Header Codes ?>

<? startblock('extracodes') ?> 
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2, h3');
</script>
<? endblock() //End of Extra Codes ?>
