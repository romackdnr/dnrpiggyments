<?php include 'manager/_pi/base.php'; ?>

	<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Shipping Rate</h1>
      <hr />
    </hgroup>

    <? include 'includes/shipping_rate.php'; ?>
  </article>
	<? endblock() //end section ?>





<? startblock('headercodes') ?>
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>
head.js('assets/js/jvalidates.min.js');
head.ready(function() {

  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

});
<? endblock() //end extracodes ?>
