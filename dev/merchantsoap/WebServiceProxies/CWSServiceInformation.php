<?php
/**
 * CWSServiceInformation class file
 * 
 */

class PingResponse {
  public $IsSuccess; // boolean
  public $Message; // string
}

class SvcInfo_Ping {
}

class SvcInfo_PingResponse {
  public $PingResult; // PingResponse
}

class STSUnavailableFault {
}

class BaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

class ExpiredTokenFault {
}

class InvalidTokenFault {
}

class AuthenticationFault {
}

class OneTimePasswordFault {
}

class BadAttemptThresholdExceededFault {
}

class PasswordExpiredFault {
}

class LockedByAdminFault {
}

class GeneratePasswordFault {
}

class SendEmailFault {
}

class UserNotFoundFault {
}

class PasswordInvalidFault {
}

class InvalidEmailFault {
}

class ClaimMetaData {
  public $ClaimDescription; // string
  public $ClaimGuid; // string
  public $ClaimNs; // string
  public $ClaimType; // string
  public $ClaimValue; // string
  public $Confidential; // boolean
}

class ClaimNotFoundFault {
}

class AuthorizationFault {
}

class RelyingPartyNotAssociatedToSecurityDomainFault {
}

class SystemFault {
}

class NonRenewableTokenFault {
}

class ClaimMappingsNotFoundFault {
}

class SignOnWithToken {
  public $identityToken; // string
}

class SignOnWithTokenResponse {
  public $SignOnWithTokenResult; // string
}

class GetServiceInformation {
  public $sessionToken; // string
}

class GetServiceInformationResponse {
  public $GetServiceInformationResult; // ServiceInformation
}

class ServiceInformation {
  public $BankcardServices; // ArrayOfBankcardService
  public $ElectronicCheckingServices; // ArrayOfElectronicCheckingService
  public $StoredValueServices; // ArrayOfStoredValueService
  public $Workflows; // ArrayOfWorkflow
}

class BankcardService {
  public $AlternativeMerchantData; // boolean
  public $AutoBatch; // boolean
  public $AVSData; // BankcardServiceAVSData
  public $CutoffTime; // dateTime
  public $EncryptionKey; // string
  public $ManagedBilling; // boolean
  public $MaximumBatchItems; // long
  public $MaximumLineItems; // long
  public $MultiplePartialCapture; // boolean
  public $Operations; // Operations
  public $PurchaseCardLevel; // PurchaseCardLevel
  public $ServiceId; // string
  public $ServiceName; // string
  public $Tenders; // Tenders
}

class BankcardServiceAVSData {
  public $CardholderName; // boolean
  public $Street; // boolean
  public $City; // boolean
  public $StateProvince; // boolean
  public $PostalCode; // boolean
  public $Country; // boolean
  public $Phone; // boolean
}

class Operations {
  public $Verify; // boolean
  public $QueryAccount; // boolean
  public $AuthAndCapture; // boolean
  public $Authorize; // boolean
  public $Adjust; // boolean
  public $ReturnById; // boolean
  public $ReturnUnlinked; // boolean
  public $Undo; // boolean
  public $Capture; // boolean
  public $CaptureSelective; // boolean
  public $CaptureAll; // boolean
  public $CloseBatch; // CloseBatch
  public $QueryRejected; // boolean
  public $ManageAccount; // boolean
  public $ManageAccountById; // boolean
}

class CloseBatch {
}

class PurchaseCardLevel {
}

class Tenders {
  public $Credit; // boolean
  public $PINDebit; // boolean
  public $PINlessDebit; // boolean
  public $PINDebitReturnSupportType; // PINDebitReturnSupportType
  public $PINDebitUndoTenderDataRequired; // boolean
  public $CreditAuthorizeSupport; // CreditAuthorizeSupportType
  public $QueryRejectedSupport; // QueryRejectedSupportType
  public $PinDebitUndoSupport; // PinDebitUndoSupportType
  public $BatchAssignmentSupport; // BatchAssignmentSupport
  public $CreditReturnSupportType; // CreditReturnSupportType
  public $TrackDataSupport; // TrackDataSupportType
  public $CredentialsRequired; // boolean
  public $CreditReversalSupportType; // CreditReversalSupportType
  public $PartialApprovalSupportType; // PartialApprovalSupportType
}

class PINDebitReturnSupportType {
}

class CreditAuthorizeSupportType {
}

class QueryRejectedSupportType {
}

class PinDebitUndoSupportType {
}

class BatchAssignmentSupport {
}

class CreditReturnSupportType {
}

class TrackDataSupportType {
}

class CreditReversalSupportType {
}

class PartialApprovalSupportType {
}

