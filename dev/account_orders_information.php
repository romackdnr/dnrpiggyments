<?php include 'manager/_pi/base.php'; ?>
<?
	if(isset($_SESSION['client_id'])) {
		$client_id = $_SESSION['client_id'];
		//$billing = Billing::findBillingClient($client_id);
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
	
    
      
      		<table id="page_manager" style="width:600px !important;">
    
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
				 $count_record=Cart::counCartByClient($client_id);
				 
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
					$cart=Cart::findAllClient($pg[1],$client_id);
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
					  
					 $tax = $getTotal->totalPrice * 0.0875;
					 $total = $getTotal->totalPrice + $shippingRate->fldShippingRateAmount + $tax;
					 
					  
					  
			?>
            
                    <tr>
                      <td> <?=$carts->fldCartOrderNo?></td>
                      <td><?=$clients->fldClientFirstName . ' ' . $clients->fldClientLastname?></td>
                      <td><?=$countItem?></td>
                      <td><?=number_format($total,2)?></td>
                      <td><?=$carts->fldCartStatus?></td>
                     
                      <td align="center"><a href="<?=$ROOT_URL?>account-orders-information-display-<?=$carts->fldCartOrderNo?>.html">View Orders</a>  </td>
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
