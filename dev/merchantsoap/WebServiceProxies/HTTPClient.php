<?php
/* Copyright (c) 2004-2010 IP Commerce, INC. - All Rights Reserved.
 *
 * This software and documentation is subject to and made
 * available only pursuant to the terms of an executed license
 * agreement, and may be used only in accordance with the terms
 * of said agreement. This software may not, in whole or in part,
 * be copied, photocopied, reproduced, translated, or reduced to
 * any electronic medium or machine-readable form without
 * prior consent, in writing, from IP Commerce, INC.
 *
 * Use, duplication or disclosure by the U.S. Government is subject
 * to restrictions set forth in an executed license agreement
 * and in subparagraph (c)(1) of the Commercial Computer
 * Software-Restricted Rights Clause at FAR 52.227-19; subparagraph
 * (c)(1)(ii) of the Rights in Technical Data and Computer Software
 * clause at DFARS 252.227-7013, subparagraph (d) of the Commercial
 * Computer Software--Licensing clause at NASA FAR supplement
 * 16-52.227-86; or their equivalent.
 *
 * Information in this software is subject to change without notice
 * and does not represent a commitment on the part of IP Commerce.
 *
 * Sample Code is for reference Only and is intended to be used for educational purposes. It's the responsibility of
 * the software company to properly integrate into their solution code that best meets their production needs.
 */

// Commerce Web Services Client class


require_once ABSPATH.'/WebServiceProxies/CWSServiceInformation.php';
require_once ABSPATH.'/WebServiceProxies/CWSTransactionProcessing.php';
require_once ABSPATH.'/WebServiceProxies/CWSTransactionManagement.php';
require_once ABSPATH.'/WebServiceProxies/FaultHandler.php';

class newTransaction {
	public $TxnData,
	$TndrData;
}
// Holds credit card information
class creditCard {
	public $paymentAccountDataToken = '',
	$type,
	$name,
	$number,
	$expiration, // MMYY
	$cvv = '', // Code on back of card
	$address,
	$city,
	$state,
	$zip = '',
	$phone,
	$country = 'USA',
	$currency = 'USD',
	$track1,
	$track2;
}

class achCheck {
	public $PaymentAccountDataToken,
	$AccountNumber,
	$CheckCountryCode,
	$CheckNumber,
	$OwnerType,
	$RoutingNumber,
	$UseType,
	$BusinessName,
	$FirstName,
	$MiddleName,
	$LastName;
}

class configurationValues {
	public $IdentityToken,
	$ServiceId,
	$ApplicationProfileId,
	$MerchantProfileId;
}

class achTransactionData{
	public $Amount = '0.00', // amount in decimal format
	$EffectiveDate = '', // date string
	$IsRecurring = false, //boolean
	$SECCode = 'WEB', //The three letter code that indicates what NACHA regulations the transaction must adhere to. Required.
	$ServiceType = 'ACH', //Indicates the Electronic Checking service type: ACH, RDC or ECK. Required.
	$TransactionDateTime = '', // date time string
	$TransactionType = 'Debit', //Indicates the transaction type. Required. Debit/Credit
	$Creds = '';
}

// Holds transaction information for bankcard processing
class transData {
	public $InvoiceNumber = '',
	$OrderNumber = '',
	$CustomerPresent = '', // Present, Ecommerce, MOTO, NotPresent
	$EmployeeId = '', //Used for Retail, Restaurant, MOTO
	$EntryMode = '', // Keyed, TrackDataFromMSR
	$GoodsType = '', // DigitalGoods - PhysicalGoods
	$IndustryType = '', // Retail, Restaurant, Ecommerce, MOTO
	$AccountType = '', // SavingsAccount, CheckingAccount
	$Amount = '0.00', // in a decimal format xx.xx
	$CashBackAmount = '', // in a decimal format. used for PINDebit transactions
	$CurrencyCode = '', // TypeISOA3 Currency Codes USD CAD
	$SignatureCaptured = false, // boolean true or false
	$TipAmount = '0.00', // in a decimal format
	$ApprovalCode = '',
	$ReportingData = null,
	$Creds = '',
	$DateTime = '',
	$AltMerchantData = null;
}
class transDataPro {
	public $InvoiceNumber = '',
	$OrderNumber = '',
	$CustomerPresent = '', // Present, Ecommerce, MOTO, NotPresent
	$EmployeeId = '', //Used for Retail, Restaurant, MOTO
	$EntryMode = '', // Keyed, TrackDataFromMSR
	$GoodsType = '', // DigitalGoods - PhysicalGoods
	$IndustryType = '', // Retail, Restaurant, Ecommerce, MOTO
	$AccountType = '', // SavingsAccount, CheckingAccount
	$Amount = '0.00', // in a decimal format xx.xx
	$CashBackAmount = '', // in a decimal format. used for PINDebit transactions
	$CurrencyCode = '', // TypeISOA3 Currency Codes USD CAD
	$SignatureCaptured = false, // boolean true or false
	$TipAmount = '0.00', // in a decimal format
	$ApprovalCode = '',
	$ReportingData = null,
	$DateTime = '',
	$Creds = '',
	$CFeeAmount = '0.00',
	$AltMerchantData = null,
	$InterchangeData = null,
	$Level2Data = null;
}

