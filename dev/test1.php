<?
require('xml/minixml.inc.php');
	
 	// time and date of submission
  	$my_date = date('HismdY'); 
  
  	// adjust variables for Test or Production transaction mode
      //if (MODULE_PAYMENT_PAYMENTECH_TESTMODE=='Test') {
         define (GATEWAY_URL, 'https://orbitalvar1.paymentech.net/authorize'); // for certification process only
         $my_merchantid="720000128387";
     // } else {
      //	 define (GATEWAY_URL, 'https://orbital1.paymentech.net/authorize'); // for actual production
      	// $my_merchantid=MODULE_PAYMENT_PAYMENTECH_PRODMID;
     // }
		
	//  Create a new MiniXMLDoc object
	$xmlDoc  = new MiniXMLDoc();
	$xmlRoot =& $xmlDoc->getRoot();
  
  $Request =& $xmlRoot->createChild('Request');
  	$AC =& $Request->createChild('AC'); 
  		$CommonData =& $AC->createChild('CommonData'); 
  			$CommonMandatory =& $CommonData->createChild('CommonMandatory');
   			$CommonMandatory->attribute('HcsTcsInd', 'T');
  			$CommonMandatory->attribute('MessageType', "TEST");
  			$CommonMandatory->attribute('LangInd', '00');
  			$CommonMandatory->attribute('TzCode', "1");
  			$CommonMandatory->attribute('AuthOverrideInd', 'N');
  			$CommonMandatory->attribute('Version', '2');
  			$CommonMandatory->attribute('TxCatg', '7');
  			$CommonMandatory->attribute('CardHolderAttendanceInd', '01');
  				$AccountNum =& $CommonMandatory->createChild('AccountNum'); 
   				$AccountNum->attribute('AccountTypeInd', '91');
  				$AccountNum->text("4111111111111111"); // $my_card_number
  				$POSDetails =& $CommonMandatory->createChild('POSDetails');
  				$POSDetails->attribute('POSEntryMode', '01');
  				$MerchantID =& $CommonMandatory->createChild('MerchantID');
  				$MerchantID->text($my_merchantid);
  				$TerminalID =& $CommonMandatory->createChild('TerminalID');
  				$TerminalID->attribute('POSConditionCode', '59');
  				$TerminalID->attribute('CardPresentInd', 'N');
  				$TerminalID->attribute('AttendedTermDataInd', '01');	
  				$TerminalID->attribute('TermLocInd', '01');	
  				$TerminalID->attribute('CATInfoInd', '06');
  				$TerminalID->attribute('TermEntCapInd', '05');
  				$TerminalID->text(MODULE_PAYMENT_PAYMENTECH_TRACE_ID);
  				$BIN =& $CommonMandatory->createChild('BIN');
  				$BIN->text('000002');
  				$OrderID =& $CommonMandatory->createChild('OrderID');
  				$OrderID->text($_POST[my_invoice_description]); // $my_invoice_description
  				$AmountDetails =& $CommonMandatory->createChild('AmountDetails');
  					$Amount =& $AmountDetails->createChild('Amount');
  					$Amount->text("120.00"); // $my_totalamount
  				$TxTypeCommon =& $CommonMandatory->createChild('TxTypeCommon');
  				$TxTypeCommon->attribute('TxTypeID', 'G');
  				$Currency =& $CommonMandatory->createChild('Currency');
  				$Currency->attribute('CurrencyCode', '840');
  				$Currency->attribute('CurrencyExponent', '2');
  				$CardPresence =& $CommonMandatory->createChild('CardPresence');
  					$CardNP =& $CardPresence->createChild('CardNP');
  						$Exp =& $CardNP->createChild('Exp');
  						$Exp->text(112012);
  				$TxDateTime =& $CommonMandatory->createChild('TxDateTime');
  				$TxDateTime->text($my_date); 
   			$CommonOptional =& $CommonData->createChild('CommonOptional');
  				$CardSecVal =& $CommonOptional->createChild('CardSecVal');
  				$CardSecVal->text("999"); // $my_cc_verify
  				$CardSecVal->attribute('CardSecInd', '1');
  				$ECommerceData =& $CommonOptional->createChild('ECommerceData');
  				$ECommerceData->attribute('ECSecurityInd', '07');
  				$ECOrderNum =& $ECommerceData->createChild('ECOrderNum');
  				$ECOrderNum->text($my_invoice_description); // $my_invoice_description
  				
  		$Auth =& $AC->createChild('Auth');
  			$AuthMandatory =& $Auth->createChild('AuthMandatory');
   			$AuthMandatory->attribute('FormatInd', 'H');
  			$AuthOptional =& $Auth->createChild('AuthOptional');
  				$AVSextended =& $AuthOptional->createChild('AVSextended');
  					$AVSname =& $AVSextended->createChild('AVSname');
  					$AVSname->text("VISA"); 
  					$AVSaddress1 =& $AVSextended->createChild('AVSaddress1');
  					$AVSaddress1->text("Oberlin Drive"); 
  					$AVScity =& $AVSextended->createChild('AVScity');
  					$AVScity->text("San Diego");
  					$AVSstate =& $AVSextended->createChild('AVSstate');
  					$AVSstate->text("CA");
  					$AVSzip =& $AVSextended->createChild('AVSzip');
  					$AVSzip->text("92121"); // $my_postcode 
  		$Cap =& $AC->createChild('Cap');
  			$CapMandatory =& $Cap->createChild('CapMandatory');
  				$EntryDataSrc =& $CapMandatory->createChild('EntryDataSrc');
  					$EntryDataSrc->text('02');
  			$CapOptional =& $Cap->createChild('CapOptional');
  					
  		$needle = '<Request>';
  		$haystack = $xmlDoc->toString();
  		$pos = strpos($haystack, $needle);
  		$ReqLen = strlen($haystack)-$pos;
  		$xmlRequest = substr($haystack, $pos, $ReqLen);  // strips off version element
		  
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, 1); // comment once in production
  		if(!curl_setopt($ch, CURLOPT_URL, GATEWAY_URL)) {echo 'CURLOPT URL Error<p>';}
  		if(!curl_setopt($ch, CURLOPT_HEADER, 1)) {echo 'CURLOPT Header Error<p>';}
  		if(!curl_setopt($ch, CURLOPT_HTTPHEADER, array('POST /AUTHORIZE HTTP/1.0', 'MIME-Version: 1.0', 'Content-type: application/PTI21',
  			'Content-transfer-encoding: text', 'Request-number: 1', 'Document-type: Request'))) {echo 'CURLOPT HTTPHEADER Error<p>';}
  		if(!curl_setopt($ch, CURLOPT_POST, 1)) {echo 'CURLOPT POST Error<p>';}
  		if(!curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest)) {echo 'CURLOPT POSTFIELDS Error<p>';}
  		if(!curl_setopt($ch, CURLOPT_TIMEOUT, 90)) {echo 'CURLOPT TIMEOUT Error<p>';} 
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // gives error, but keeps xml formatting
		
		//GoDaddy Proxy Settings
		curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
		curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
		curl_setopt ($ch, CURLOPT_PROXY, 'http://proxy.shr.secureserver.net:3128');
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		// End Godaddy Proxy settings
  
  		$result=curl_exec ($ch);
  		curl_close ($ch); 
  
  		$returnedXMLDoc = new MiniXMLDoc();
  		$returnedXMLDoc->fromString($result);
		$procstatus = $returnedXMLDoc->getElement('ProcStatus');
		$sorry = 'Sorry for this inconvenience. You may call '.MODULE_PAYMENT_PAYMENTECH_PHONE.' for further assistance.';
		if ($procstatus->getValue() === '0') {
		    $response = '';
		    $approvalstatus = $returnedXMLDoc->getElement('ApprovalStatus');
			$CVVrespcode = $returnedXMLDoc->getElement('CVV2RespCode');
			$AVSrespcode = $returnedXMLDoc->getElement('AVSRespCode');
	   		if ($approvalstatus->getValue() === '1') {
				echo "Success!";
			} elseif ($approvalstatus->getValue() === '0') {
			  	if (($CVVrespcode->getValue()!='N')&&($CVVrespcode->getValue()!='I')&&($CVVrespcode->getValue()!='Y')&&($AVSrespcode->getValue()!='2')&&($AVSrespcode->getValue()!='G')) $response='Possible that card issuer does not participate with address OR card verification.'.$sorry;
 			    if ($AVSrespcode->getValue()=='6') $response='System unavailable or timed-out.'.$sorry;
			   // tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message='. urlencode('Credit Card Declined: '.$AVSrespcode->getValue().$CVVrespcode->getValue().$response) , 'SSL', true, false));
			} else {
			    //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message='. urlencode('Server_Error: '.$sorry) , 'SSL', true, false));
	   		}
	   } else {
	   	   $status = $returnedXMLDoc->getElement('StatusMsg');
		   echo $procstatus->getValue() . $sorry;
    	//  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message='. urlencode('System Error '.$procstatus->getValue().' '.$status->getValue().$sorry)  , 'SSL', true, false));
       }
?>