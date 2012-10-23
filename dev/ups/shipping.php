<?php ob_start(); ?>
<?php require("topheader.htm"); ?>
<?php require("connection/connect.php"); ?>
<?php
  session_start();
   if(!isset($_SESSION['username'])) {
 	header("Location: register.php");
 }
 else {

  $username = $_SESSION['username'];
  $ip = $_SESSION['ip'];
  $client_id = $_SESSION['client_id'];
  
  $query10 = "SELECT * FROM client_info WHERE username='$username'";
  $result10 = mysql_query($query10) or die(mysql_error());
  $row10  = mysql_fetch_array($result10);
  
  $area_code = $row10['zip'];
  $country1 = $row10['country'];
  
  $query11 = "SELECT * FROM country WHERE countries_name='$country1'";
  $result11 = mysql_query($query11) or die(mysql_error());
  $row11 =  mysql_fetch_array($result11);
  $country  = $row11['countries_code']; 
}
?>

<html>
<head>
<title>AGH Corporation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
a {
	text-decoration:none;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
	color:#000066;
}
a:hover {
	text-decoration:underline;
	color:#FF0000;
}
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	color: #000000;
}
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; color: #000000; font-weight: bold; }
-->
</style>
</head>
<body bgcolor="#ffffff">
<?php
  if(isset($submit)) {
  		header("Location: change_address.php");
  }
  if(isset($continue)) {
        session_start();
  		$_SESSION['shipping'] = $_POST['optShipping'];
  		header("Location: cart_checkout.php"); 
  }
?>

