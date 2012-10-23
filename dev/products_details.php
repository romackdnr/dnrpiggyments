<?php include 'manager/_pi/base_products.php'; 

?>

	<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Products</h1>
      <hr />
    </hgroup>
    <div id=product_list>
      	<ul id=product_info>
        	<li class=product_photo>
          	<a href="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" rel="shadowbox"><img src="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" alt="<?=$products->fldProductsName?>"></a>
          	<small>Double click on above image to view full picture</small>
          </li>
          <li class=product_details>
          	<h3><?=$products->fldProductsName?></h3>
            <?
				if($products->fldProductsAvailability == 1) {
					$available = "In stock.";
				} else {
					$available = "Out of stock.";
				}
			?>
            <p>Availability: <?=$available?></p>
            <big>$<?=number_format($products->fldProductsPrice,2)?></big>
            <form action="shopping-cart.html" method="post">
			<?
				$optionCat = OptionsCategory::displayAllOptionsCategory();
				$ctr=0;
				foreach($optionCat as $optionsCat) {
					if(ProductsOption::countProductOptionsByCategory($_REQUEST['id'],$optionsCat->fldOptionsCategoryID)>=1) {
						//$option = Options::displayAllOptions($optionsCat->fldOptionsCategoryID);
						$option = ProductsOption::displayAllProductOptionsCategory($_REQUEST['id'],$optionsCat->fldOptionsCategoryID);
			?>
            			<p><strong><?=$optionsCat->fldOptionsCategoryName?> </strong>
                        <select name="options[<?=$ctr?>][<?=$optionsCat->fldOptionsCategoryName?>]" class=":required" >
                        	<option value="">Select <?=$optionsCat->fldOptionsCategoryName?></option>
                        	<? foreach($option as $options) {  
									$optionName = Options::findOptions($options->fldProductsOptionMainId);
							?>                            
				          		<option value="<?=$options->fldProductsOptionID?>" > <?=$optionName->fldOptionsName . ' - (+) $' . number_format($options->fldProductsOptionAmount,2)?> </option>
					          <? } ?>
                              </select>
                        </p>                        
            		<? } ?>
            <? $ctr=$ctr+1;} ?>
                <input type="hidden" name="product_id" value="<?=$products->fldProductsId?>">
            	<strong>Qty:</strong> <input type="text" maxlength="5" size="3" name="quantity" value="1"> 
                <button type="submit">Add to Cart</button>
            </form>
            <dl>
            	<dt>Quick Overview</dt>
              <dd><?=$products->fldProductsOverview?></dd>
            </dl>
          </li>
        </ul>
    
        <div class=clear><!-- Clear Section --></div>
        
        <div class="tab_info">
          <ul class="ui_tabs">
            <li id="page1">Product Description</li>
            <li id="page2">We Also Recommend</li>
            <li id="page3">Additional Information</li>
          </ul>
        
          <div class=clear><!-- Clear Section --></div>
        
          <div class="user_description">
            <div id="tab-page1">
             <?=$products->fldProductsDescription?> 
            </div>
            <div id="tab-page2">
            	<?
					$productsR = Products::findProductsRecommended($_REQUEST['id'],$products->fldProductsCategoryID);					
				?>
            	<img src="<?=$ROOT_URL?>products_image/<?=$productsR->fldProductsImage?>" width="104" alt="" align="left" style="float:left;margin:0 20px 10px 0;">
              <?=$productsR->fldProductsOverview?>
              <p><a href="products-details-<?=$productsR->fldProductsId?>.html">Click here to view &raquo;</a></p>
            </div>
            <div id="tab-page3">
             <?=$products->fldProductsInformation?>
            </div>
          </div>
        </div>      
    
    </div>
  </article>
	<? endblock() //end section ?>





<? startblock('headercodes') ?>
<link rel="stylesheet" href="<?=$root?>assets/sb/shadowbox.css">
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>

head.js('assets/js/jvalidates.min.js');
head.js('assets/sb/shadowbox.js');

head.ready(function() {

	Shadowbox.init({ modal:true });
  
  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

  $('#page1').addClass('on');
  $('#page1').click(function() {
    //Button
    $('#page1').addClass('on');
    $('#page2, #page3').removeClass('on');
    //Profile Info
    $("#tab-page1").show();
    $("#tab-page2, #tab-page3").hide();
  });
  $('#page2').click(function() {
    //Button
    $('#page2').addClass('on');
    $('#page1, #page3').removeClass('on');
    //Profile Info
    $("#tab-page2").show();
    $("#tab-page1, #tab-page3").hide();
  });
  $('#page3').click(function() {
    //Button
    $('#page3').addClass('on');
    $('#page2, #page1').removeClass('on');
    //Profile Info
    $("#tab-page3").show();
    $("#tab-page2, #tab-page1").hide();
  });

});
<? endblock() //end extracodes ?>