class altMerchantData{
	public $CustomerServiceInternet = '', $CustomerServicePhone = '', $Description = '', $SIC = '', $MerchantId = '', $Name = '', $Address = null;
}

class interchangeData {
	public $BillPayment = '', $RequestCommercialCard = '', $ExistingDebt = '', $RequestACI = '', $TotalNumberOfInstallments = '', $CurrentInstallmentNumber = '', $RequestAdvice = '';
}

// processes soap error.  Ideally create a class to handle all CWS SOAP faults.  Please see the FaultHandler.php class
function process_soap_error($error) {
	foreach ( $error as $key => $value ) {
		echo $key . '<br>';
		print_r ( $value );
		echo '<br>';
	}
	echo '<br />';
	print_r ( $error );
	echo '<br />';
}

// Creates a client class to process Service Information and Transaction messages
class HTTPClient {
	private $token, // IdentityToken
	$session_token = '', // Temporary session token used for transactions (Expires every 30 minutes)
	$serviceKey = '', // Only used with dedicated endpoints
	$merchantProfileID = '', // This is your merchant ProfileId
	$workflowId = '', // ServiceId/WorkFlowId of service connecting to
	$appProfileID = '', // This value is returned on your SaveApplicationData call
	$svcInfo, // Service information WSDL
	$txn, // Bank Card WSDL
	$svc,
	$tms; // Data Services - Transaction Management Service


	public function __construct($token, $baseURL, $merchProfileID = '', $workflowId = '', $applicationID = '', $_svc = null) {
		$this->token = new SignOnWithToken ();

		$this->svcInfo = $baseURL.'SvcInfo';
		$this->txn = $baseURL.'Txn';
		$this->tms = $baseURL.'DataServices/TMS';

		$this->token->identityToken = $token;
		$this->merchantProfileID = $merchProfileID;
		$this->workflowId = $workflowId;
		$this->appProfileID = $applicationID;
		$this->svc = $_svc;
	}

	/*
	 *
	 * Sign on and retrieve the session token from the WSDL
	 *
	 */
	public function signOn() {

		if ($this->session_token == '') {
			try {
				$msgBody = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
								'<s:Body>'.
									'<SignOnWithToken xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
										'<identityToken>'.$this->token->identityToken.'</identityToken>'.
									'</SignOnWithToken>'.
								'</s:Body>'.
							'</s:Envelope>';
				$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/SignOnWithToken';

				$response = curl_soap($msgBody, $this->svcInfo, $action);
				$sessToken = $response['Body']['SignOnWithTokenResponse']['SignOnWithTokenResult'];
				$this->session_token = $sessToken;
				if (isset($response['Body']['Fault'])){
					$xmlFault = generate_valid_xml_from_array($response);
					throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
				}

			} catch ( SoapFault $e ) {
				echo '<br/>SERVER ERROR: Error Signing On. <br/> ';
				$errors = handleSvcInfoFault ( $e, $xmlFault );
				echo $errors;
				exit ();
			}
		}
		return true;
	}

