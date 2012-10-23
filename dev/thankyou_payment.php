<?php include 'manager/_pi/base.php'; ?>
<?

$order_id = $_POST['order_id'];
$trans_id = $_POST['trans_id'];
$amount = $_POST['amount'];

	

	//update the order id

	Cart::updateCartStatus($order_id,$trans_id);
	
	$myOrder = Cart::findCartByOrderID($order_id);

	//$clients = Client::findClient($myOrder->fldCartClientID);

	$shipping = Shipping::findShippingClient($clients->fldClientID);

	$shippingRate = ShippingRate::findShippingRateByOrderCode($order_id);
	
	$clients = Billing::findBillingClient($myOrder->fldCartClientID);
	 
	 
	$message = "<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor=#333300>";
			  $message .= "<tr>";
				$message .= "<td height=25 align=center>&nbsp;</td>";
				$message .= "<td height=25 align=center><font face=Arial, Helvetica, sans-serif size=2 color=#FFFFFF><b>Product Name</b></font></td>";
				$message .= "<td height=25 align=center><font face=Arial, Helvetica, sans-serif size=2 color=#FFFFFF><b>Amount</b></font></td>";
				$message .= "<td height=25 align=center><font face=Arial, Helvetica, sans-serif size=2 color=#FFFFFF><b>Quantity</b></font></td>";
				$message .= "<td height=25 align=center><font face=Arial, Helvetica, sans-serif size=2 color=#FFFFFF><b>Total Amount</b></font></td>";
			  $message .= "</tr>";
			  
										//display the shopping cart							
										$date = date('Y-m-d');
										$condition = "fldTempCartClientID='$client_id' AND fldTempCartDate='$date'";
										
										$cart = Cart::displayAllByOrders($order_id);
										foreach($cart as $carts) { 
											 $products = Products::findProducts($carts->fldCartProductID);	
											$subtotal = $carts->fldCartProductPrice * $carts->fldCartQuantity;
											//$total = $total + $subtotal;
											$countitem = $countitem + 1;
									
											  $message .= "<tr bgcolor=#FFFFFF>";
												$message .= "<td align=center style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;><img src=".$ROOT_URL."products_image/".$products->fldProductsImage." border=0 align='left'  width='75'></td>";
												$message .= "<td style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;>".$carts->product_name;
																		
                                                   $total = $total + $subtotal;
												   
												$message .="</td>";
												$message .= "<td style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;>$
												  ".number_format($carts->fldCartProductPrice,2)."</td>";
												$message .= "<td style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;>".$carts->quantity."</td>";
												$message .= "<td style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;>$
												  ".number_format($subtotal,2)."</td>";
											  $message .= "</tr>";
									 } 
			   
			  $message .= "<tr bgcolor=#FFFFFF>";
				$message .= "<td height=25 colspan=5 align=right style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;><b>Sub Total :</b> $
				  ".number_format($total,2)."</td>";
			  $message .= "</tr>";
			  
				if($clients->state == 'CA') { 
					  $tax = $total * .0875; 			 
					  $message .= "<tr bgcolor=#FFFFFF>";			
						$message .= "<td height=25 colspan=5 align=right style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;><b>Tax :</b> $
						  ".number_format($tax,2)."</td>";
					  $message .= "</tr>";
			  } 
			  
			  $message .= "<tr bgcolor=#FFFFFF>";
				
				$message .= "<td align=right colspan=5 style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;><b>Shipping (
				  ".$shippingRate->fldShippingRateName."
				  ) :</b> $".number_format($shippingRate->fldShippingRateAmount,2). "</td>";
				  
						 
			
			  $message .= "</tr>";
			  $message .= "<tr bgcolor=#FFFFFF>";
				$grandtotal = $total + $tax + $shippingRate->fldShippingRateAmount; 
				$message .= "<td height=25 colspan=5 align=right style=font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#0000;><b> Grand Total :</b> $
				  ".number_format($grandtotal,2)."</td>";
			  $message .= "</tr>";
			$message .= "</table>";

		
		
		require("includes/class.phpmailer.php");
	    $mail = new PHPMailer();
	    $to = 'info@piggyments.com';			
		$name = '';
		$from = $clients->fldBillingEmail;
		$mail->From = $from;
		$mail->FromName = $clients->fldBillingFirstName . ' ' . $clients->fldBillingLastname;
		$mail->AddAddress($to);
		$mail->IsHTML(true); // set email format to HTML
		$all_html = implode('',file('includes/orders.php'));
		
		//FOR BILLING
		$name = $clients->fldBillingFirstName . ' ' . $clients->fldBillingLastname;
		$address = $clients->fldBillingAddress . ' ' . $clients->fldBillingCity . ' ' . $clients->fldBillingState . ' ' . $clients->fldBillingCountry . ' ' . $clients->fldBillingZip;
		$email = $clients->fldBillingEmail;
		$contact = $clients->fldBillingPhoneNo;
		
		//FOR SHIPPING
		$shipping = Shipping::findShippingClient($_SESSION['client_id']	);
		$shipping_name = $shipping->fldShippingFirstName . ' ' . $shipping->fldShippingLastname;
		$shipping_address = $shipping->fldShippingAddress . ' ' . $shipping->fldShippingCity . ' ' . $shipping->fldShippingState . ' ' . $shipping->fldShippingCountry . ' ' . $shipping->fldShippingZip;
		$shipping_email = $shipping->fldShippingEmail;
		$shipping_contact = $shipping->fldShippingPhoneNo;
		
		$all_html = str_replace("%%order_no%%", $order_id, $all_html);
		$all_html = str_replace("%%order_date%%", date('F d, Y'), $all_html);
		$all_html = str_replace("%%name%%", $name, $all_html);
		$all_html = str_replace("%%address%%", $address, $all_html);
		$all_html = str_replace("%%email%%", $email, $all_html);
		$all_html = str_replace("%%contact%%", $contact, $all_html);
		$all_html = str_replace("%%shipping_name%%", $shipping_name, $all_html);
		$all_html = str_replace("%%shipping_address%%", $shipping_address, $all_html);
		$all_html = str_replace("%%shipping_email%%", $shipping_email, $all_html);
		$all_html = str_replace("%%shipping_contact%%", $shipping_contact, $all_html);
		$all_html = str_replace("%%orders%%", $message, $all_html);
											
		//name of client						 																														
		$mail->Subject = "New Order";
		//$alt_body = $_POST['body'];
		$mail->Body    = $all_html;
		//$mail->AltBody = $alt_body;
		if($mail->Send()){
			$mail->ClearAddresses();
		}
		
		
		//send order Receipt to Clients
		$name = '';
		$to  = $clients->fldBillingEmail;
		$from ='sales@piggyments.com';
		$mail->From = $from;
		$mail->FromName ='Piggyments';
		$mail->AddAddress($to);
		$mail->IsHTML(true); // set email format to HTML
		$all_html = implode('',file('includes/orders.php'));
		
		

		$all_html = str_replace("%%order_no%%", $order_id, $all_html);
		$all_html = str_replace("%%order_date%%", date('F d, Y'), $all_html);
		$all_html = str_replace("%%name%%", $name, $all_html);
		$all_html = str_replace("%%address%%", $address, $all_html);
		$all_html = str_replace("%%email%%", $email, $all_html);
		$all_html = str_replace("%%contact%%", $contact, $all_html);
		$all_html = str_replace("%%shipping_name%%", $shipping_name, $all_html);
		$all_html = str_replace("%%shipping_address%%", $shipping_address, $all_html);
		$all_html = str_replace("%%shipping_email%%", $shipping_email, $all_html);
		$all_html = str_replace("%%shipping_contact%%", $shipping_contact, $all_html);
		$all_html = str_replace("%%orders%%", $message, $all_html);

											

		//name of client						 																														
		$mail->Subject = "Your Order - Piggyments";

		//$alt_body = $_POST['body'];
		$mail->Body    = $all_html;

		//$mail->AltBody = $alt_body;

		if($mail->Send()){

			$mail->ClearAddresses();

		}
		
		if(isset($_SESSION['client_id'])) {
			unset($_SESSION['client_id']);
		}
?>
	<? startblock('section') ?>
  <aside>
   	<?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Thank you</h1>
      <hr />
    </hgroup>
    Thank you for your order. Our representative will contact you as soon as possible.
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
