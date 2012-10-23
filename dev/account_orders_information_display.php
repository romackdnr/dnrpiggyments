<?php include 'manager/_pi/base.php'; ?>
<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];
		$myCart = Cart::findCartByOrderID($_REQUEST['id']);
		$clients = Client::findClient($myCart->fldCartClientID);
		$shipping = Shipping::findShippingClient($clients->fldClientID);
		$shippingRate = ShippingRate::findShippingRateByOrderCode($_REQUEST['id']);
	} else {
		header("Location: index.php");
	}
		
?>




	<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/account_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Order Information</h1>
      <hr />
    </hgroup>
	
    
      		 <table id="page_manager">
    
      <thead>
        <tr class="headers">
          <td colspan="5" style="padding:5px 5px">Order No: <?=$myCart->fldCartOrderNo?><br>
            Order Date: <?=date('F d, Y',strtotime($myCart->fldCartDate))?><br>
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
                                    <td width="69%" height="25" style="padding:5px 5px"><?=$clients->fldClientFirstName . ' ' . $clients->fldClientLastname?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Address</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$clients->fldClientAddress . ' ' . $clients->fldClientAddress1 . ' ' . $clients->fldClientCity . ' ' . $clients->fldClientState . ' ' . $clients->fldClientCountry . ' ' .$clients->fldClientZip?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Email Address</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$clients->fldClientEmail?></td>
                                </tr>
                                <tr>
                                	<td height="25" style="padding:5px 5px">Contact No</td>
                                    <td height="25" style="padding:5px 5px">:</td>
                                    <td height="25" style="padding:5px 5px"><?=$clients->fldClientPhoneNo?></td>
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
                      <td style="padding:5px 5px"><?=$carts->fldCartProductName?></td>
                      <td style="padding:5px 5px"><?=$carts->fldCartQuantity?></td>
                      <td style="padding:5px 5px">$<?=number_format($carts->fldCartProductPrice,2)?></td>
                      <td style="padding:5px 5px"><?=$total?></td>                                          
                    </tr>
        <? } }?>
           <?
		   	  
							$tax = $grandtotal *0.0875;
							$grandtotal = $grandtotal  + $shippingRate->fldShippingRateAmount + $tax; 
							
				
		   ?>
           		<tr>
            	<td colspan="5" align="right" style="padding:5px 5px"><strong>Tax  : $ <?=number_format($tax,2)?>
                </strong></td>
            </tr>
           
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
