<?php 
include 'manager/_pi/base.php';
$page1 = Pages::findPages(1);
?>

<? startblock('section') ?>
<aside>
	<?php include 'manager/includes/side_panel.php'; ?>
</aside>
<article>
  	<div id="hp_hdr">
    	<img src="assets/images/ajax_header.jpg">      
    </div>
    
    <div id="featured_products">
        <hgroup>
            <h2>Featured Products</h2>
            <hr />
        </hgroup>
        <? $product = Products::displayAllFeaturedProducts(); ?>
        <? foreach($product as $products):
            $nctr=$nctr+1;
            $pClass = ($nctr==2) ? "class='last'" : "";?>

            <? if($nctr==1) { ?><ul><? } ?>
            <li <?=$pClass?>><dl>
                <dt>
                    <img src="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" alt="<?=$products->fldProductsName?>" width="88">
                </dt>
                <dd>
                    <big>$<?=number_format($products->fldProductsPrice,2)?></big>
                    <a href="products-details-<?=$products->fldProductsId?>.html" class=details>View Details</a> &nbsp; 
                    <? $optionExists = TempCart::checkProductOption($products->fldProductsId);?>
                    <? if ($optionExists==0): ?>
                    <a href="shopping-cart-product-<?=$products->fldProductsId?>.html" class=cart>Add to Cart</a>
                    <? endif; ?>
                    <h3><?=$products->fldProductsName?></h3>
                    <?=substr($products->fldProductsOverview,0,75)?> [...]
                </dd>
                </dl>
            </li>
            <? if($nctr==2) {$nctr=0; ?></ul><? } ?>  
        <? endforeach ?> 
           
        <div class='clear right'>
            <a href="<?=$root?>products-all.html">View all products &raquo;</a>
        </div>      
    </div>
    
    <hr />
    
    <ul id="home_info_panel">
        <li>
            <hgroup>
                <h2>About Us</h2>
                <hr />
            </hgroup>
            <blockquote>
                <?=substr($page1->fldPagesDescription,0,200)?>... <a href="<?=$root?>about-us.html">Read more</a>
            </blockquote>
        </li>
        <li class="last">
            <hgroup>
            <h2>Customer Testimonials</h2>
            <hr />
            </hgroup>
            <? $testi = Testimonials::findTestimonialsHome();?>
            <blockquote>
                <?=$testi->fldTestimonialsDescription?>
                <!-- This section is for Testimonial Submitter. Do not move or re-place tag. -->
                <div class="testi_user"> <strong><?=$testi->fldTestimonialsName?></strong>, <?=$testi->fldTestimonialsWebsite?></div>
            </blockquote>
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