<table border="0" cellpadding="0" cellspacing="0" width="800">

  <tr>
   <td><img src="images/spacer.gif" width="105" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="104" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="105" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="104" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="100" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="5" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="102" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="3" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="73" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="99" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="2" background="images/index_r6_c1.jpg">&nbsp;</td>
   <td colspan="5" rowspan="2" valign="top" background="images/index_r6_c3.jpg"><table width="416" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td height="24" colspan="3">&nbsp;</td>
     </tr>
     <tr>
       <td width="16" rowspan="2">&nbsp;</td>
       <td colspan="2">&nbsp;</td>
     </tr>
     <tr>
	 	<form method="post" action="<?php $PHP_SELF; ?>">
       <td width="182" valign="top"><span class="style7">Shipping Address: </span><br />
         <br />
           <span class="style4">Name: </span><span class="style5"><?php echo $row10['firstname'] . " " . $row10['lastname']; ?></span><br />
              <span class="style4">Address:</span> <span class="style3"><?php echo $row10['address'];?> <br />
            <br />		<?php echo $row10['city'] . " " . $row10['state']; ?><br /><?php echo $row10['country'] . " " . $row10['zip']; ?></span> <br /><input type="submit" value="Change Address" name="submit" /></td>
       <td width="218" valign="top"><div align="justify" class="style3">Your order will be shipped to the address at the left or you may change the shipping address by click the <strong><em>change address</em></strong> button. </div></td>
     </tr>
     
   </table></td>
   <td colspan="3" rowspan="2" valign="top" background="images/index_r6_c8.jpg"><table width="163" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="15" height="41">&nbsp;</td>
       <td width="148">&nbsp;</td>
     </tr>
     <tr>
       <td height="78">&nbsp;</td>
       <td rowspan="2">
	    		<img src="icn_cart.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066"><strong>Your Cart</strong></font><br><br>
	   		<?php 
			
						if(isset($_SESSION['ip'])) {
							session_start();
							$ip = $_SESSION['ip'];
							$client_id = $_SESSION['client_id'];
						}	
						else {	
							$ip = getenv("REMOTE_ADDR");
							$client_id = GetSID(24); 		
							session_start();
							$_SESSION['ip']=$ip;
							$_SESSION['client_id']=$client_id;
						}	
														
						
						
						
						$query9 = "SELECT * FROM temp_order WHERE ip='$ip' and client_id='$client_id'";
						$result9 = mysql_query($query9) or die(mysql_error());
						$content = mysql_num_rows($result9);
						$grandtotal=0;
						
						while($row9 = mysql_fetch_array($result9)) {
							$product_id = $row9['product_id'];
							$quantity = $row9['Quantity'];
							$query10 = "SELECT * FROM products WHERE Id='$product_id'";
							$result10 = mysql_query($query10) or die(mysql_error());
							$row10 = mysql_fetch_array($result10);
							$category_id = $row10['category_id'];
							$query12 = "SELECT * FROM category WHERE Id='$category_id'";
							$result12 = mysql_query($query12) or die(mysql_error());
							$row12 = mysql_fetch_array($result12);
							$addPrice = $row12['addPrice'];
							if($_SESSION['username']) {
								$username = $_SESSION['username'];
								$query9 = "SELECT * FROM client_info WHERE username='$username'";
								$result9 = mysql_query($query9) or die(mysql_error());
								$row9 = mysql_fetch_array($result9);
								if($row9['client_type']=="Customer") {
									$cost=$row10['cost']+($addPrice*$row10['cost']);									
								}
								else {
									$cost=$row10['cost']+($addPrice*$row10['cost']);
								}
							} else {
								$cost=$row10['cost']+($addPrice*$row10['cost']); }		
							$subtotal = $cost * $quantity;
							$grandtotal = $grandtotal + $subtotal;
						}
					

					
			?>			
					
						
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066">Contains</font>&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066"><strong><?php echo $content; ?></strong></font>&nbsp;
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066">items</font><br>
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066">Subtotal :</font>
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066"><strong><?php echo '$'.number_format($grandtotal,2); ?></strong></font><br><br>
			<a href=cart.php>View Cart</a>
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000066">|</font>
			<a href=shipping.php>Checkout</a>

	   </td>

     </tr>
     <tr>
       <td height="50">&nbsp;</td>
       </tr>
     <tr>
       <td height="42">&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
   </table></td>
   <td><img src="images/spacer.gif" width="1" height="57" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="2" valign="top" background="images/index_r7_c1.jpg"><table width="200" border="0" cellpadding="0" cellspacing="0">
    
     <tr>
       <td width="16">&nbsp;</td>
       <td width="171" align="center" valign="middle" height="150">
	    
	   		 <?php require("test.php"); ?>
	   	
	   </td>
       <td width="13">&nbsp;</td>
     </tr>
     
   </table></td>
   <td><img src="images/spacer.gif" width="1" height="175" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="10"><img name="index_r8_c1" src="images/index_r8_c1.jpg" width="800" height="17" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="1" height="17" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="10" background="images/index_r9_c1.jpg"><table width="799" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="10">&nbsp;</td>
       <td width="290" valign="top">
         <table width="194" border="0" align="center">
           <tr>
             <th width="188" scope="row">&nbsp;</th>
           </tr>
		   <?php
		   		$mainId = "0";
		   		$query3 = "SELECT * FROM category WHERE MainCat_ID='$mainId' order by category_name";
				$result3 = mysql_query($query3) or die(mysql_error());
				while($row3 = mysql_fetch_array($result3)) {
		   ?>
           <tr>
             <td height="27" background="button/button.gif" scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#003366"><a href="subCategory.php?id=<?php echo $row3['Id'];?>"><?php echo $row3['category_name'];?></a></font></td>
           </tr>
		   <?php } ?>
         </table>
         <br>  
         <td width="593" valign="top"><table width="593" border="0" cellpadding="0" cellspacing="0">
			 <tr>
			   <td rowspan="4" valign="top"><span class="style7">Shipping Method </span><br />
		        <br />
		        <span class="style5">Please select the preferred shipping method to use on this order. </span><br />
		        <br />
		        <span class="style4">UNITED PARCEL SERVICE (
						<?php
									$query4 = "SELECT * FROM temp_order WHERE client_id='$client_id' and ip='$ip'";
									$result4 = mysql_query($query4) or die(mysql_error());

									$weight = 0;
									while($row4 = mysql_fetch_array($result4)) {
										$product_id = $row4['product_id'];
										$quantity = $row4['Quantity'];
								    	$query = "SELECT * FROM products WHERE Id='$product_id'";
								    	$result = mysql_query($query) or die(mysql_error());
					   				 	$row=mysql_fetch_array($result);			
										$weight = $weight + $row['weight'];
									}	
									
						?>
				<?php echo $weight; ?> )		
				<img src="shipping_ups.gif" width="20" height="13" /></span><br />
				<br />
				<br />
				<table width="414" border="0" cellspacing="1" bgcolor="#333333">
					<?php
							require("ups.php"); 
						    $rate = new Ups; 
						  	$rate->upsProduct("1DM");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td width="255" class="style3">Next Day Air Early AM</td>
					  <td width="99" class="style3">
					  	<? 						    
						    echo '$'. number_format($quote,2); 
						?>   
					  </td>
				    </tr>
				<?php } ?>
				<?php
						  	$rate->upsProduct("1DA");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">Next Day Air </td>
					  <td class="style3">
					      <?php						  	
						    echo '$'. number_format($quote,2);
						  ?>
					  </td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("1DP");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">Next Day Air Saver </td>
					  <td class="style3">
					      <?php
						    echo '$'. number_format($quote,2);
						  ?>
					  </td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("2DM");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">2nd Day Air Early AM</td>
					  <td class="style3">
					      <?php
						    echo '$'. number_format($quote,2);
						  ?>
					  </td>
				    </tr>
				<?php } ?>	
				<?php
						  	$rate->upsProduct("2DA");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">2nd Day Air</td>
					  <td class="style3"><?php echo '$'. number_format($quote,2); ?></td>
				    </tr>
				<?php } ?>	
				<?php
						  	$rate->upsProduct("3DS");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">3 Day Select </td>
					  <td class="style3"><?php echo '$' . number_format($quote,2);?></td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("GND");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">Ground </td>
					  <td class="style3"><?php echo '$' . number_format($quote,2); ?></td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("STD");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">Canada Standard</td>
					  <td class="style3"><?php echo '$' . number_format($quote,2); ?></td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("XPR");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">Worldwide Express</td>
					  <td class="style3"><?php echo '$' . number_format($quote,2); ?></td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("XDM");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					  <td class="style3">Worldwide Express Plus</td>
					  <td class="style3"><?php echo '$' . number_format($quote,2); ?></td>
				    </tr>
					<?php } ?>
					<?php
						  	$rate->upsProduct("XPD");   // See upsProduct() function for codes 
						    $rate->origin("11501", "US"); // Use ISO country codes! 
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
					    <input name="optShipping" type="radio" value="XPD" />
				      </div></td>
					  <td class="style3">Worldwide Expedited </td>
					  <td class="style3"><?php echo '$' . number_format($quote,2); ?></td>
				    </tr>
					<?php } ?>
					<tr bgcolor="#CCCCCC">
					  <td colspan="3" align="right">
					      <input type="submit" value="Continue" name="continue" />
					  </td>  
					</tr>
				</table>
		        <br /></td>

			   <td width="173" height="30">&nbsp;</td>
			 </tr>
			 <tr>
			   <td height="94">&nbsp;</td>
			 </tr>
			 <tr>
			   <td height="20">&nbsp;</td>
			 </tr>
			 
			 <tr>
			   <td height="329">&nbsp;</td>
			 </tr>
		   </table>
         <table width="593" border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td colspan="2" rowspan="4">&nbsp;</td>
             <td width="174" height="88">&nbsp;</td>
           </tr>
           <tr>
             <td height="91">&nbsp;</td>
           </tr>
           <tr>
             <td height="93">&nbsp;</td>
           </tr>
           <tr>
             <td height="90">&nbsp;</td>
           </tr>
         </table>
         </td>
     </tr>
   </table>     
    </td>
   <td><img src="images/spacer.gif" width="1" height="29" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="10" background="images/index_r11_c1.jpg">&nbsp;</td>
   <td><img src="images/spacer.gif" width="1" height="26" border="0" alt=""></td>
  </tr>
</table>
</form>
</body>
</html>