class ElectronicCheckingService {
  public $Operations; // Operations
  public $ServiceId; // string
  public $ServiceName; // string
  public $Tenders; // Tenders
}

class StoredValueService {
  public $Operations; // Operations
  public $ServiceId; // string
  public $ServiceName; // string
  public $Tenders; // Tenders
  public $SecureMSRAllowed; // boolean
}

class Workflow {
  public $WorkflowId; // string
  public $Name; // string
  public $ServiceId; // string
  public $WorkflowServices; // ArrayOfWorkflowService
}

class WorkflowService {
  public $ServiceId; // string
  public $ServiceName; // string
  public $ServiceType; // string
  public $Ordinal; // int
}

class SaveApplicationData {
  public $sessionToken; // string
  public $applicationData; // ApplicationData
}

class ApplicationData {
  public $ApplicationAttended; // boolean
  public $ApplicationLocation; // ApplicationLocation
  public $ApplicationName; // string
  public $DeveloperId; // string
  public $HardwareType; // HardwareType
  public $PINCapability; // PINCapability
  public $PTLSSocketId; // string
  public $ReadCapability; // ReadCapability
  public $SerialNumber; // string
  public $SoftwareVersion; // string
  public $SoftwareVersionDate; // dateTime
  public $VendorId; // string
}

class ApplicationLocation {
}

class HardwareType {
}

class PINCapability {
}

class ReadCapability {
}

class SaveApplicationDataResponse {
  public $SaveApplicationDataResult; // string
}

class GetApplicationData {
  public $sessionToken; // string
  public $applicationProfileId; // string
}

class GetApplicationDataResponse {
  public $GetApplicationDataResult; // ApplicationData
}

class DeleteApplicationData {
  public $sessionToken; // string
  public $applicationProfileId; // string
}

class DeleteApplicationDataResponse {
}

class IsMerchantProfileInitialized {
  public $sessionToken; // string
  public $serviceId; // string
  public $merchantProfileId; // string
  public $tenderType; // TenderType
}

class TenderType {
}

class merchantProfiles {
	public $MerchantProfile; //array of MerchantProfiles
}

class IsMerchantProfileInitializedResponse {
  public $IsMerchantProfileInitializedResult; // boolean
}

class GetMerchantProfiles {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class GetMerchantProfilesResponse {
  public $GetMerchantProfilesResult; // ArrayOfMerchantProfile
}

class MerchantProfile {
  public $ProfileId; // string
  public $ServiceId; // string
  public $ServiceName; // string
  public $LastUpdated; // dateTime
  public $MerchantData; // MerchantProfileMerchantData
  public $TransactionData; // MerchantProfileTransactionData
}

class MerchantProfileMerchantData {
  public $CustomerServiceInternet; // string
  public $CustomerServicePhone; // string
  public $Language; // TypeISOLanguageCodeA3
  public $Address; // AddressInfo
  public $MerchantId; // string
  public $Name; // string
  public $Phone; // string
  public $TaxId; // string
  public $BankcardMerchantData; // BankcardMerchantData
  public $ElectronicCheckingMerchantData; // ElectronicCheckingMerchantData
  public $StoredValueMerchantData; // StoredValueMerchantData
}

class TypeISOLanguageCodeA3 {
}

class AddressInfo {
  public $Street1; // string
  public $Street2; // string
  public $City; // string
  public $StateProvince; // TypeStateProvince
  public $PostalCode; // string
  public $CountryCode; // TypeISOCountryCodeA3
}

class TypeStateProvince {
}

class TypeISOCountryCodeA3 {
}

class BankcardMerchantData {
  public $ABANumber; // string
  public $AcquirerBIN; // string
  public $AgentBank; // string
  public $AgentChain; // string
  public $Aggregator; // boolean
  public $ClientNumber; // string
  public $IndustryType; // IndustryType
  public $Location; // string
  public $MerchantType; // string
  public $PrintCustomerServicePhone; // boolean
  public $QualificationCodes; // string
  public $ReimbursementAttribute; // string
  public $SIC; // string
  public $SecondaryTerminalId; // string
  public $SettlementAgent; // string
  public $SharingGroup; // string
  public $StoreId; // string
  public $TerminalId; // string
  public $TimeZoneDifferential; // string
}

class IndustryType {
}

class ElectronicCheckingMerchantData {
  public $OrginatorId; // string
  public $ProductId; // string
  public $SiteId; // string
}

class StoredValueMerchantData {
  public $AgentChain; // string
  public $ClientNumber; // string
  public $IndustryType; // IndustryType
  public $SIC; // string
  public $StoreId; // string
  public $TerminalId; // string
}

class MerchantProfileTransactionData {
  public $BankcardTransactionDataDefaults; // BankcardTransactionDataDefaults
}

class BankcardTransactionDataDefaults {
  public $CurrencyCode; // TypeISOCurrencyCodeA3
  public $CustomerPresent; // CustomerPresent
  public $EntryMode; // EntryMode
  public $RequestACI; // RequestACI
  public $RequestAdvice; // RequestAdvice
}

class TypeISOCurrencyCodeA3 {
}

class CustomerPresent {
}

class EntryMode {
}

class RequestACI {
}

class RequestAdvice {
}

class GetMerchantProfileIds {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class GetMerchantProfileIdsResponse {
  public $GetMerchantProfileIdsResult; // ArrayOfstring
}

class GetMerchantProfilesByProfileId {
  public $sessionToken; // string
  public $merchantProfileId; // string
}

class GetMerchantProfilesByProfileIdResponse {
  public $GetMerchantProfilesByProfileIdResult; // ArrayOfMerchantProfile
}

class GetMerchantProfile {
  public $sessionToken; // string
  public $merchantProfileId; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class GetMerchantProfileResponse {
  public $GetMerchantProfileResult; // MerchantProfile
}

class DeleteMerchantProfile {
  public $sessionToken; // string
  public $merchantProfileId; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class DeleteMerchantProfileResponse {
}

class SaveMerchantProfiles {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
  public $merchantProfiles; // ArrayOfMerchantProfile
}

class SaveMerchantProfilesResponse {
}

class SignOnWithUsernamePasswordForServiceKey {
  public $serviceKey; // string
  public $username; // string
  public $password; // string
}

class SignOnWithUsernamePasswordForServiceKeyResponse {
  public $SignOnWithUsernamePasswordForServiceKeyResult; // string
}

class ResetPasswordForServiceKey {
  public $serviceKey; // string
  public $userName; // string
}

class ResetPasswordForServiceKeyResponse {
}

class ChangePasswordForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
  public $newPassword; // string
}

class ChangePasswordForServiceKeyResponse {
}

class ChangeUsernameForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
  public $newUsername; // string
}

class ChangeUsernameForServiceKeyResponse {
}

class ChangeEmailForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
  public $newEmail; // string
}

class ChangeEmailForServiceKeyResponse {
}

class GetPasswordExpirationForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
}

