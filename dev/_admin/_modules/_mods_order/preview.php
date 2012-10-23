<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Cart.php";
include   "../../../classes/Products.php";
include   "../../../classes/Client.php";
include   "../../../classes/Coupon.php";
include   "../../../classes/Shipping.php";
include   "../../../classes/Billing.php";
include   "../../../classes/ShippingRate.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

$myCart = Cart::findCartByOrderID($_REQUEST['id']);
$clients = Client::findClient($myCart->fldCartClientID);
$shipping = Shipping::findShippingClient($clients->fldClientID);
$shippingRate = ShippingRate::findShippingRateByOrderCode($_REQUEST['id']);
$billing = Billing::findBillingClient($clients->fldClientID);
?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/core3.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$ROOT_URL?>_admin/_assets/css/modules.css" /> 
</head>

<body onLoad="javascript:alternatecolor('alter_rows');">

	<div id="blog_overview">
    	<ul class="btn">
		  <li><a href="<?=$ROOT_URL?>_admin/modules_orders/view/">Back</a></li>
        </ul>
  
    <h3>Order Overview</h3>
  
    <table id="page_manager">
    
      <thead>
        <tr class="headers">
          <td colspan="5" style="padding:5px 5px">Order No: <?=$myCart->fldCartOrderNo?><br>
            Order Date: <?=date('F d, Y',strtotime($myCart->fldCartDate))?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$myCart->fldCartTime?><br>
            Transaction No : <?=$myCart->fldCartTransactionNo?>
            </td>
        </tr>
        <tr class="headers">
          <td colspan="5">
          		<table width="100%" border="0">
                	<tr>
                    	<td width="50%">
                        	<table border="0" width="100%">
                            	<tr>
                                	<td height="25" colspan="3" style="padding:5px 5px"><strong>Billing Information</strong></td>
                                </tr>
                                <tr>
                                	<td width="29%" height="25" style="padding:5px 5px">Name</td>
                                    <td width="2%" height="25" style="padding:5px 5px">:</td>
                                    <td width="69%" height="25" style="padding:5px 5px"><?=$billing->fldBillingFirstName . ' ' . $billing->fldBillingLastname?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Address</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$billing->fldBillingAddress . ' ' . $billing->fldBillingAddress1 . ' ' . $billing->fldBillingCity . ' ' . $billing->fldBillingState . ' ' . $billing->fldBillingCountry . ' ' .$billing->fldBillingZip?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Email Address</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$billing->fldBillingEmail?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Contact No</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$billing->fldBillingPhoneNo?></td>
                                </tr>
                            </table>
                            
                        </td>
                        <td width="50%">
                        	<table border="0" width="100%">
                            	<tr>
                                	<td height="25" colspan="3" style="padding:5px 5px"><strong>Shipping Information</strong></td>
                                </tr>
                                <tr>
                                	<td width="33%" height="25" style="padding:5px 5px">Name</td>
                                    <td width="2%" height="25" style="padding:5px 5px">:</td>
                                    <td width="65%" height="25" style="padding:5px 5px"><?=$shipping->fldShippingFirstName . ' ' . $shipping->fldShippingLastname?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Address</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$shipping->fldShippingAddress . ' ' . $shipping->fldShippingAddress1 . ' ' . $shipping->fldShippingCity . ' ' . $shipping->fldShippingState . ' ' . $shipping->fldShippingCountry . ' ' . $shipping->fldShippingZip?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Email Address</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$shipping->fldShippingEmail?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Contact No</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$shipping->fldShippingPhoneNo?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
          </td>          
        </tr>
        <tr class="headers">
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="headers">         
          <td width="410"></td>   
          <td width="410" style="padding:5px 5px">Product Name</td>        
          <td width="410" style="padding:5px 5px">Quantity</td>
          <td width="410" style="padding:5px 5px">Price</td>   
          <td width="410" style="padding:5px 5px">Sub Total</td>                   
        </tr>
      </thead>
    
      <tbody id="alter_rows">
        <?php
				$order_id = $_REQUEST['id'];
				 $count_record=Cart::counCartByOrderNo($order_id);
				 
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
					$pg = $pagination->page_pagination(20, $count_record, $page, 20);
					//$result_prod = mysql_query($query_Recordset2.$pg[1]);
					$cart=Cart::displayAllByOrders($order_id);
			?>
		  	<? if($count_record == 0) { ?>
            	  <tr>
                  	<td colspan="6" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Orders Found</td>
                  </tr>
            <? } else { 
					foreach($cart as $carts) { 
					  $products = Products::findProducts($carts->fldCartProductID);
					  $total = $carts->fldCartQuantity  * $carts->fldCartProductPrice;
					  $grandtotal = $grandtotal + $total;
			?>
            
                    <tr>
                      <td style="padding:5px 5px"><img src="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" width="75"></td>
                      <td style="padding:5px 5px"><?=$carts->fldCartProductName?>
							                      		<? 
															if($carts->fldTempCartOptions != "") {																
																echo "<br><br>Options " . $carts->fldTempCartOptions;
															}
													    ?>
                      </td>
                      <td style="padding:5px 5px"><?=$carts->fldCartQuantity?></td>
                      <td style="padding:5px 5px">$<?=number_format($carts->fldCartProductPrice,2)?></td>
                      <td style="padding:5px 5px"><?=$total?></td>                                          
                    </tr>
        <? } }
		
				if($billing->fldBillingState == "CA") {
						$stateTax = "CA";
				} else if($shipping->fldShippingState == "CA") {
						$stateTax = "CA";
				} else {
						$stateTax = "";
				}
				
				if($stateTax == "CA") {
					$tax = $grandtotal * .0925;
				} else {
					$tax =0;
				}
		?>
        
		
           <?
		   	   if($carts->fldCartCoupon != '') {
						  $coupon = Coupon::findCouponByCode($carts->fldCartCoupon);			
							if($coupon->fldCouponPrice != '') {
								$discAmount = $coupon->fldCouponPrice;		
								unset($_SESSION['FreeShipping']);
							} else if($coupon->fldCouponPercent != '') {
								$percent = $coupon->fldCouponPercent / 100;
								$discAmount = $grandtotal * $percent;
								unset($_SESSION['FreeShipping']);
							} else {
								$_SESSION['FreeShipping'] = 1;		
								$discAmount = 0;
							}
							
							$grandtotal = ($grandtotal - $discAmount) + $shippingRate->fldShippingRateAmount; 
				
		   ?>
           		<tr>
            	<td colspan="5" align="right" style="padding:5px 5px"><strong>Coupon Code (<?=$carts->fldCartCoupon?>) : $
                <?
															if(isset($_SESSION['FreeShipping'])) {
																echo 'Free Shipping';
															} else {
																echo '(-) '.number_format($discAmount,2);
															}
														?>
                </strong></td>
            </tr>
           <? } else {
			  		 $grandtotal = $grandtotal + $shippingRate->fldShippingRateAmount;
		   	  }
		   ?>
            <?
				if($billing->fldBillingState == "CA") {
						$stateTax = "CA";
				} else if($shipping->fldShippingState == "CA") {
						$stateTax = "CA";
				} else {
						$stateTax = "";
				}
												?>
            <? if($stateTax == "CA") { ?>
<tr style="height:30px">
													<td colspan=5 align="right" style="padding:5px 5px">
														<strong>Tax ($) :
                                                  
														<?
															
															echo ' (+) '.number_format($tax,2);
															$grandtotal = $grandtotal + $tax;
														?></strong>
                                                      </td>
												</tr>
                                             <? } ?>   
           <tr>
            	<td colspan="5" align="right" style="padding:5px 5px"><strong>Shipping (<?=$shippingRate->fldShippingRateName?>) : $
                (+) <?=number_format($shippingRate->fldShippingRateAmount,2);?>
                </strong></td>
            </tr>
        	<tr>
            	<td colspan="5" align="right" style="padding:5px 5px"><strong>Grand Total : $<?=number_format($grandtotal,2)?></strong></td>
            </tr>
       
      </tbody>
      
     
    </table>
    <!-- /End Fetching Data Tables -->
    
   
  
</div>

<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/alternate_color.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon.js"></script>
<script type="text/javascript" src="<?=$ROOT_URL?>_admin/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>