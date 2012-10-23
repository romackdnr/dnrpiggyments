<?php include 'manager/_pi/base.php'; ?>
	<? startblock('section') ?>
  <aside>
   <?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
     <? if(isset($_REQUEST['id'])):
			     $category = Category::findCategory($_REQUEST['id']);	?>
     	    <h1><?=$category->fldCategoryName?></h1>
     <? else: ?>
          <h1>Products</h1>
     <? endif ?> 
      <hr />
    </hgroup>
     <?
     if(isset($_REQUEST['id'])) {
			$count_record=Products::countProductsByCategory($_REQUEST['id']); 
		 } else {
	   		$count_record=Products::countProducts();
		 }

			if($count_record != 0) { 
				if(!isset($_REQUEST['page']))
					{
						$page = 1;
					}
					else
					{
					$page = $_GET[page];
					}
					$pagination = new Pagination;
					//for display
					if(isset($_REQUEST['pageid'])) {
						if($_REQUEST['pageid']=='all') {
							$pageCount = $count_record;
						} else {
							$pageCount = $_REQUEST['pageid'];
						}
					} else {
						$pageCount  = $count_record;
					}
					$pg = $pagination->page_pagination($pageCount, $count_record, $page, 20);
			} // if count record

					//$result_prod = mysql_query($query_Recordset2.$pg[1]);
					 if(isset($_REQUEST['id'])) {
						$product=Products::findAllByCategory($pg[1],$_REQUEST['id']);
					 } else {
						 $product=Products::findAll($pg[1]);
					 }
	   ?>   
    <ul class=list_style>
      <li><?=$count_record?> Item(s)</li>
      <li class=right>
        Show 
        <? if(isset($_REQUEST['id'])) { ?>
        	<select name="perPage" onChange="location.href='products-'+this.value+'-page-<?=$_REQUEST['id']?>-category.html'">
        <? } else { ?>
	        <select name="perPage" onChange="location.href='products-'+this.value+'-page.html'">
        <? } ?>    
         <? 
		 	if($_REQUEST['pageid']==8) {
				$selected8 = "selected='selected'";
		 	} else if($_REQUEST['pageid']==16) {
				$selected16 = "selected='selected'";
			} else if($_REQUEST['pageid']==32) {
				$selected32 = "selected='selected'";
			} else {
				$selectedall = "selected='selected'";
			}

		 ?>
          <option value="8" <?=$selected8?>>8</option>
          <option value="16" <?=$selected16?>>16</option>
          <option value="32" <?=$selected32?>>32</option>
          <option value="all" <?=$selectedall?>>All</option>
        </select> per page
      </li>
    </ul>
    
    <div id=product_list>
          
       	<? if($count_record == 0) { ?>
        	<div class="error">No Products Found</div>
        <? } else {
				foreach($product as $products) { 
					$pctr=$pctr+1;
					if($pctr==2) {
						$pClass = "class='last'";
					} else {
						$pClass = "";
					}
		?>
    	<? if($pctr==1) { ?><ul><? } ?>
      	<li <?=$pClass?>><dl>
        	<dt><img src="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" alt="<?=$products->fldProductsName?>" width="104"></dt>
          <dd>
          	<big>$<?=number_format($products->fldProductsPrice,2)?></big>
            <a href="products-details-<?=$products->fldProductsId?>.html" class=details>View Details</a>&nbsp;
            <!-- <a href="products_details.php?id=<?=$products->fldProductsId?>" class=details>View Details</a>&nbsp; -->

            <!-- //if product options is not available for product -->
            <?php
            $optionExists = TempCart::checkProductOption($products->fldProductsId);
            if ($optionExists==0) {
              ?>
              <a href="shopping-cart-product-<?=$products->fldProductsId?>.html" class=cart>Add to Cart</a>
              <!-- <a href="#" class=cart>Add to Cart</a> -->
              <?php
            }
            ?>

            <h3><?=$products->fldProductsName?></h3>
            <?=substr($products->fldProductsOverview,0,75)?> [...]
          </dd>
        </dl></li>
	    <? if($pctr==2) { $pctr=0;?></ul><? } ?>    
      	<? } //foreach?>
	 <? } //if count record?>
	
    
    </div>
  <?=$pg[0]?>

    <ul class=list_style>
      <li><?=$count_record?> Item(s)</li>
      <li class=right>
        Show 
        <? if(isset($_REQUEST['id'])) { ?>
        	<select name="perPage1" onChange="location.href='products-'+this.value+'-page-<?=$_REQUEST['id']?>-category.html'">
        <? } else { ?>
	        <select name="perPage1" onChange="location.href='products-'+this.value+'-page.html'">
        <? } ?>    
          <option value="8" <?=$selected8?>>8</option>
          <option value="16" <?=$selected16?>>16</option>
          <option value="32" <?=$selected32?>>32</option>
          <option value="all" <?=$selectedall?>>All</option>
        </select> per page
      </li>
    </ul>
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
