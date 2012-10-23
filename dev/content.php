<?php include 'manager/_pi/base.php'; ?>
<?
	$pages = Pages::findPages($_REQUEST['id']);
?>
	<? startblock('section') ?>
  <aside>
   	<?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1><?=$pages->fldPagesName?></h1>
      <hr />
    </hgroup>
    <?=$pages->fldPagesDescription?>
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
