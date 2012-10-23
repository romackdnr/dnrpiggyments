<?php 
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include_once "../../../includes/bootstrap.php";    
include   "../../../classes/Cart.php";
include   "../../../classes/Coupon.php";
include   "../../../classes/Client.php";
include   "../../../classes/ShippingRate.php";
include   "../../../classes/Products.php";
include   "../../../classes/Shipping.php";
include   "../../../classes/Billing.php";
include   "../../../classes/AdminAction.php";
include   "../../../includes/security.funcs.inc";
include_once "../../../includes/Pagination.php";   

//delete photo
if(isset($_REQUEST['delete'])) {
	Cart::deleteCart($_REQUEST['delete']);
	
	$updates = 'Delete cart content';
  	  AdminAction::addAdminAction($_SESSION['admin_name'],$updates);
}
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
	  		<li></li>
        </ul>
  
    <h3>Order Overview</h3>
  
    <table id="page_manager">
    
      <thead>
        <tr class="headers">
         
          <td width="410">Order No</td>   
          <td width="410">Name</td>        
          <td width="410">Items #</td>
          <td width="410">Total Amount</td>   
          <td width="410">Status</td>
          
          <td width="150" align="center">Action</td>
        </tr>
      </thead>
    
      <tbody id="alter_rows">
        <?php
				 $count_record=Cart::counCart();
				 
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
					$cart=Cart::findAll($pg[1]);
			?>
		  	<? if($count_record == 0) { ?>
            	  <tr>
                  	<td colspan="6" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Orders Found</td>
                  </tr>
            <? } else { 
					foreach($cart as $carts) { 
					  $clients = Client::findClient($carts->fldCartClientID);
					  $countItem = Cart::counCartByOrderNo($carts->fldCartOrderNo);
					  $getTotal = Cart::getTotalCartByOrderNo($carts->fldCartOrderNo);
					  $shippingRate = ShippingRate::findShippingRateByOrderCode($carts->fldCartOrderNo);					  
					  $shipping = Shipping::findShippingClient($clients->fldClientID);
					  $billing = Billing::findBillingClient($clients->fldClientID);

					  if($carts->fldCartCoupon != '') {
						  $coupon = Coupon::findCouponByCode($carts->fldCartCoupon);			
							if($coupon->fldCouponPrice != '') {
								$discAmount = $coupon->fldCouponPrice;		
								unset($_SESSION['FreeShipping']);
							} else if($coupon->fldCouponPercent != '') {
								$percent = $coupon->fldCouponPercent / 100;
								$discAmount = $getTotal->totalPrice * $percent;
								unset($_SESSION['FreeShipping']);
							} else {
								$_SESSION['FreeShipping'] = 1;		
								$discAmount = 0;
							}
							
							$total = ($getTotal->totalPrice - $discAmount) + $shippingRate->fldShippingRateAmount; 
					  } else {
						  $total = $getTotal->totalPrice + $shippingRate->fldShippingRateAmount;
					
					  }
					  
				if($billing->fldBillingState == "CA") {
						$stateTax = "CA";
				} else if($shipping->fldShippingState == "CA") {
						$stateTax = "CA";
				} else {
						$stateTax = "";
				}
				
				
					 
					 $tax = $getTotal->totalPrice * .0925;
					
					 $total = $total + $tax;
					  
					  
			?>
            
                    <tr>
                      <td> <?=$carts->fldCartOrderNo?></td>
                      <td><?=$clients->fldClientFirstName . ' ' . $clients->fldClientLastname?></td>
                      <td><?=$countItem?></td>
                      <td><?=number_format($total,2)?></td>
                      <td><?=$carts->fldCartStatus?></td>
                     
                      <td align="center"><a href="<?=$ROOT_URL?>_admin/modules_orders/preview/<?=$carts->fldCartOrderNo?>/"><img src="<?=$ROOT_URL?>_admin/_modules/mods_order/images/preview.png" width="14" height="16" alt="mod" /></a> <a href="<?=$ROOT_URL?>_admin/modules_orders/delete/<?=$carts->fldCartID?>/" title="Delete Page" onClick="return confirm(&quot;Are you sure you want to completely remove this Orders from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Orders.\n&quot;)"><img src="<?=$ROOT_URL?>_admin/_modules/mods_blog/images/delete.gif" width="16" height="16" alt="del" /></a> </td>
                    </tr>
        <? } }?>
       
      </tbody>
      
      <tfoot>
      <th colspan="6" align="right" height="30">
          <dl>
            <dt class="col1"><?=$pg[0]?></dt>
            <dd class="col2"></dd>
          </dl>
        </th>
      </tfoot>
    
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