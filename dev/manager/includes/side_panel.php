 <h2>Our Products</h2>
<menu>
	<? $category = Category::displayAllCategory(0);?>
	<? foreach($category as $categories):
		$ctr=0;
		$subcat = Category::displayAllCategory($categories->fldCategoryID);
		$subcatCount = Category::countCategory($categories->fldCategoryID);
		?>
		<? if(empty($subcat)): ?>
	  		<li><a href="products-<?=$categories->fldCategoryID?>.html"><?=$categories->fldCategoryName?></a></li>
	    <? else: ?>
	    	<li class=parentmenu><?=$categories->fldCategoryName?>
	        <ul class=childmenu>
			<? foreach($subcat as $subcats):
				$ctr=$ctr+1;
				$class = ($ctr==$subcatCount) ? "class='lstmenu'" : ""; ?>
				<li <?=$class?>><a href="products-<?=$subcats->fldCategoryID?>.html"><?=$subcats->fldCategoryName?></a></li>
		  	<? endforeach ?>
	    	</ul>		
		<? endif ?>
	<? endforeach ?>
</menu>

<h2>Follow Us</h2>
<ul class=socialnetwork>
	<li><a href="http://www.facebook.com/piggyments"><img src="assets/images/social-facebook.png" width="24" height="24" alt="Facebook"> Become a Fan</a></li>
	<li><a href="https://twitter.com/piggyments"><img src="assets/images/social-twitter.png" width="24" height="24" align="Twitter"> Follow us on Twitter</a></li>
</ul>
<pre>
	<? print_r($_SESSION); ?>
</pre>
