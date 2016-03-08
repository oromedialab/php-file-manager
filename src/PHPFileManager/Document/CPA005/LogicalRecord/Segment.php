<?php

namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

/**
 * Each segment consist of 240 characters
 */
class Segment
{
	protected $transactionType;

	protected $amount;

	protected $dueDate;

	protected $institutionCode;

	protected $transitNumber;

	protected $accountNumber;

	protected $storedTransactionType;

	protected $originatorShortName;

	protected $recipientName;

	protected $originatorLongName;

	protected $customerNumber;

	protected $originatorCrossReferenceNumber;

	protected $returnInstitutionCode;

	protected $returnBranchTransitNumber;

	protected $returnAccountNumber;

	protected $originatorDirectClearerSettlementCode;

	protected $invalidDataElementId;
}
