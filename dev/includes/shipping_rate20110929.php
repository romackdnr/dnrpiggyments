<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];
	} else {
		$links = $ROOT_URL;
		header("Location: $links");
	}
	
	
		
?>
<style>
	td {padding:5px 5px;}
</style>
<p>&nbsp;</p>	<p>&nbsp;</p>	
<form method="post" action="<?=$ROOT_URL?>order-confirmation.html">
<table width="713" border="0">
<tr>
	<td width="361">
    	<table width="347" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
        	<tr>
            	<td height="25" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF">Billing Information</td>                
          </tr>
          <? 
		  	$client = Billing::findBillingClient($client_id);
		  ?>
          <tr bgcolor="#FFFFFF">
          	<td>
            	<table border="0">
                	<tr>
                        <td width="96" height="25">Name</td>
         	            <td width="11" height="25">:</td>
                        <td width="215" height="25"><?=$client->fldBillingFirstName . ' ' . $client->fldBillingLastname?></td>
		             </tr>
                     <tr>
                        <td height="25">Address</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$client->fldBillingAddress . ' ' . $client->fldBillingAddress1 . ' ' . $client->fldBillingCity . ' ' . $client->fldBillingState . ' ' . $client->fldBillingCountry?></td>
		             </tr>
                     <tr>
                        <td height="25">Contact No</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$client->fldBillingPhoneNo?></td>
		             </tr>
                     <tr>
                        <td height="25">Email Address</td>
         	            <td height="25">:</td>
                        <td height="25"><?=$client->fldBillingEmail?></td>
		             </tr>
                </table>
            </td>
          </tr>    
        </table>
    </td>
    <td width="369">
    	<table border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
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

											
<tr style="background-color:#666666;color:#FFF; height:30px">
												
												<!--<td align=center><font class=default><B>No</B></font></td>-->
												<td align=center width="70%"><font face="Arial, Helvetica, sans-serif" size="2"><B>Item Name</B></font></td>
												<td align=right nowrap width="10%"><font face="Arial, Helvetica, sans-serif" size="2"><B>Price</B> ($)</font></td>
												<td align=center width="10%"><B><font face="Arial, Helvetica, sans-serif" size="2">Qty</font></B></td>
												<td align=right nowrap width="10%"><font face="Arial, Helvetica, sans-serif" size="2"><B>Item Total</B> ($)</font></td>
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
                                               <? if($client->fldBillingState == "CA") { ?>
<tr style="background-color:#666666;color:#FFF; height:30px">
													<td colspan=3 align="right"><font color="#FFFFFF">
														<B><font face="Arial, Helvetica, sans-serif" size="2">Tax ($) :</font></B>
													</font></td>
													<td align=right><B>
                                                    <font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">
														<?
															$tax = $grandtotal * .0875;
															echo ' (+) '.number_format($tax,2);
															$grandtotal = $grandtotal + $tax;
														?>
                                                        </font>
													</B></td>
												</tr>
                                             <? } ?>   
<tr style="background-color:#666666;color:#FFF; height:30px">
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
                                                 <? if($weight!='0') { ?>
                <!--                                 
                <tr bgcolor="#FFFFFF">
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000; margin-top:10px;" colspan="4"><span class="style7"><strong>Shipping Method</strong> </span><br />
                    <br />
                    <span class="style5">Please select the preferred shipping method to use on this order. </span><br />
                    <br />
                    <span class="style4">UNITED PARCEL SERVICE  (Weight : <?=$weight?>) <img src="<?=$ROOT_URL?>assets/images/ups.jpg" /></span><br />
                    <br />
                    <?
						/**********************
						$area_code = $shipping->fldShippingZip;
						
						$country = $shipping->fldShippingCountry;
							
						$weight = $weight;
					?>
                    <br />
                    <table width="50%" border="0" cellspacing="1" bgcolor="#333333">
                      <?php
							require("ups/ups.php"); 
						    $rate = new Ups; 
						  	$rate->upsProduct("1DM");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td width="50"><div align="center">
                            <input name="optShipping" type="radio" value="1DM" checked="checked"/>
                        </div></td>
                        <td width="255" class="body_text">Next Day Air Early AM</td>
                        <td width="99" class="body_text"><? 						    
						    echo '$'. number_format($quote,2); 
						?>                        </td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("1DA");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="1DA" />
                        </div></td>
                        <td class="body_text">Next Day Air </td>
                        <td class="body_text"><?php						  	
						    echo '$'. number_format($quote,2);
						  ?>                        </td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("1DP");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="1DP" />
                        </div></td>
                        <td class="body_text">Next Day Air Saver </td>
                        <td class="body_text"><?php
						    echo '$'. number_format($quote,2);
						  ?>                        </td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("2DM");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="2DM" />
                        </div></td>
                        <td class="body_text">2nd Day Air Early AM</td>
                        <td class="body_text"><?php
						    echo '$'. number_format($quote,2);
						  ?>                        </td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("2DA");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="2DA" />
                        </div></td>
                        <td class="body_text">2nd Day Air</td>
                        <td class="body_text"><?php echo '$'. number_format($quote,2); ?></td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("3DS");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="3DS" />
                        </div></td>
                        <td class="body_text">3 Day Select </td>
                        <td class="body_text"><?php echo '$' . number_format($quote,2);?></td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("GND");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="GND"/>
                        </div></td>
                        <td class="body_text">Ground </td>
                        <td class="body_text"><?php echo '$' . number_format($quote,2); ?></td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("STD");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="STD" />
                        </div></td>
                        <td class="body_text">Canada Standard</td>
                        <td class="body_text"><?php echo '$' . number_format($quote,2); ?></td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("XPR");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="XPR" />
                        </div></td>
                        <td class="body_text">Worldwide Express</td>
                        <td class="body_text"><?php echo '$' . number_format($quote,2); ?></td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("XDM");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="XDM" />
                        </div></td>
                        <td class="body_text">Worldwide Express Plus</td>
                        <td class="body_text"><?php echo '$' . number_format($quote,2); ?></td>
                      </tr>
                      <?php } ?>
                      <?php
						  	$rate->upsProduct("XPD");   // See upsProduct() function for codes 
						    $rate->origin("92121", "US"); // Use ISO country codes! 
						    $rate->dest($area_code, $country);   // Use ISO country codes! 
						    $rate->rate("RDP");     // See the rate() function for codes 
						    $rate->container("CP"); // See the container() function for codes 
						    $rate->weight($weight); 
						    $rate->rescom("RES");   // See the rescom() function for codes 
						    $quote = $rate->getQuote(); 
					    *****************/		
					?>
                      <?php if(number_format($quote,2) != "0.00") { ?>
                      <tr bgcolor="#CCCCCC">
                        <td><div align="center">
                            <input name="optShipping" type="radio" value="XPD" />
                        </div></td>
                        <td class="body_text">Worldwide Expedited </td>
                        <td class="body_text"><?php echo '$' . number_format($quote,2); ?></td>
                      </tr>
                      <?php } ?>
                     
                    </table></td>
                </tr>
                -->
				 <? } ?>
		      </table>
                                                
					<br />
                    <input type="hidden" name="grandtotal" value="<?=$grandtotal?>" />
                    <input name="continue_confirmation" type="submit" id="continue" value="Continue" />
					<br />
<div class="cls"></div>

					

				</div>
                </form>