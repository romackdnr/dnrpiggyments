
<? 
	if(isset($_POST['submit_bill'])) {
		//update the member information
		$_POST = sanitize($_POST);
		$client = $_POST;
		settype($client,'object');
		$client_id = Client::addClient($client);
		$_SESSION['client_id'] = $client_id;
		//update the TempCart
		$xclient = session_id();
		$condition = "fldTempCartClientID='$xclient'";
		if(TempCart::countTempcartbyCondition($condition)>=1) {
			//change the client id
			TempCart::updateTempcartClient($client_id,$xclient);
		}
		
		
		if (isset($_POST['chkShip'])) {
				if(Shipping::countShippingClient($client_id)==0) {
					$_POST = sanitize($_POST);
					$shipping = $_POST;
					settype($shipping,'object');
					$shipping->client_id = $client_id;
					$shipping = Shipping::addShipping($shipping); 
				} else {
					$shippings = Shipping::findShippingClient($client_id);
					$_POST = sanitize($_POST);
					$shipping = $_POST;
					settype($shipping,'object');
					$shipping->Id = $shippings->fldShippingID;
					$shipping = Shipping::updateShipping($shipping); 
				}
				$links = $ROOT_URL.'shipping-rate/';
				header("Location: $links");
		} else {
			$links = $ROOT_URL . 'shipping-info/';
			header("Location: $links");
		}
	}
?>
<form method="post" action="<? $PHP_SELF;?>">
<table width="95%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td height="25" colspan="3" bgcolor="#6B5983" style="font-weight: bold; color:#FFF">Billing Information</td>
  </tr>  
  <tr>
    <td colspan="3"><table width="559" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="266" height="35">Last name</td>
        <td width="4" height="35">:</td>
        <td width="236" height="35"><input name="lastname" type="text" class=":required" id="lastname" size="35"></td>
      </tr>
      <tr>
        <td height="35">First name</td>
        <td height="35">:</td>
        <td height="35"><input name="firstname" type="text" class=":required" id="firstname"  size="35"></td>
      </tr>
      <tr>
        <td height="35">Contact No</td>
        <td height="35">:</td>
        <td height="35"><input name="phone" type="text" class=":required " id="contact_no"  size="35"></td>
      </tr>
      <tr>
        <td height="35">Address</td>
        <td height="35">:</td>
        <td height="35"><input name="address" type="text" class=":required" id="address"  size="35"></td>
      </tr>
      <tr>
        <td height="35">Address 1</td>
        <td height="35">:</td>
        <td height="35"><input name="address1" type="text"  id="address1"  size="35"></td>
      </tr>
      <tr>
        <td height="35">City</td>
        <td height="35">:</td>
        <td height="35"><input name="city" type="text" class=":required" id="city"  size="35"></td>
      </tr>
      <tr>
        <td height="35">State</td>
        <td height="35">:</td>
        <td height="35">
        <select name ="state" class="select_state">
                	
                	<? 
						$state = State::findAll();
						foreach($state as $states) {
								if($states->tStateID == 'CA') { 
					?>                    		
                        			<option value="<?=$states->tStateID?>" selected="selected"><?=$states->tStateName?></option>
                      			<? } else { ?>
                                	<option value="<?=$states->tStateID?>"><?=$states->tStateName?></option>
                                <? } ?>
                    <? } ?>
                    
                </select>
        </td>
      </tr>
      <tr>
        <td height="35">Country</td>
        <td height="35">:</td>
        <td height="35">
        <select name ="country" class="select_text">                	
                	<? 
						$country = Country::findAll();
						foreach($country as $countries) {
							if($countries->country_code == 'US') { 
					?>
                    		<option value="<?=$countries->country_code?>" selected="selected"><?=$countries->country_name?></option>
                        <? } else { ?>
                        	<option value="<?=$countries->country_code?>"><?=$countries->country_name?></option>
                        <? } ?>
                    <? } ?>
                </select>
        </td>
      </tr>
      <tr>
        <td height="35">Zip</td>
        <td height="35">:</td>
        <td height="35">
        <input name="zip" type="text" class=":required" id="zip"  size="35">
        </td>
      </tr>
      <tr>
        <td height="35">Email Address</td>
        <td height="35">:</td>
        <td height="35">
        <input name="email_address" type="text" class=":required :email" id="email"  size="35">
        </td>
      </tr>
     
      <tr>
        <td height="35" colspan="3" align="left">
        <input type="checkbox" name="chkShip" value="1" style="padding-right:5px" />Click here if your shipping information is the same in your billing information
        </td>
      </tr>
      <tr>
        <td height="35" colspan="3" align="center">
             

       <input type="submit" value="Continue &rarr;" name="submit_bill">
        </td>
        </tr>
    </table></td>
  </tr>
  </table>
</form>