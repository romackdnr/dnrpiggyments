<?php include 'manager/_pi/base.php'; ?>
<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];		
	} else {
		header("Location: index.php");
	}
		
?>
<? 
	if(isset($_POST['submit_bill'])) {
		//update the member information
		$_POST = sanitize($_POST);
		$shipping = $_POST;
		settype($shipping,'object');
		if($_POST['Id']=="") {			
			$shipping = Shipping::addShipping($shipping); 
		} else {
			$shipping = Shipping::updateShipping($shipping); 
		}
		
		$success = "Shipping information successfully saved";
		
	}
	
	$shipping = Shipping::findShippingClient($client_id);
?>




	<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/account_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Shipping Information</h1>
      <hr />
    </hgroup>

    <ul class='accountRegistration'>
      <li id=account_login>
      <form action="" method="post" class=multiform>
          <?
			if(isset($success)) { 
		?>
        		<div class="error"><?=$success?></div>
        <? } ?>                  
          <dl>
            <dt><label>Last name *</label>
              <input type="text" name="lastname" class=:required size="50" value="<?=stripslashes($shipping->fldShippingLastname)?>"></dt>
            <dt><label>First name *</label>
              <input type="text" name="firstname" class=:required size="50" value="<?=stripslashes($shipping->fldShippingFirstName)?>"></dt>   
            <dt><label>Address *</label>
              <input type="text" name="address" class=:required size="50" value="<?=stripslashes($shipping->fldShippingAddress)?>"></dt> 
            <dt><label>Address 1</label>
              <input type="text" name="address1" size="50" value="<?=stripslashes($shipping->fldShippingAddress1)?>"></dt>   
           <dt><label>City *</label>
              <input type="text" name="city" class=:required size="50" value="<?=stripslashes($shipping->fldShippingCity)?>"></dt>         
           <dt><label>State *</label>
           		<select name="state">
                	<? 
						$state = State::findAll();
						foreach($state as $states) {
							if($billing->fldBillingState == "") {
								$stateVal = "CA";
							} else {
								$stateVal = $shipping->fldShippingState;
								
							}
								if($states->tStateID == $stateVal) { 
					?>                    		
                        			<option value="<?=$states->tStateID?>" selected="selected"><?=$states->tStateName?></option>
                      			<? } else { ?>
                                	<option value="<?=$states->tStateID?>"><?=$states->tStateName?></option>
                                <? } ?>
                    <? } ?>
                </select>
            </dt>  
            <dt><label>Country *</label>
           		<select name="country">
                	<? 
						$country = Country::findAll();
						foreach($country as $countries) {
							if($shipping->fldShippingCountry == "") {
								$countryVal = "US";
							} else {
								$countryVal = $shipping->fldShippingCountry;
							}
							if($countries->country_code == $countryVal) { 
					?>
                    		<option value="<?=$countries->country_code?>" selected="selected"><?=$countries->country_name?></option>
                        <? } else { ?>
                        	<option value="<?=$countries->country_code?>"><?=$countries->country_name?></option>
                        <? } ?>
                    <? } ?>
                </select>
            </dt> 
            <dt><label>Postal / Zip Code *</label>
              <input type="text" name="zip" class=:required size="50" value="<?=$shipping->fldShippingZip?>"></dt>  
            <dt><label>Phone number *</label>
              <input type="text" name="phone" class=:required size="50" value="<?=$shipping->fldShippingPhoneNo?>"></dt>   
            <dt><label>Email Address *</label>
              <input type="text" name="email" class=:required :email size="50" value="<?=$shipping->fldShippingEmail?>"></dt> 
          
          </dl>
          <input type="hidden" name="client_id" value="<?=$_SESSION['client_id']?>">
          <input type="hidden" name="Id" value="<?=$shipping->fldShippingID?>">
          <button type="submit" class=btn_submit name="submit_bill">Save</button>
        </form>
      </li>
      
    </ul>
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
