<?php include 'manager/_pi/base.php'; ?>
<? require_once("includes/shopping_cart.php");?>
	<? startblock('section') ?>
  <aside>
   	<?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  		<? require_once('includes/shopping_cart_content.php');?>
  </article>
	<? endblock() //end section ?>





<? startblock('headercodes') ?>
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>
head.ready(function() {

  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

});
<? endblock() //end extracodes ?>
