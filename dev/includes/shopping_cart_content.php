<form method="post" action="<?=$ROOT_URL?>shopping-cart-info.html">

	<div id="blank">

		<br />

		<table width="100%" style="text-align:center;" bgcolor="#FFFFFF" cellpadding="0" cellspacing="1">

		<input type="hidden" id=opt name="option[]" value="">

		<input type="hidden" name="redirect" value="<?=$_SERVER["SCRIPT_NAME"]?>">

		<tr style="background-color:#666666;color:#FFF; height:30px">

			<td align=center width="5%">&nbsp;</td>

			<!--<td align=center><font class=default><B>No</B></font></td>-->

			<td align=center width="65%"><font face="Arial, Helvetica, sans-serif" size="2"><B>Item Name</B></font></td>

			<td align=right nowrap width="10%"><font face="Arial, Helvetica, sans-serif" size="2"><B>Price</B> ($)</font></td>

			<td align=center width="10%"><B><font face="Arial, Helvetica, sans-serif" size="2">Qty</font></B></td>

			<td align=right nowrap width="10%" style="padding-right:10px;"> <font face="Arial, Helvetica, sans-serif" size="2"><B>Item Total</B> ($)</font></td>

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

					<td align=center><a href="<?=$ROOT_URL?>shopping-cart-delete-<?=$carts->fldTempCartID?>.html"><img src="<?=$ROOT_URL?>assets/images/delete.gif"  border="0"  onClick="return confirm(&quot;Are you sure you want to completely remove this Products  from the Shopping Cart?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Products.\n&quot;)"/></a></font></td>


					<td valign="middle" align="center">

					<?

						$products = Products::findProducts($carts->fldTempCartProductID);

						 

						



					?>

					<img src="<?=$ROOT_URL?>products_image/<?=$products->fldProductsImage?>" alt="" border=0 align="left"  width="75">

					

						

					<table border="0">

                    <tr><td align="left">

					<B><font face="Arial, Helvetica, sans-serif" size="2"><?=$carts->fldTempCartProductName?></font></B><br />                              
                    <? 
						if($carts->fldTempCartOptions != "") {
							$option = explode(',',$carts->fldTempCartOptions);
							foreach($option as $options) {
								$pOptions = ProductsOption::findProductsOptionCart($options);
								$nOptions = Options::findOptions($pOptions->fldProductsOptionMainId);
								$cOptions = OptionsCategory::findOptionsCategory($pOptions->fldProductsOptionCategoryId);
								$optionAmount = $optionAmount + $pOptions->fldProductsOptionAmount;
							
				    ?>
                    	<strong><?=$cOptions->fldOptionsCategoryName?> : </strong> <?=$nOptions->fldOptionsName?>  - (+) $ <?=number_format($pOptions->fldProductsOptionAmount,2)?><br />
                    <?			
							
						} }
						
					?>
                    </td></tr>																																																																																							                                                                                                               	                                                        

              </table>

						

						

							</td>

					<td

						onmousedown="setCheckboxRow('document.item_form.cbid','<?=$row_ctr?>');"

						 align=right><font face="Arial, Helvetica, sans-serif" size="2"><?=number_format($carts->fldTempCartProductPrice,2)?></font></td>

								

						

					<td align=center><font class=default><input 

						 type=text name="qty[]" value="<?=$carts->fldTempCartQuantity?>" maxlength=3 size=3 style="text-align:center" onchange="checkForDecimal(this.value)">

                         <input type="hidden" name="cartId[]" value="<?=$carts->fldTempCartID?>" />

                         </td>

						

					<td align="right" style="padding-right:10px;">
                    <font face="Arial, Helvetica, sans-serif" size="2">
                    	<?
							$subtotal = $carts->fldTempCartProductPrice * $carts->fldTempCartQuantity;
							$subtotal = $subtotal + $optionAmount;

							echo number_format($subtotal,2);
						?>
                      </font>
					</td>

				</tr>

				<?

				$grandtotal += $subtotal;													

				$row_ctr++;
				$optionAmount = 0; //clean option amount not to add to next product


			}



			}

			?>

            

           

            

			<tr style="background-color:#666666;color:#FFF; height:30px">

				<td colspan=4 align="right"><font color="#FFFFFF">

					<B><font face="Arial, Helvetica, sans-serif" size="2">Sub Total ($) :</font></B>

				</font></td>

				<td align=right style="padding-right:10px;"><B>

                <font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">

					<?

						echo number_format($grandtotal,2);

					?>

                    </font>

				</B></td>

			</tr>

            

			</table>

                                    

	<br />

    <input name="continue" type="submit" id="continue" value="Continue Shopping" />

		<input name="update" type="submit" id="update" value="Update Shopping Cart" />

		<input name="checkout" type="submit" id="checkout" value="Checkout" />

	<br />

<div class="cls"></div>



		



	</div>

    </form>

    <script language="javascript">

		function checkForDecimal(num) {

			if(num%1) {

				alert("Please enter whole number");

			}

			

		}



	</script>