<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];
	} else {
		$links = $ROOT_URL;
		header("Location: $links");
	}
	
	if(isset($_POST['continue'])) {
			
			//search all orders in tempcart
			$date = date('Y-m-d');
			$grandtotal = $_POST['grandtotal'];
			$order_code = $client_id .'-'.date('Ymd').'-'.rand(1,400);
			$status = 'New';
			$condition = "fldTempCartClientID='$client_id' AND fldTempCartDate='$date'";
			$ship_name = $_POST['ship_name'];
			$quote = $_POST['shipping'];
			
			$cart = Tempcart::findTempcartByCondition($condition);
			foreach($cart as $carts) {
				//get all info of tempcart
				$_POST = sanitize($_POST);
				$myCart = $_POST;
				settype($myCart,'object');
				
				$myCart->fldCartProductID = $carts->fldTempCartProductID;
				$myCart->fldCartClientID = $carts->fldTempCartClientID;
				$myCart->fldCartProductName = $carts->fldTempCartProductName;
				$myCart->fldCartProductPrice = $carts->fldTempCartProductPrice;
				$myCart->fldCartQuantity =$carts->fldTempCartQuantity;
				$myCart->fldCartOrderNo = $order_code;
				$myCart->fldCartCoupon = $_SESSION['coupon_code'];
				$myCart->fldCartStatus = $status;
				//save to cart
				Cart::addCart($myCart);	
				
				//SAVE THE SHIPPING RATE
				$_POST = sanitize($_POST);
				$shipping = $_POST;
				settype($shipping,'object');							
				$shipping->order_no = $order_code;
				$shipping->shipping_name = $ship_name;
				$shipping->shipping_amount = $quote;			
				ShippingRate::addShippingRate($shipping);
			}
			
			//remove order from tempcart
			Tempcart::deleteTempCartByCondition($condition);
			
			$client = Client::findClient($client_id);
			$shipping = Shipping::findShippingClient($client_id);
			
			if(isset($_SESSION['coupon_code'])) {
				unset($_SESSION['coupon_code']);
			}
									
	?>	
		<FORM action="https://secure.authorize.net/gateway/transact.dll" method="POST" name="form1">
		<? 
			include ("simdata.php");
			include ("simlib.php");
			
			
											
			srand(time());
			$sequence = rand(1, 1000);
			$x_Description = "DermalFX";
			$ret = InsertFP ($loginid, $x_tran_key, $grandtotal, $sequence);
			echo ("<input type=\"hidden\" name=\"x_description\" value=\"" . $x_Description . "\">\n" );
			echo ("<input type=\"hidden\" name=\"x_login\" value=\"" . $loginid . "\">\n");
			echo ("<input type=\"hidden\" name=\"x_amount\" value=\"" . $grandtotal . "\">\n");
			
			
		?>
					<input type="hidden" name="x_Invoice_Num" value="<?=$order_code?>" />
					<input type="hidden" name="x_First_Name" value="<?=$client->fldClientFirstName?>" />
					<input type="hidden" name="x_Last_Name" value="<?=$client->fldClientLastname?>" />
					<input type="hidden" name="x_Address" value="<?=$client->fldClientAddress . ' ' . $client->fldClientAddress1?>" />
					<input type="hidden" name="x_City" value="<?=$client->fldClientCity?>" />
					<input type="hidden" name="x_State" value="<?=$client->fldClientState?>" />
					<input type="hidden" name="x_Zip" value="<?=$client->fldClientZip?>" />
					<input type="hidden" name="x_Email" value="<?=$client->fldClientEmail?>" />
					<input type="hidden" name="x_Country" value="<?=$client->fldClientCountry?>" />
					
					<input type="hidden" name="x_Ship_To_First_Name" value="<?=$shipping->fldShippingFirstName?>" />
					<input type="hidden" name="x_Ship_To_Last_Name" value="<?=$shipping->fldShippingLastname?>" />
					<input type="hidden" name="x_Ship_To_Address" value="<?=$shipping->fldShippingAddress. ' '  . $shipping->fldShippingAddress1?>" />
					<input type="hidden" name="x_Ship_To_City" value="<?=$shipping->fldShippingCity?>" />
					<input type="hidden" name="x_Ship_To_State" value="<?=$shipping->fldShippingState?>" />
					<input type="hidden" name="x_Ship_To_Zip" value="<?=$shipping->fldShippingZip?>" />
					<input type="hidden" name="x_Ship_To_Country" value="<?=$shipping->fldShippingCountry?>" />
					
				    <INPUT type="hidden" name="x_relay_response" value="TRUE">
					<input type="hidden" name="x_relay_url" value="http://www.dermalfx.biz/dev/x_relay_url.php" />
					<INPUT type="hidden" name="x_show_form" value="PAYMENT_FORM">
					<INPUT type="hidden" name="x_test_request" value="TRUE">
                    <INPUT type="hidden" name="x_type" value="AUTH_CAPTURE">


				
	</FORM>
	
	<script language="javascript" type="text/javascript">
		document.form1.submit();
	</script>
<?
}
?>
	
