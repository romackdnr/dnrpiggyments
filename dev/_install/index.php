<?php //Extra Codes Here ?>
<?php include '_manager/box_header/base.php' ?>



	<?php startblock('section') ?> 
      <div id="container">
      	
        
        <div class="hr-clear" style="margin-bottom:10px;"><!-- Clear Section --></div>        
        
        <br>
        <?php require_once('_manager/install.php');?>
        
        
      </div>
  <?php endblock() //End of Section ?>



<?php startblock('headercodes') ?> 
<?php endblock() //End of Header Codes ?>

<?php startblock('extracodes') ?> 
<script type="text/javascript" src="_assets/js/jquery.js"></script>
<script type="text/javascript" src="_assets/js/cufon.js"></script>
<script type="text/javascript" src="_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2, h3');
</script>
<?php endblock() //End of Extra Codes ?>
