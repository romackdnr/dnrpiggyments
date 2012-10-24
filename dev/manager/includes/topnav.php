<?	
if(isset($_SESSION['client_id'])) {
	$client_id = $_SESSION['client_id'];
	$links = "account-information.php";
	$linksCheckout = "billing-info.html";
} else {
	$client_id = session_id();
	$links = "login.html";
	$linksCheckout = "login.html";
}

$date = date('Y-m-d');
$condition = "fldTempCartClientID='$client_id' AND fldTempCartDate='$date'";
$itemsCount = Tempcart::countTempcartbyCondition($condition);
$total = Tempcart::computeTempCartTotalPrice($condition);
$option = Tempcart::getTempCartProductOption($condition);

foreach ($option as $options) {
    $product_option= $options->fldTempCartOptions;
    $product_id    = $options->fldTempCartProductID;
    $prodOptionTotal    = Tempcart::computeTempCartProductOptionTotalPrice($product_option, $product_id);
    $optionCost += $prodOptionTotal->totalProdOptionPrice;
}
?>
<ul>
  	<li id="topmenu">

        <? if($_SESSION['logged_in']):?>
            <a href="<?=$root?><?=$links?>" title="My Account">My Account</a>
            <a href="<?=$root?>shopping-cart.html" title="My Cart">My Cart</a>
            <a href="<?=$root?>logout.php" title="Customer Logout">Logout</a>   
        <? else: ?>
            <a href="<?=$root?>shopping-cart.html" title="My Cart">My Cart</a>
            <a href="<?=$root?>login.html" title="Customer Login">Customer Login</a>
        <? endif ?>

    </li>
    <li id="cartbox">
    	<dl>
      	<dt>Items in cart: <strong><?=$itemsCount?></strong></dt>
        <dt>Total: <strong>$<?=number_format((($total->totalPrice) + $optionCost),2)?></strong></dd>
        <dd><a href="<?=$root?><?=$linksCheckout?>" class="checkout" title="Checkout">Checkout &raquo;</a></dd>
      </dl>
    </li>
</ul>