<form method="post" action="<? $PHP_SELF; ?>">
<table width="755" border="0">
<tr>
	<td width="355">
    	<table border="0" cellpadding="1" cellspacing="1" bgcolor="#6B5983">
        	<tr>
            	<td height="25" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF">Billing Information</td>                
          </tr>
          <? 
		  	$client = Client::findClient($client_id);
		  ?>
          <tr bgcolor="#FFFFFF">
          	<td>
            	<table border="0">
                	<tr>
                        <td width="57" height="25">Name</td>
         	            <td width="3" height="25">:</td>
                        <td width="187" height="25"><?=$client->fldClientFirstName . ' ' . $client->fldClientLastname?></td>
		             </tr>
                     <tr>
                        <td height="25">Address</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$client->fldClientAddress . ' ' . $client->fldClientAddress1 . ' ' . $client->fldClientCity . ' ' . $client->fldClientState . ' ' . $client->fldClientCountry?></td>
		             </tr>
                     <tr>
                        <td height="25">Contact No</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$client->fldClientPhoneNo?></td>
		             </tr>
                     <tr>
                        <td height="25">Email Address</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$client->fldClientEmail?></td>
		             </tr>
                </table>
            </td>
          </tr>    
        </table>
    </td>
    <td width="390">
    	<table border="0" cellpadding="1" cellspacing="1" bgcolor="#6B5983">
        	<tr>
            	<td width="328" height="25" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF">Shipping Information</td>                
          </tr>
          <tr bgcolor="#FFFFFF">
          	<td>
             <? $shipping = Shipping::findShippingClient($client_id);?>
            	<table border="0">
                	<tr>
                        <td height="25">Name</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$shipping->fldShippingFirstName . ' ' . $shipping->fldShippingLastname?></td>
		             </tr>
                     <tr>
                        <td height="25">Address</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$shipping->fldShippingAddress . ' ' . $shipping->fldShippingAddress1 . ' ' . $shipping->fldShippingCity . ' ' . $shipping->fldShippingState . ' ' . $shipping->fldShippingCountry?></td>
		             </tr>
                     <tr>
                        <td height="25">Contact No</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$shipping->fldShippingPhoneNo?></td>
		             </tr>
                     <tr>
                        <td height="25">Email Address</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$shipping->fldShippingEmail?></td>
		             </tr>
                </table>
            </td>
          </tr>    
        </table>
    </td>
</tr>

</table>
<p>&nbsp;</p>
				<div id="blank">
					
                    
					<table width="100%" style="text-align:center;" bgcolor="#FFFFFF" cellpadding="0" cellspacing="1">

											