	/*
	 *
	 * Retrieve all available services
	 *
	 */
	public function getServiceInformation() {
		if (! $this->signOn ())
		return false;

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetServiceInformation xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
								'</GetServiceInformation>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetServiceInformation';
			//$siResponse = SendMessage($msgBody, $this->svcInfo, $action);

			$siResponse = curl_soap($msgBody, $this->svcInfo, $action);
			$siResponse = $siResponse['Body']['GetServiceInformationResponse']['GetServiceInformationResult'];
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return ($siResponse);


		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Service Information.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	// Return only the ServiceID
	public function getServiceID() {
		try{
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetServiceInformation xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.					
								'</GetServiceInformation>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetServiceInformation';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response['GetServiceInformationResponse'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Service Information.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Retrieve all available Merchant Profiles for a given Service Id
	 *
	 */
	public function getMerchantProfiles($svcId, $tndrType) {
		if (! $this->signOn ())
		return false;
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetMerchantProfiles xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$svcId.'</serviceId>'.
									'<tenderType>'.$tndrType.'</tenderType>'.									
								'</GetMerchantProfiles>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetMerchantProfiles';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response['Body']['GetMerchantProfilesResponse']['GetMerchantProfilesResult']['MerchantProfile'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Merchant Profiles.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Return only the Profile Id
	 *
	 */

	public function getMerchantProfileId() {
		try{
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetMerchantProfileIds xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$serviceId.'</serviceId>'.
									'<tenderType>'.$tenderType.'</tenderType>'.									
								'</GetMerchantProfileIds>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetMerchantProfileIds';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response->GetMerchantProfilesResult->MerchantProfile->ProfileId;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Merchant ProfileId.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Is the Merchant Profile Initialized
	 *
	 */
	public function isMerchantProfileInitialized($merchProfileId, $serviceId) {
		if (! $this->signOn ())
		return false;
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<IsMerchantProfileInitialized xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$serviceId.'</serviceId>'.
									'<merchantProfileId>'.$merchProfileId.'</merchantProfileId>'.
									'<tenderType>Credit</tenderType>'.									
								'</IsMerchantProfileInitialized>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/IsMerchantProfileInitialized';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response['Body']['IsMerchantProfileInitializedResponse']['IsMerchantProfileInitializedResult'];

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Checking if Merchant Profile is Initialized.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}

	}
	/*
	 *
	 * Save Application Data
	 *
	 */
	public function saveApplicationData($appData) {
		if (! $this->signOn ())
		return false;
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<SaveApplicationData xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$appData.
								'</SaveApplicationData>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/SaveApplicationData';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			$response = $response['Body']['SaveApplicationDataResponse']['SaveApplicationDataResult'];
			$this->appProfileID = $response;
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response;
		} catch ( SoapFault $e ) {
			echo '<br />SERVER ERROR: Error Retrieving Merchant Profiles.<br />';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Save Merchant Profiles
	 *
	 */
	public function saveMerchantProfiles($merchantProfile, $tenderType, $serviceId) {
		if (! $this->signOn ())
		return false;
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<SaveMerchantProfiles xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$serviceId.'</serviceId>'.
									'<tenderType>'.$tenderType.'</tenderType>'.
									'<merchantProfiles xmlns:i="http://www.w3.org/2001/XMLSchema-instance">'.
			$merchantProfile.
									'</merchantProfiles>'.
								'</SaveMerchantProfiles>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/SaveMerchantProfiles';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response;

		} catch ( SoapFault $e ) {
			echo '<br />SERVER ERROR: Error Saving Merchant Profiles.<br />';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			//echo $xmlFault;
			exit ();
		}
	}

	/*
	 *
	 * Authorize a payment amount

	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function queryAccount($ach_info, $trans_info) {
		if (! $this->signOn ())
		return false;

		$ach_trans = $this->buildACHTransaction($ach_info, $trans_info) ;

		// Build QueryAccount
		$queryAccount = new QueryAccount();
		$queryAccount->sessionToken = $this->session_token;
		$queryAccount->transaction = $ach_trans;
		$queryAccount->merchantProfileId = $this->merchantProfileID;
		$queryAccount->workflowId = $this->workflowId;
		$queryAccount->applicationProfileId = $this->appProfileID;

		try {
			$authResponse = $this->bankCard->QueryAccount( $queryAccount )->QueryAccountResult;
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $authResponse;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Query Account.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Authorize a payment amount

	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function authorize($trans_info) {
		if (! $this->signOn ())
		return false;

		// Build Authorize
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Authorize xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Authorize>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Authorize';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['AuthorizeResponse']['AuthorizeResult'];

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error t\nrying to Authorize.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Charge funds from an account based on transaction id
	 * $transactionID is the known transaction ID of a previous transaction
	 * $amount is the amount of money to charge, leave it empty to charge existing amount
	 * $tip_amount is the amount of tip money to charge, leave it empty to charge existing amount
	 *
	 */
	public function capture($trans_info) {
		if (! $this->signOn ())
		return false;

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Capture xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.									
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Capture>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Capture';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['CaptureResponse']['CaptureResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Authorize and Capture a payment amount
	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function authorizeAndCapture($trans_info) {
		if (! $this->signOn ())
		return false;

		// Build AuthorizeAndCapture
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<AuthorizeAndCapture xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</AuthorizeAndCapture>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/AuthorizeAndCapture';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['AuthorizeAndCaptureResponse']['AuthorizeAndCaptureResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Authorize and Capture.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Void or Return funds to an account based on transaction id
	 * NOTE: Use this function to void Authorize
	 * $transactionID is the known transaction ID of a previous transaction
	 *
	 */
	public function undo( $trans_info ) {
		if (! $this->signOn ())
		return false;

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Undo xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.									
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Undo>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Undo';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['UndoResponse']['UndoResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Undo.<br/>';
				
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Return funds to an account based on transaction id
	 * $transactionID is the known transaction ID of a previous transaction
	 * $amount is the amount of money to return, leave it empty to return full amount
	 *
	 */
	public function returnByID( $trans_info) {
		if (! $this->signOn ())
		return false;

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<ReturnById xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.									
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</ReturnById>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/ReturnById';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response['Body']['ReturnByIdResponse']['ReturnByIdResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Return By ID.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Return funds to an account (see Authorize/Authorize and Capture for structure)
	 *
	 */
	public function returnUnlinked( $trans_info) {
		if (! $this->signOn ())
		return false;

		// Build Return Unlinked
		//
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<ReturnUnlinked xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</ReturnUnlinked>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/ReturnUnlinked';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['ReturnUnlinkedResponse']['ReturnUnlinkedResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Return Unlinked.';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Settle specific transactions from the day - Do not pass in Undo's or Authorize txns
	 * that have had an Undo processed against it
	 * $transactionIds are a list of transactions that you wish to settle
	 * $differenceData is an object that contains any data to adjust at the time of settlement
	 *
	 */
	public function captureSelective($transactionIds, $differenceData, $creds = null) {
		if (! $this->signOn ())
		return false;

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<CaptureSelective xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$transactionIds.
			$differenceData.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</CaptureSelective>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/CaptureSelective';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['CaptureSelectiveResponse']['CaptureSelectiveResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Settle all transactions from the day
	 *
	 * $differenceData is an object that contains any data to adjust at the time of settlement
	 *
	 */
	public function captureAll($differenceData, $creds = null) {
		if (! $this->signOn ())
		return false;
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<CaptureAll xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									$differenceData.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</CaptureAll>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/CaptureAll';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['CaptureAllResponse']['CaptureAllResult'];
		} catch ( SoapFault $e ) {
			
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 * Data Services API calls below
	 */

	public function queryTransactionsSummary($queryTransactionParameters, $includeRelated, $pagingParameters) {
		if (! $this->signOn ())
		return false;

		// Build QueryTransactionsSummary
		$qts = new QueryTransactionsSummary();
		$qts->sessionToken = $this->session_token;
		$qts->queryTransactionsParameters = $queryTransactionParameters;
		$qts->includeRelated = $includeRelated;
		$qts->pagingParameters = $pagingParameters;


		try {
			$response = $this->txnManagement->QueryTransactionsSummary($qts)->QueryTransactionsSummaryResult;
			//echo ($this->txnManagement->__getLastRequest ());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to QueryTransactionsSummary.<br/>';
			echo ('<br />'.$this->txnManagement->__getLastRequestHeaders());
			echo ('<br />' . $this->txnManagement->__getLastRequest ());
			echo ('<br />' . $this->txnManagement->__getLastResponse ());
			$xmlFault = $this->txnManagement->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	public function queryTransactionFamilies($queryTransactionParameters, $includeRelated, $pagingParameters) {
		if (! $this->signOn ())
		return false;

		// Build QueryTransactionsSummary
		$qtf = new QueryTransactionFamilies();
		$qtf->sessionToken = $this->session_token;
		$qtf->queryTransactionsParameters = $queryTransactionParameters;
		$qtf->includeRelated = $includeRelated;
		$qtf->pagingParameters = $pagingParameters;


		try {
			$response = $this->txnManagement->QueryTransactionFamilies($qtf)->QueryTransactionFamiliesResult;
			//echo ($this->txnManagement->__getLastRequest ());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to QueryTransactionFamilies.<br/>';
			echo ('<br />'.$this->txnManagement->__getLastRequestHeaders());
			echo ('<br />' . $this->txnManagement->__getLastRequest ());
			echo ('<br />' . $this->txnManagement->__getLastResponse ());
			$xmlFault = $this->txnManagement->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	public function queryTransactionsDetail($queryTransactionParameters, $includeRelated, $transactionDetailFormat, $pagingParameters) {
		if (! $this->signOn ())
		return false;

		// Build QueryTransactionsDetail
		$qtd = new QueryTransactionsDetail();
		$qtd->sessionToken = $this->session_token;
		$qtd->queryTransactionsParameters = $queryTransactionParameters;
		$qtd->includeRelated = $includeRelated;
		$qtd->transactionDetailFormat = $transactionDetailFormat;
		$qtd->pagingParameters = $pagingParameters;


		try {
			$response = $this->txnManagement->QueryTransactionsDetail($qtd)->QueryTransactionsDetailResult->TransactionDetail;
			//echo ($this->txnManagement->__getLastRequest ());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to QueryTransactionFamilies.<br/>';
			echo ('<br />'.$this->txnManagement->__getLastRequestHeaders());
			echo ('<br />' . $this->txnManagement->__getLastRequest ());
			echo ('<br />' . $this->txnManagement->__getLastResponse ());
			$xmlFault = $this->txnManagement->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

}

?>