<?php
/**
 * CWSTransactionManagement class file
 * 
 */

class DateRange {
  public $EndDateTime; // dateTime
  public $StartDateTime; // dateTime
}

class PagingParameters {
  public $Page; // int
  public $PageSize; // int
}

class DataServicesUnavailableFault {
}

class DSBaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}


/*class Return {
  public $TransactionId; // string
  public $Addendum; // Addendum
  public $TransactionDateTime; // string
}*/


class TransactionClassTypePair {
  public $TransactionClass; // string
  public $TransactionType; // string
}

class FamilyInformation {
  public $FamilyId; // guid
  public $FamilySequenceCount; // int
  public $FamilySequenceNumber; // int
  public $FamilyState; // TransactionState
  public $NetAmount; // decimal
}

class TransactionInformation {
  public $Amount; // decimal
  public $ApprovalCode; // string
  public $BankcardData; // BankcardData
  public $BatchId; // string
  public $CaptureDateTime; // dateTime
  public $CaptureState; // CaptureState
  public $CaptureStatusMessage; // string
  public $CapturedAmount; // decimal
  public $CustomerId; // string
  public $ElectronicCheckData; // ElectronicCheckData
  public $IsAcknowledged; // BooleanParameter
  public $MaskedPAN; // string
  public $MerchantProfileId; // string
  public $OriginatorTransactionId; // string
  public $ServiceId; // string
  public $ServiceKey; // string
  public $ServiceTransactionId; // string
  public $Status; // Status
  public $StoredValueData; // StoredValueData
  public $TransactionClassTypePair; // TransactionClassTypePair
  public $TransactionId; // string
  public $TransactionState; // TransactionState
  public $TransactionStatusCode; // string
  public $TransactionTimestamp; // dateTime
}

class BankcardData {
  public $AVSResult; // AVSResult
  public $CVResult; // CVResult
  public $CardType; // TypeCardType
}

class ElectronicCheckData {
  public $CheckNumber; // string
  public $MaskedAccountNumber; // string
  public $TransactionType; // TransactionType
}

class BooleanParameter {
}

class StoredValueData {
  public $CVResult; // CVResult
}

class SummaryDetail {
  public $FamilyInformation; // FamilyInformation
  public $TransactionInformation; // TransactionInformation
}

class QueryBatch {
  public $sessionToken; // string
  public $queryBatchParameters; // QueryBatchParameters
  public $pagingParameters; // PagingParameters
}

class QueryBatchParameters {
  public $BatchDateRange; // DateRange
  public $BatchIds; // ArrayOfstring
  public $MerchantProfileIds; // ArrayOfstring
  public $ServiceKeys; // ArrayOfstring
  public $TransactionIds; // ArrayOfstring
}

class QueryBatchResponse {
  public $QueryBatchResult; // ArrayOfBatchDetailData
}

class BatchDetailData {
  public $BatchCaptureDate; // dateTime
  public $BatchId; // string
  public $BatchSummaryData; // TransactionSummaryData
  public $CaptureState; // CaptureState
  public $Description; // string
  public $SummaryData; // SummaryData
  public $TransactionIds; // ArrayOfstring
}

class QueryTransactionFamilies {
  public $sessionToken; // string
  public $queryTransactionsParameters; // QueryTransactionsParameters
  public $pagingParameters; // PagingParameters
}

class QueryTransactionsParameters {
  public $Amounts; // ArrayOfdecimal
  public $ApprovalCodes; // ArrayOfstring
  public $BatchIds; // ArrayOfstring
  public $CaptureDateRange; // DateRange
  public $CaptureStates; // ArrayOfCaptureState
  public $CardTypes; // ArrayOfTypeCardType
  public $IsAcknowledged; // BooleanParameter
  public $MerchantProfileIds; // ArrayOfstring
  public $QueryType; // QueryType
  public $ServiceIds; // ArrayOfstring
  public $ServiceKeys; // ArrayOfstring
  public $TransactionClassTypePairs; // ArrayOfTransactionClassTypePair
  public $TransactionDateRange; // DateRange
  public $TransactionIds; // ArrayOfstring
  public $TransactionStates; // ArrayOfTransactionState
}

class QueryType {
}

class QueryTransactionFamiliesResponse {
  public $QueryTransactionFamiliesResult; // ArrayOfFamilyDetail
}

class FamilyDetail {
  public $BatchId; // string
  public $CaptureDateTime; // dateTime
  public $CapturedAmount; // decimal
  public $CustomerId; // string
  public $FamilyId; // guid
  public $FamilyState; // TransactionState
  public $LastAuthorizedAmount; // decimal
  public $MerchantProfileId; // string
  public $NetAmount; // decimal
  public $ServiceKey; // string
  public $TransactionIds; // ArrayOfstring
  public $TransactionMetaData; // ArrayOfTransactionMetaData
}

class QueryTransactionsDetail {
  public $sessionToken; // string
  public $queryTransactionsParameters; // QueryTransactionsParameters
  public $transactionDetailFormat; // TransactionDetailFormat
  public $includeRelated; // boolean
  public $pagingParameters; // PagingParameters
}

class TransactionDetailFormat {
}

class QueryTransactionsDetailResponse {
  public $QueryTransactionsDetailResult; // ArrayOfTransactionDetail
}

class QueryTransactionsSummary {
  public $sessionToken; // string
  public $queryTransactionsParameters; // QueryTransactionsParameters
  public $includeRelated; // boolean
  public $pagingParameters; // PagingParameters
}

class QueryTransactionsSummaryResponse {
  public $QueryTransactionsSummaryResult; // ArrayOfSummaryDetail
}

class QueryRejectedSummary {
  public $sessionToken; // string
  public $queryRejectedParameters; // QueryRejectedParameters
  public $pagingParameters; // PagingParameters
}

class QueryRejectedSummaryResponse {
  public $QueryRejectedSummaryResult; // QueryResponse
}

class QueryRejectedDetail {
  public $sessionToken; // string
  public $queryRejectedParameters; // QueryRejectedParameters
  public $pagingParameters; // PagingParameters
}

class QueryRejectedDetailResponse {
  public $QueryRejectedDetailResult; // QueryResponse
}


class TMSUnknownServiceKeyFault {
}

class TMSBaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

class TMSTransactionFailedFault {
}

class TMSOperationNotSupportedFault {
}

class TMSUnavailableFault {
}

?>