<tr style="background-color:#6B5983;color:#FFF; height:30px">
												
												<!--<td align=center><font class=default><B>No</B></font></td>-->
												<td align=center width="97%"><font face="Arial, Helvetica, sans-serif" size="2"><B>Item Name</B></font></td>
												<td align=center nowrap><font face="Arial, Helvetica, sans-serif" size="2"><B>Price</B> ($)</font></td>
												<td align=center width="1%"><B><font face="Arial, Helvetica, sans-serif" size="2">Qty</font></B></td>
												<td align=center nowrap><font face="Arial, Helvetica, sans-serif" size="2"><B>Item Total</B> ($)</font></td>
											</tr>
                                            <? 
												$date = date('Y-m-d');
												$condition = "fldTempCartClientID='$client_id' AND fldTempCartDate='$date'";
												$cart = Tempcart::findTempcartByCondition($condition);
												if(Tempcart::countTempcartbyCondition($condition)==0) {
											?>
                                            <tr>
                                            	<td colspan="5" class="error">Your shopping cart is empty</td>
                                            </tr>
											<?
												} else {
													foreach($cart as $carts) {
													$trClass = ($row_ctr%2==0) ? 'bgcolor="#F5F5F5"' : 'bgcolor="#FFFFFF"';
													
											?>
													
													<tr <?=$trClass?>>
														

														<td valign="middle" align="center">
														<?
															$products = Products::findProducts($carts->fldTempCartProductID);
															 
															$weight = $weight + $products->fldProductsWeight;
									
														?>
														<img src="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" alt="" border=0 align="left"  width="75">
														
															
														<table border="0">
                                                        <tr><td align="left">
														<B><font face="Arial, Helvetica, sans-serif" size="2"><?=$carts->fldTempCartProductName?></font></B><br />                              </td></tr>																																																																																							                                                                                                               	                                                        
                                                  </table>
															
															
																</td>
														<td
															onmousedown="setCheckboxRow('document.item_form.cbid','<?=$row_ctr?>');"
															 align=right><font face="Arial, Helvetica, sans-serif" size="2"><?=number_format($carts->fldTempCartProductPrice,2)?></font></td>
	 															
															
														<td align=center><font class=default><?=$carts->fldTempCartQuantity?> 
                                                             <input type="hidden" name="cartId[]" value="<?=$carts->fldTempCartID?>" />
                                                             </td>
															
														<td align=right>
                                                        <font face="Arial, Helvetica, sans-serif" size="2">
                                                        	<?
																$subtotal = $carts->fldTempCartProductPrice * $carts->fldTempCartQuantity;
																echo number_format($subtotal,2);
															?>
                                                          </font>
														</td>
													</tr>
													<?
													$grandtotal += $subtotal;													
													$row_ctr++;
												}

												}
												?>
                                                
                                                <tr style="background-color:#6B5983;color:#FFF; height:30px">
													<td colspan=3 align="right"><font color="#FFFFFF">
														<B><font face="Arial, Helvetica, sans-serif" size="2">Sub Total ($) :</font></B>
													</font></td>
													<td align=right><B>
                                                    <font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">
														<?
															echo number_format($grandtotal,2);
														?>
                                                        </font>
													</B></td>
												</tr>
                                                
                                                <? if(isset($_SESSION['coupon_code'])) {
														$coupon = Coupon::findCouponByCode($_SESSION['coupon_code']);			
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
														
														$grandtotal = $grandtotal - $discAmount;
												?>
                                                	<tr style="background-color:#6B5983;color:#FFF; height:30px">
													<td colspan=3 align="right"><font color="#FFFFFF">
														<B><font face="Arial, Helvetica, sans-serif" size="2">Coupon Code (<?=$_SESSION['coupon_code']?>) $: </font></B>
													</font></td>
													<td align=right><B>
                                                    <font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">
														<?
															if(isset($_SESSION['FreeShipping'])) {
																echo 'Free Shipping';
															} else {
																echo '(-)'.number_format($discAmount,2);
															}
														?>
                                                        </font>
													</B></td>
												</tr>
                                                <? } ?>
                                                 <? if(isset($_POST['optShipping'])) { 
																$area_code = $shipping->fldShippingZip;
						
																$country = $shipping->fldShippingCountry;
														?>
												
												<? 
														if($_POST['optShipping']=='1DM') { 
															$ship_name = 'Next Day Air Early AM';
														} else if($_POST['optShipping']=='1DA') { 
															$ship_name = 'Next Day Air';
														} else if($_POST['optShipping']=='1DP') { 
															$ship_name = 'Next Day Air Saver';
														} else if($_POST['optShipping']=='2DM') { 
															$ship_name = '2nd Day Air Early AM';
														} else if($_POST['optShipping']=='2DA') { 
															$ship_name = '2nd Day Air';
														} else if($_POST['optShipping']=='3DS') { 
															$ship_name = '3 Day Select';
														} else if($_POST['optShipping']=='GND') { 
															$ship_name = 'Ground';
														} else if($_POST['optShipping']=='STD') { 
															$ship_name = 'Canada Standard';
														} else if($_POST['optShipping']=='XPR') { 
															$ship_name = 'Worldwide Express';
														} else if($_POST['optShipping']=='XDM') { 
															$ship_name = 'Worldwide Express Plus';
														} else if($_POST['optShipping']=='XPD') { 
															$ship_name = 'Worldwide Expedited';
														} 												
													?>
                                                    <tr style="background-color:#6B5983;color:#FFF; height:30px">
													<td colspan=3 align="right"><font color="#FFFFFF">
														<B><font face="Arial, Helvetica, sans-serif" size="2"><b>Shipping (<?=$ship_name?>) :</b> $: </font></B>
													</font></td>
													
                                                
												  
													<?php
															require("ups/ups.php"); 
															$rate = new Ups; 
															$rate->upsProduct($_POST['optShipping']);   // See upsProduct() function for codes 
															$rate->origin("92121", "US"); // Use ISO country codes! 
															$rate->dest($area_code, $country);   // Use ISO country codes! 
															$rate->rate("RDP");     // See the rate() function for codes 
															$rate->container("CP"); // See the container() function for codes 
															$rate->weight($weight); 
															$rate->rescom("RES");   // See the rescom() function for codes 
															$quote = $rate->getQuote(); 
															
															$grandtotal = $grandtotal + $quote;
													?>
                                                    <td align=right><B>
                                                    <font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">
														<?
															if(isset($_SESSION['FreeShipping'])) {
																echo 'Free Shipping';
															} else {
																echo '(+) $'.number_format($quote,2);
															}
														?>
                                                        </font>
													</B></td>
												</tr>
												</tr>
												<? } else { $quote = 0;?>
													
												<? } ?>
												<tr style="background-color:#6B5983;color:#FFF; height:30px">
													<td colspan=3 align="right"><font color="#FFFFFF">
														<B><font face="Arial, Helvetica, sans-serif" size="2">Grand Total ($) :</font></B>
													</font></td>
													<td align=right><B>
                                                    <font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">
														<?
															echo number_format($grandtotal,2);
														?>
                                                        </font>
													</B></td>
												</tr>
												</table>
                                                
					<br />
                    <input type="hidden" name="shipping" value="<?=$quote?>" />
					<input type="hidden" name="ship_name" value="<?=$ship_name?>" />
                    <input type="hidden" name="grandtotal" value="<?=$grandtotal?>" />
                    <input name="continue" type="submit" id="continue" value="Pay Now" />
					<br />
<div class="cls"></div>

					

				</div>
                </form>