class GetPasswordExpirationForServiceKeyResponse {
  public $GetPasswordExpirationForServiceKeyResult; // dateTime
}

class ValidateMerchantProfile {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
  public $merchantProfile; // MerchantProfile
}

class ValidateMerchantProfileResponse {
}

class GetAllClaims {
  public $authenticatingToken; // string
  public $verifiedToken; // string
}

class GetAllClaimsResponse {
  public $GetAllClaimsResult; // ArrayOfClaimMetaData
}

class GetClaims {
  public $authenticatingToken; // string
  public $verifiedToken; // string
  public $claimNSs; // ArrayOfstring
}

class GetClaimsResponse {
  public $GetClaimsResult; // ArrayOfstring
}

class Renew {
  public $authenticatingToken; // string
  public $toRenewToken; // string
}

class RenewResponse {
  public $RenewResult; // string
}

class SignOnAndAddClaims {
  public $identityToken; // string
  public $claims; // ArrayOfClaimMetaData
}

class SignOnAndAddClaimsResponse {
  public $SignOnAndAddClaimsResult; // string
}

class DelegatedSignOn {
  public $identityToken; // string
  public $onBehalfOfSk; // string
  public $claims; // ArrayOfClaimMetaData
}

class DelegatedSignOnResponse {
  public $DelegatedSignOnResult; // string
}

class FederatedSignOn {
  public $identityToken; // string
  public $externalDomainToken; // string
}

class FederatedSignOnResponse {
  public $FederatedSignOnResult; // string
}

class FederatedSignOnAndAddClaims {
  public $identityToken; // string
  public $externalDomainToken; // string
  public $claims; // ArrayOfClaimMetaData
}

class FederatedSignOnAndAddClaimsResponse {
  public $FederatedSignOnAndAddClaimsResult; // string
}

class CWSFault {
}

class CWSBaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

class CWSServiceInformationUnavailableFault {
}

class CWSValidationResultFault {
  public $Errors; // ArrayOfCWSValidationErrorFault
}

class CWSValidationErrorFault {
  public $ErrorType; // CWSValidationErrorFault.EErrorType
  public $RuleKey; // string
  public $RuleLocationKey; // string
  public $RuleMessage; // string
  public $TransactionId; // string
}

class CWSValidationErrorFault_EErrorType {
}

?>
