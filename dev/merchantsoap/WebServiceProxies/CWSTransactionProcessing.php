<?php
/**
 * CwsTransactionProcessing class file
 *
 */

class Acknowledge {
	public $sessionToken; // string
	public $transactionId; // string
	public $applicationProfileId; // string
	public $workflowId; // string
}

class AcknowledgeResponse {
	public $AcknowledgeResult; // Response
}

class Addendum {
	public $Unmanaged; // Unmanaged
}

class AddressResult {
}

class Adjust {
	public $sessionToken; // string
	public $differenceData; // Adjust
	public $applicationProfileId; // string
	public $workflowId; // string
}

class AdjustDifferenceData {
	public $Amount; // decimal
	public $TransactionId; // string
	public $Addendum; // Addendum
	public $TipAmount; // decimal
	public $TransactionDateTime; // dateTime
}

class AdjustResponse {
	public $AdjustResult; // Response
}

class AdviceResponse {
}

class AlternativeMerchantData {
	public $CustomerServiceInternet; // string
	public $CustomerServicePhone; // string
	public $Description; // string
	public $SIC; // string
	public $Address; // AddressInfo
	public $MerchantId; // string
	public $Name; // string
}

class Any {
	public $string; // ArrayOfstring
}

class Authorize {
	public $sessionToken; // string
	public $transaction; // Transaction
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class AuthorizeAndCapture {
	public $sessionToken; // string
	public $transaction; // Transaction
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class AuthorizeAndCaptureResponse {
	public $AuthorizeAndCaptureResult; // Response
}

class AuthorizeResponse {
	public $AuthorizeResult; // Response
}

class AVSData {
	public $CardholderName; // string
	public $Street; // string
	public $City; // string
	public $StateProvince; // string
	public $PostalCode; // string
	public $Country; // TypeISOCountryCodeA3
	public $Phone; // string
	public $Email; // string
}

class AVSResult {
	public $ActualResult; // string
	public $AddressResult; // AddressResult
	public $CountryResult; // CountryResult
	public $StateResult; // StateResult
	public $PostalCodeResult; // PostalCodeResult
	public $PhoneResult; // PhoneResult
	public $CardholderNameResult; // CardholderNameResult
	public $CityResult; // CityResult
}

class BankcardApplicationConfigurationData {
	public $ApplicationAttended; // boolean
	public $ApplicationLocation; // ApplicationLocation
	public $HardwareType; // HardwareType
	public $PINCapability; // PINCapability
	public $ReadCapability; // ReadCapability
}

class BankcardCapture {
	public $Amount; // decimal
	public $ChargeType; // ChargeType
	public $ShipDate; // dateTime
	public $TipAmount; // decimal
}

class BankcardCapturePro {
	public $MultiplePartialCapture; // boolean
	public $Level2Data; // Level2Data
	public $LineItemDetails; // ArrayOfLineItemDetail
	public $ShippingData; // CustomerInfo
}

class BankcardCaptureResponse {
	public $BatchId; // string
	public $IndustryType; // IndustryType
	public $TransactionSummaryData; // TransactionSummaryData
}

class BankcardInterchangeData {
	public $BillPayment; // BillPayment
	public $RequestCommercialCard; // RequestCommercialCard
	public $ExistingDebt; // ExistingDebt
	public $RequestACI; // RequestACI
	public $TotalNumberOfInstallments; // int
	public $CurrentInstallmentNumber; // int
	public $RequestAdvice; // RequestAdvice
}

class BankcardReturn {
	public $Amount; // decimal
	public $TenderData; // BankcardTenderData
}

class BankcardTenderData {
	public $CardData; // CardData
	public $CardSecurityData; // CardSecurityData
	public $EcommerceSecurityData; // EcommerceSecurityData
}

class BankcardTransaction {
	public $ApplicationConfigurationData; // BankcardApplicationConfigurationData
	public $TenderData; // BankcardTenderData
	public $TransactionData; // BankcardTransactionData
}

class BankcardTransactionData {
	public $AccountType; // AccountType
	public $AlternativeMerchantData; // AlternativeMerchantData
	public $ApprovalCode; // string
	public $CashBackAmount; // decimal
	public $CustomerPresent; // CustomerPresent
	public $EmployeeId; // string
	public $EntryMode; // EntryMode
	public $GoodsType; // GoodsType
	public $IndustryType; // IndustryType
	public $InternetTransactionData; // InternetTransactionData
	public $InvoiceNumber; // string
	public $OrderNumber; // string
	public $IsPartialShipment; // boolean
	public $SignatureCaptured; // boolean
	public $FeeAmount; // decimal
	public $TerminalId; // string
	public $LaneId; // string
	public $TipAmount; // decimal
	public $BatchAssignment; // string
	public $PartialApprovalCapable; // PartialApprovalSupportType
}

class BankcardTransactionDataPro {
	public $ManagedBilling; // ManagedBilling
	public $Level2Data; // Level2Data
	public $LineItemDetails; // ArrayOfLineItemDetail
	public $PINlessDebitData; // PINlessDebitData
	public $IIASData; // IIASData
}

class BankcardTransactionPro {
	public $InterchangeData; // BankcardInterchangeData
}

class BankcardTransactionResponse {
	public $Amount; // decimal
	public $CardType; // TypeCardType
	public $FeeAmount; // decimal
	public $ApprovalCode; // string
	public $AVSResult; // AVSResult
	public $BatchId; // string
	public $CVResult; // CVResult
	public $CardLevel; // string
	public $DowngradeCode; // string
	public $MaskedPAN; // string
	public $PaymentAccountDataToken; // string
	public $RetrievalReferenceNumber; // string
	public $Resubmit; // Resubmit
	public $SettlementDate; // dateTime
	public $FinalBalance; // decimal
	public $OrderId; // string
	public $CashBackAmount; // decimal
}

class BankcardTransactionResponsePro {
	public $AdviceResponse; // AdviceResponse
	public $CommercialCardResponse; // CommercialCardResponse
	public $ReturnedACI; // string
}

class BankcardUndo {
	public $PINDebitReason; // PINDebitUndoReason
	public $TenderData; // BankcardTenderData
	public $ForceVoid; // boolean
}

class BillPayment {
}

class BillPayServiceData {
	public $CompanyName; // string
	public $CompanyAddress; // AddressInfo
}

class Capture {
	public $sessionToken; // string
	public $differenceData; // Capture
	public $applicationProfileId; // string
	public $workflowId; // string
}

class CaptureAll {
	public $sessionToken; // string
	public $differenceData; // ArrayOfCapture
	public $batchIds; // ArrayOfstring
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class CaptureAllAsync {
	public $sessionToken; // string
	public $differenceData; // ArrayOfCapture
	public $batchIds; // ArrayOfstring
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class CaptureAllAsyncResponse {
	public $CaptureAllAsyncResult; // Response
}

class CaptureAllResponse {
	public $CaptureAllResult; // ArrayOfResponse
}

class CaptureAuth {
	public $sessionToken; // string
	public $differenceData; // Capture
	public $applicationProfileId; // string
	public $workflowId; // string
}

class CaptureDifferenceData {
	public $TransactionId; // string
	public $Addendum; // Addendum
	public $TransactionDateTime; // dateTime
}

class CaptureResponse {
	public $CaptureResult; // Response
}

class CaptureSelective {
	public $sessionToken; // string
	public $transactionIds; // ArrayOfstring
	public $differenceData; // ArrayOfCapture
	public $applicationProfileId; // string
	public $workflowId; // string
}

class CaptureSelectiveAsync {
	public $sessionToken; // string
	public $transactionIds; // ArrayOfstring
	public $differenceData; // ArrayOfCapture
	public $applicationProfileId; // string
	public $workflowId; // string
}

class CaptureSelectiveAsyncResponse {
	public $CaptureSelectiveAsyncResult; // Response
}

class CaptureSelectiveResponse {
	public $CaptureSelectiveResult; // ArrayOfResponse
}

class CaptureState {
}

class CardData {
	public $CardType; // TypeCardType
	public $CardholderName; // string
	public $PAN; // string
	public $Expire; // string
	public $Track1Data; // string
	public $Track2Data; // string
}

class CardholderNameResult {
}

class CardSecurityData {
	public $AVSData; // AVSData
	public $CVDataProvided; // CVDataProvided
	public $CVData; // string
	public $KeySerialNumber; // string
	public $PIN; // string
}

class char {
}

class ChargeType {
}

class CheckCountryCode {
}

class CheckData {
	public $AccountNumber; // string
	public $CheckCountryCode; // CheckCountryCode
	public $CheckNumber; // string
	public $OwnerType; // OwnerType
	public $RoutingNumber; // string
	public $UseType; // UseType
}

class CityResult {
}

class CommercialCardResponse {
}

class ConsumerIdentification {
	public $IdType; // IdType
	public $IdData; // string
	public $IdEntryMode; // IdEntryMode
}

class CountryResult {
}

class CustomerInfo {
	public $Name; // NameInfo
	public $Address; // AddressInfo
	public $BusinessName; // string
	public $Phone; // string
	public $Fax; // string
	public $Email; // string
}

class CVDataProvided {
}

class CVResult {
}

class CWSConnectionFault {
}

class CWSDeserializationFault {
}

class CWSExtendedDataNotSupportedFault {
}

class CWSInvalidMessageFormatFault {
}

class CWSInvalidOperationFault {
}

class CWSInvalidServiceInformationFault {
}

class CWSOperationNotSupportedFault {
	public $ErrorType; // CWSValidationErrorFault.EErrorType
	public $RuleKey; // string
	public $RuleLocationKey; // string
	public $RuleMessage; // string
	public $TransactionId; // string
}

class CWSTransactionAlreadySettledFault {
}

class CWSTransactionFailedFault {
}

class CWSTransactionServiceUnavailableFault {
}

class DriversLicense {
	public $Number; // string
	public $State; // TypeStateProvince
	public $Track1; // string
	public $Track2; // string
}

class duration {
}

class EcommerceSecurityData {
	public $TokenData; // string
	public $TokenIndicator; // TokenIndicator
	public $XID; // string
}

class ElectronicCheckingCaptureResponse {
	public $SummaryData; // SummaryData
}

class ElectronicCheckingCustomerData {
	public $AdditionalBillingData; // PersonalInfo
}

class ElectronicCheckingTenderData {
	public $CheckData; // CheckData
}

class ElectronicCheckingTransaction {
	public $Addendum;
	public $TenderData; // ElectronicCheckingTenderData
	public $TransactionData; // ElectronicCheckingTransactionData
}

class ElectronicCheckingTransactionData {
	public $EffectiveDate; // dateTime
	public $IsRecurring; // boolean
	public $SECCode; // SECCode
	public $ServiceType; // ServiceType
	public $TransactionType; // TransactionType
}

class ElectronicCheckingTransactionResponse {
	public $ACHCapable; // boolean
	public $Amount; // decimal
	public $ApprovalCode; // string
	public $ModifiedAccountNumber; // string
	public $ModifiedRoutingNumber; // string
	public $PaymentAccountDataToken; // string
	public $ReturnInformation; // ReturnInformation
	public $SubmitDate; // dateTime
}

class ElectronicCheckingUndo {
	
	public $ForceVoid; // boolean
}

class ExistingDebt {
}

class guid {
}

class IdEntryMode {

}

class IdType {

}
class IIASData {
	public $HealthcareAmount; // decimal
	public $ClinicOtherAmount; // decimal
	public $DentalAmount; // decimal
	public $PrescriptionAmount; // decimal
	public $VisionAmount; // decimal
	public $IIASDesignation; // IIASDesignation
}

class IIASDesignation {

}
class InternetTransactionData {
	public $IpAddress; // string
	public $SessionId; // string
}

class Interval {
}

class IsTaxExempt {
}

class ItemizedTax {
	public $Amount; // decimal
	public $Rate; // decimal
	public $Type; // TypeTaxType
}

class Level2Data {
	public $BaseAmount; // decimal
	public $CommodityCode; // string
	public $CompanyName; // string
	public $CustomerCode; // string
	public $DestinationCountryCode; // TypeISOCountryCodeA3
	public $DestinationPostal; // string
	public $Description; // string
	public $DiscountAmount; // decimal
	public $DutyAmount; // decimal
	public $FreightAmount; // decimal
	public $MiscHandlingAmount; // decimal
	public $OrderDate; // dateTime
	public $OrderNumber; // string
	public $RequesterName; // string
	public $ShipFromPostalCode; // string
	public $ShipmentId; // string
	public $TaxExempt; // TaxExempt
	public $Tax; // Tax
}

class LineItemDetail {
	public $Amount; // decimal
	public $CommodityCode; // string
	public $Description; // string
	public $DiscountAmount; // decimal
	public $DiscountIncluded; // boolean
	public $ProductCode; // string
	public $Quantity; // decimal
	public $Tax; // Tax
	public $TaxIncluded; // boolean
	public $UnitOfMeasure; // TypeUnitOfMeasure
	public $UnitPrice; // decimal
	public $UPC; // string
}

class Manage {
	public $TransactionId; // string
	public $Addendum; // Addendum
}

class ManageAccount {
	public $sessionToken; // string
	public $transaction; // Transaction
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class ManageAccountById {
	public $sessionToken; // string
	public $differenceData; // Manage
	public $applicationProfileId; // string
	public $workflowId; // string
}

class ManageAccountByIdResponse {
	public $ManageAccountByIdResult; // Response
}

class ManageAccountResponse {
	public $ManageAccountResult; // Response
}
class ManagedBilling {
	public $DownPayment; // decimal
	public $Installments; // ManagedBillingInstallments
	public $Interval; // Interval
	public $Period; // int
	public $StartDate; // dateTime
}

class ManagedBillingInstallments {
	public $Amount; // decimal
	public $Count; // int
}

class NameInfo {
	public $Title; // string
	public $First; // string
	public $Middle; // string
	public $Last; // string
	public $Suffix; // string
}

class OwnerType {
}

class PayeeData {
	public $CompanyName; // string
	public $Phone; // string
	public $AccountNumber; // string
}

class PersonalInfo {
	public $Company; // string
	public $DateOfBirth; // dateTime
	public $DriversLicense; // DriversLicense
	public $EmployeeIdNumber; // string
	public $Gender; // string
	public $GovernmentIdNumber; // string
	public $MilitaryIdNumber; // string
	public $SocialSecurityNumber; // string
	public $TaxId; // string
}

class PhoneResult {
}

class PINDebitUndoReason {
}

class PingResult {
	public $PingResult; // PingResponse
}

class PINlessDebitData {
	public $BillPayServiceData; // BillPayServiceData
	public $PayeeData; // PayeeData
}

class PostalCodeResult {
}

class QueryAccount {
	public $sessionToken; // string
	public $transaction; // Transaction
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class QueryAccountResponse {
	public $QueryAccountResult; // Response
}

class RequestCommercialCard {
}

class RequestTransaction {
	public $sessionToken; // string
	public $merchantProfileId; // string
	public $tenderData; // TransactionTenderData
}

class RequestTransactionResponse {
	public $RequestTransactionResult; // ArrayOfResponse
}

class Response {
	public $Status; // Status
	public $StatusCode; // string
	public $StatusMessage; // string
	public $TransactionId; // string
	public $OriginatorTransactionId; // string
	public $ServiceTransactionId; // string
	public $ServiceTransactionDateTime; // ServiceTransactionDateTime
	public $Addendum; // Addendum
	public $CaptureState; // CaptureState
	public $TransactionState; // TransactionState
}

class Resubmit {
}

class ReturnById {
	public $sessionToken; // string
	public $differenceData; // Return
	public $applicationProfileId; // string
	public $workflowId; // string
}

class ReturnByIdDifferenceData {
	public $TransactionId; // string
	public $Addendum; // Addendum
	public $TransactionDateTime; // string
}

class ReturnByIdResponse {
	public $ReturnByIdResult; // Response
}

class ReturnInformation {
	public $ReturnCode; // string
	public $ReturnDate; // dateTime
	public $ReturnReason; // string
}

class ReturnUnlinked {
	public $sessionToken; // string
	public $transaction; // Transaction
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class ReturnUnlinkedResponse {
	public $ReturnUnlinkedResult; // Response
}

class SECCode {
}

class ServiceTransactionDateTime {
	public $Date; // string
	public $Time; // string
	public $TimeZone; // string
}

class ServiceType {
}

class StateResult {
}

class Status {
}

class StoredValueActivateTenderData {
	public $VirtualCardData; // VirtualCardData
}

class StoredValueBalanceTransferTenderData {
	public $SourceCardData; // CardData
	public $ConsumerIdentification; // ConsumerIdentification
}

class StoredValueCapture {
	public $Amount; // decimal
}

class StoredValueCaptureResponse {
	public $BatchId; // string
	public $SummaryData; // SummaryData
}

class StoredValueManage {
	public $Amount; // decimal
	public $SourceCardData; // CardData
	public $CardStatus; // CardStatus
	public $IsCashOut; // boolean
	public $OperationType; // OperationType
}

class StoredValueReturn {
	public $Amount; // decimal
}

class StoredValueTenderData {
	public $CardData; // CardData
	public $CardSecurityData; // CardSecurityData
	public $CardholderId; // string
	public $ConsumerIdentifications; // ArrayOfConsumerIdentification
}

class StoredValueTransaction {
	public $TenderData; // StoredValueTenderData
	public $TransactionData; // StoredValueTransactionData
}

class StoredValueTransactionData {
	public $EmployeeId; // string
	public $IndustryType; // IndustryType
	public $TipAmount; // decimal
	public $TenderCurrencyCode; // TypeISOCurrencyCodeA3
	public $CardRestrictionValue; // string
	public $EntryMode; // EntryMode
	public $Unload; // boolean
	public $CardStatus; // CardStatus
	public $OperationType; // OperationType
	public $OrderNumber; // string
}

class StoredValueTransactionResponse {
	public $Amount; // decimal
	public $FeeAmount; // decimal
	public $ApprovalCode; // string
	public $CVResult; // CVResult
	public $CashBackAmount; // decimal
	public $LockAmount; // decimal
	public $NewBalance; // decimal
	public $PreviousBalance; // decimal
	public $CardStatus; // CardStatus
	public $AccountNumber; // string
	public $CVData; // string
	public $CardRestrictionValue; // string
	public $PaymentAccountDataToken; // string
	public $MaskedPAN; // string
	public $OrderId; // string
}
class SummaryData {
	public $CashBackTotals; // SummaryTotals
	public $CreditReturnTotals; // SummaryTotals
	public $CreditTotals; // SummaryTotals
	public $DebitReturnTotals; // SummaryTotals
	public $DebitTotals; // SummaryTotals
	public $NetTotals; // SummaryTotals
	public $VoidTotals; // SummaryTotals
}

class SummaryTotals {
	public $NetAmount; // decimal
	public $Count; // int
}

class Tax {
	public $Amount; // decimal
	public $Rate; // decimal
	public $InvoiceNumber; // string
	public $ItemizedTaxes; // ArrayOfItemizedTax
}

class TaxExempt {
	public $IsTaxExempt; // IsTaxExempt
	public $TaxExemptNumber; // string
}

class TokenIndicator {
}

class Totals {
	public $NetAmount; // decimal
	public $Count; // int
}

class Transaction {
	public $CustomerData; // TransactionCustomerData
	public $ReportingData; // TransactionReportingData
	public $Addendum; // Addendum
}

class TransactionCustomerData {
	public $BillingData; // CustomerInfo
	public $CustomerId; // string
	public $CustomerTaxId; // string
	public $ShippingData; // CustomerInfo
}

class TransactionData {
	public $Amount; // decimal
	public $CurrencyCode; // TypeISOCurrencyCodeA3
	public $TransactionDateTime; // string
}

class TransactionReportingData {
	public $Comment; // string
	public $Description; // string
	public $Reference; // string
}

class TransactionState {
}

class TransactionSummaryData {
	public $CashBackTotals; // Totals
	public $NetTotals; // Totals
	public $ReturnTotals; // Totals
	public $SaleTotals; // Totals
	public $VoidTotals; // Totals
	public $PINDebitReturnTotals; // Totals
	public $PINDebitSaleTotals; // Totals
}

class TransactionTenderData {
	public $PaymentAccountDataToken; // string
	public $SecurePaymentAccountData; // string
}

class TransactionType {
}

class Txn_AccountType {
}

class Txn_AddressInfo {
	public $Street1; // string
	public $Street2; // string
	public $City; // string
	public $StateProvince; // string
	public $PostalCode; // string
	public $CountryCode; // TypeISOCountryCodeA3
}

class Txn_ApplicationLocation {
}

class Txn_CustomerPresent {
}

class Txn_EntryMode {
}

class Txn_GoodsType {
}

class Txn_HardwareType {
}

class Txn_IndustryType {
}

class Txn_PINCapability {
}

class Txn_Ping {
}

class Txn_PingResponse {
	public $IsSuccess; // boolean
	public $Message; // string
}

class Txn_ReadCapability {
}

class Txn_RequestACI {
}

class Txn_RequestAdvice {
}

class Txn_TypeISOCountryCodeA3 {
}

class Txn_TypeISOCurrencyCodeA3 {
}

class Txn_TypeStateProvince {
}

class TypeCardType {
}

class TypeTaxType {
}

class TypeUnitOfMeasure {
}

class Undo {
	public $sessionToken; // string
	public $differenceData; // Undo
	public $applicationProfileId; // string
	public $workflowId; // string
}

class UndoDifferenceData {
	public $TransactionId; // string
	public $Addendum; // Addendum
	public $TransactionDateTime; // dateTime
}

class UndoResponse {
	public $UndoResult; // Response
}

class Unmanaged {
	public $Any; // ArrayOfstring
}

class UseType {
}

class Verify {
	public $sessionToken; // string
	public $transaction; // Transaction
	public $applicationProfileId; // string
	public $merchantProfileId; // string
	public $workflowId; // string
}

class VerifyResponse {
	public $VerifyResult; // Response
}

class VirtualCardData {
	public $AccountNumberLength; // int
	public $BIN; // string
}

?>
