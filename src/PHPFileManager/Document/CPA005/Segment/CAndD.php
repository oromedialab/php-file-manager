<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\Segment;

use Oml\PHPFileManager\Document\CPA005\Interfaces\SegmentInterface;
use Oml\PHPFileManager\Document\CPA005\Utility\TransactionType;
use Oml\PHPFileManager\Document\CPA005\Utility\Fillers;
use Oml\PHPFileManager\Document\CPA005\Utility\Functions;

abstract class CAndD implements SegmentInterface
{
	/**
	 * Transaction Type
	 *    Three digit transaction code as defined by the CPA. If no transaction code is entered, it will default to the transaction code on the profile. 
	 * [Length=3, Position[start]=25, Position[end]=27]
	 *
	 * @var string
	 */
	protected $transactionType;

	/**
	 * Amount
	 *    Payment amount format $$$$$$$$¢¢ 
	 * [Length=10, Position[start]=28, Position[end]=37]
	 *
	 * @var integer
	 */
	protected $amount;

	/**
	 * Payment Date
	 *    Format 0YYDDD, cannot be more that 173 days in the past or 173 in the future.
	 * [Length=6, Position[start]=38, Position[end]=43]
	 *
	 * @var string
	 */
	protected $paymentDate;

	/**
	 * Institution Code Initial
	 * [Length=1, Position[start]=44, Position[end]=44]
	 *
	 * @var integer
	 */
	protected $zeroFiller1;

	/**
	 * Institution Code
	 *     Institution where the payee/payer maintains account
	 * [Length=3, Position[start]=45, Position[end]=47]
	 *
	 * @var integer
	 */
	protected $institutionCode;

	/**
	 * Transit Number
	 *    Branch where the payee/payer maintains account
	 * [Length=5, Position[start]=48, Position[end]=52]
	 *
	 * @var integer
	 */
	protected $transitNumber;

	/**
	 * Bank Account Number
	 *     Payee's / Payer's bank account number
	 *     Must be space filled (Do not zero fill)
	 * [Length=12, Position[start]=53, Position[end]=64]
	 *
	 * @var integer
	 */
	protected $bankAccountNumber;

	/**
	 * Item Trace Number
	 * [Length=22, Position[start]=65, Position[end]=86]
	 *
	 * @var integer
	 */
	protected $zeroFiller2;

	/**
	 * Stored Transaction Type
	 * [Length=3, Position[start]=87, Position[end]=89]
	 *
	 * @var integer
	 */
	protected $zeroFiller3;

	/**
	 * Originator Short Name
	 *     Will appear on customer statements.
	 *     If left blank, client short name will default from Client Profile.
	 *     Use an abbreviation of the payment originator's short name
	 *     Must be space filled (Do not zero fill)
	 * [Length=15, Position[start]=90, Position[end]=104]
	 *
	 * @var string
	 */
	protected $originatorShortName;

	/**
	 * Customer Name
	 *    Payee's/Payer's Name
	 *    Payment will be rejected if missing
	 *    Must be space filled (Do not zero fill)
	 * [Length=30, Position[start]=105, Position[end]=134]
	 *
	 * @var string
	 */
	protected $customerName;

	/**
	 * Originator Long Name
	 *    The payment originator's long name
	 *    Must be space filled (Do not zero fill)
	 * [Length=30, Position[start]=135, Position[end]=164]
	 * 
	 * @var string
	 */
	protected $originatorLongName;

	/**
	 * Originating Direct Clearer's User's ID (Same as Originator Account Number)
	 * [Length=10, Position[start]=165, Position[end]=174]
	 *
	 * @var string
	 */
	protected $originatorDirectClearerUserId;

	/**
	 * Originator Cross Reference Number (Client assigned customer number)
	 *     This number is assigned by the payment originator
	 *     This number should be unique for each transaction in the event a trace or recalled is required
	 *     If missing, the payment will be rejected
	 *     Must be space filled (Do not zero fill)
	 * [Length=19, Position[start]=175, Position[end]=193]
	 *
	 * @var string
	 */
	protected $originatorCrossReferenceNumber;

	/**
	 * Reserved
	 * [Length=1, Position[start]=194, Position[end]=194]
	 *
	 * @var integer
	 */
	protected $zeroFiller4;

	/**
	 * Return Institution Code
	 * [Length=3, Position[start]=195, Position[end]=197]
	 *
	 * @var integer
	 */
	protected $returnInstitutionCode;

	/**
	 * Return Branch Transit Number
	 *    Branch transit number to which charged back item would be returned
	 * [Length=5, Position[start]=198, Position[end]=202]
	 *
	 * @var integer
	 */
	protected $returnBranchTransitNumber;

	/**
	 * Return Branch Account Number
	 *    Branch account number to which charged back item would be returned
	 * [Length=12, Position[start]=203, Position[end]=214]
	 *
	 * @var integer
	 */
	protected $returnBranchAccountNumber;

	/**
	 * Originator sundry information
	 *     Must be space filled (Do not zero fill)
	 * [Length=15, Position[start]=215, Position[end]=229]
	 */
	protected $originatorSundryInformation;

	/**
	 * Reserved
	 * [Length=22, Position[start]=230, Position[end]=251]
	 *
	 * @var integer
	 */
	protected $spaceFiller1;

	/**
	 * Originator Direct Clearer Settlement Code
	 * [Length=2, Position[start]=252, Position[end]=253]
	 *
	 * @var integer
	 */
	protected $originatorDirectClearerSettlementCode;

	/**
	 * Invalid data element ID
	 * [Length=11, Position[start]=254, Position[end]=264]
	 */
	protected $invalidDataElementId;

	/**
	 * Set Transaction Type
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setTransactionType($value)
	{
		if(!TransactionType::constantValueExist($value)) {
			throw new \Exception('Invalid transaction type "'.$value.'"');
		}
		$this->transactionType = $value;
		return $this;
	}

	/**
	 * Get Transaction Type
	 *
	 * @return integer|string
	 */
	public function getTransactionType()
	{
		return $this->transactionType;
	}

	/**
	 * Set Amount
	 *
	 * @param float|decimal|integer $value
	 * @return $this
	 */
	public function setAmount($value)
	{
		$this->amount = Functions::formatAmount($value);
		return $this;
	}

	/**
	 * Get Amount
	 *
	 * @return float|decimal|integer
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * Set Payment Date
	 *
	 * @param DateTime $value
	 * @return $this
	 */
	public function setPaymentDate(\DateTime $value)
	{
		$this->paymentDate = $value;
		return $this;
	}

	/**
	 * Get Payment Date
	 *
	 * @return string
	 */
	public function getPaymentDate()
	{
		return Functions::dateTimeToJulianFormat($this->paymentDate);
	}

	/**
	 * Get Zero Filler
	 *
	 * @return string
	 */
	public function getZeroFiller1()
	{
		return Fillers::generate(null, 1, Fillers::ZERO_FILLER);
	}

	/**
	 * Get Institution Code
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setInstitutionCode($value)
	{
		$this->institutionCode = $value;
		return $this;
	}

	/**
	 * Get Institution Code
	 *
	 * @return integer|string
	 */
	public function getInstitutionCode()
	{
		return $this->institutionCode;
	}

	/**
	 * Set Transit Number
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setTransitNumber($value)
	{
		$this->transitNumber = $value;
		return $this;
	}

	/**
	 * Get Transit Number
	 *
	 * @return integer|string
	 */
	public function getTransitNumber()
	{
		return $this->transitNumber;
	}

	/**
	 * Set Bank Account Number
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setBankAccountNumber($value)
	{
		$this->bankAccountNumber = $value;
		return $this;
	}

	/**
	 * Get Bank Account Number
	 *
	 * @return integer|string
	 */
	public function getBankAccountNumber()
	{
		return Fillers::truncateOrFill($this->bankAccountNumber, 12, Fillers::SPACE_FILLER);
	}

	/**
	 * Get Zero Filler
	 *
	 * @return string
	 */
	public function getZeroFiller2()
	{
		return Fillers::generate(null, 22, Fillers::ZERO_FILLER);
	}

	/**
	 * Get Zero Filler
	 *
	 * @return string
	 */
	public function getZeroFiller3()
	{
		return Fillers::generate(null, 3, Fillers::ZERO_FILLER);
	}

	/**
	 * Set Originator Short Name
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setOriginatorShortName($value)
	{
		$this->originatorShortName = $value;
		return $this;
	}

	/**
	 * Get Originator Short Name
	 *
	 * @return string
	 */
	public function getOriginatorShortName()
	{
		return Fillers::truncateOrFill($this->originatorShortName, 15, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Customer Name
	 *
	 * @param string $value
	 * @return string
	 */
	public function setCustomerName($value)
	{
		$this->customerName = $value;
		return $this;
	}

	/**
	 * Get Customer Name
	 *
	 * @return string
	 */
	public function getCustomerName()
	{
		return Fillers::truncateOrFill($this->customerName, 30, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Originator Long Name
	 *
	 * @return string
	 */
	public function setOriginatorLongName($value)
	{
		$this->originatorLongName = $value;
		return $this;
	}

	/**
	 * Get Originator Long Name
	 *
	 * @return string
	 */
	public function getOriginatorLongName()
	{
		return Fillers::truncateOrFill($this->originatorLongName, 30, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Originator Direct Clearer User Id
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setOriginatorDirectClearerUserId($value)
	{
		$this->originatorDirectClearerUserId = $value;
		return $this;
	}

	/**
	 * Get Originator Direct Clearer User Id
	 *
	 * @return integer|string
	 */
	public function getOriginatorDirectClearerUserId()
	{
		return Fillers::truncateOrFill($this->originatorDirectClearerUserId, 10, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Origiin Cross Reference Number
	 *
	 * @param integer|string $value
	 * @return $value
	 */
	public function setOriginatorCrossReferenceNumber($value)
	{
		$this->originatorCrossReferenceNumber = $value;
		return $this;
	}

	/**
	 * Get Origiin Cross Reference Number
	 *
	 * @return string
	 */
	public function getOriginatorCrossReferenceNumber()
	{
		return Fillers::truncateOrFill($this->originatorCrossReferenceNumber, 19, Fillers::SPACE_FILLER);
	}

	/**
	 * Get Zero Filler
	 *
	 * @return string
	 */
	public function getZeroFiller4()
	{
		return Fillers::generate(null, 1, Fillers::ZERO_FILLER);
	}

	/**
	 * Set Return Institution Code
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setReturnInstitutionCode($value)
	{
		$this->returnInstitutionCode = $value;
		return $this;
	}

	/**
	 * Get Return Institution Code
	 *
	 * @return integer|string
	 */
	public function getReturnInstitutionCode()
	{
		return Fillers::truncateOrFill($this->returnInstitutionCode, 3, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Return Branch Transit Number
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setReturnBranchTransitNumber($value)
	{
		$this->returnBranchTransitNumber = $value;
		return $this;
	}

	/**
	 * Get Return Branch Transit Number
	 *
	 * @return string
	 */
	public function getReturnBranchTransitNumber()
	{
		return Fillers::truncateOrFill($this->returnBranchTransitNumber, 5, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Return Branch Account Number
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setReturnBranchAccountNumber($value)
	{
		$this->returnBranchAccountNumber = $value;
		return $this;
	}

	/**
	 * Get Return Branch Account Number
	 *
	 * @return integer|string
	 */
	public function getReturnBranchAccountNumber()
	{
		return Fillers::truncateOrFill($this->returnBranchAccountNumber, 12, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Originator Sundry Information
	 *
	 * @param string
	 * @return $this
	 */
	public function setOriginatorSundryInformation($value)
	{
		$this->originatorSundryInformation = $value;
		return $this;
	}

	/**
	 * Get Originator Sundry Information
	 *
	 * @return string
	 */
	public function getOriginatorSundryInformation()
	{
		return Fillers::truncateOrFill($this->originatorSundryInformation, 15, Fillers::SPACE_FILLER);
	}

	/**
	 * Get Space Filler
	 *
	 * @return string
	 */
	public function getSpaceFiller1()
	{
		return Fillers::generate(null, 22, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Originator Direct Clearer Settlement Code
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setOriginatorDirectClearerSettlementCode($value)
	{
		$this->originatorDirectClearerSettlementCode = $value;
		return $this;
	}

	/**
	 * Get Originator Direct Clearer Settlement Code
	 *
	 * @return integer|string
	 */
	public function getOriginatorDirectClearerSettlementCode()
	{
		return Fillers::truncateOrFill($this->originatorDirectClearerSettlementCode, 2, Fillers::SPACE_FILLER);
	}

	/**
	 * Set Invalid Data Element Id
	 *
	 * @param integer|string $value
	 * @return $this
	 */
	public function setInvalidDataElementId($value)
	{
		$this->invalidDataElementId = $value;
		return $this;
	}

	/**
	 * Get Invalid Data Element Id
	 *
	 * @return integer|string
	 */
	public function getInvalidDataElementId()
	{
		return Fillers::truncateOrFill($this->invalidDataElementId, 11, Fillers::ZERO_FILLER);
	}

	/**
	 * Dump Content
	 * @return string CPA5 Format Dumped Content
	 */
	public function dump()
	{
		// Transaction Type
		$value = $this->getTransactionType();
		// Amount
		$value .= $this->getAmount();
		// Payment date
		$value .= $this->getPaymentDate();
		// Zero Filler 1
		$value .= $this->getZeroFiller1();
		// Institution Code
		$value .= $this->getInstitutionCode();
		// Transit Number
		$value .= $this->getTransitNumber();
		// Bank Account Number
		$value .= $this->getBankAccountNumber();
		// Zero Filler 2
		$value .= $this->getZeroFiller2();
		// Zero Filler 3
		$value .= $this->getZeroFiller3();
		// Originator Short Name
		$value .= $this->getOriginatorShortName();
		// Customer Name
		$value .= $this->getCustomerName();
		// Originator Long Name
		$value .= $this->getOriginatorLongName();
		//  Originating Direct Clearer's User's ID
		$value .= $this->getOriginatorDirectClearerUserId();
		// Originator Cross Reference Number (Client assigned customer number)
		$value .= $this->getOriginatorCrossReferenceNumber();
		// Zero Filler 4
		$value .= $this->getZeroFiller4();
		// Return Institution Code
		$value .= $this->getReturnInstitutionCode();
		// Return Branch Transit Number
		$value .= $this->getReturnBranchTransitNumber();
		// Return Branch Account Number
		$value .= $this->getReturnBranchAccountNumber();
		// Originator sundry information
		$value .= $this->getOriginatorSundryInformation();
		// Space Filler 1
		$value .= $this->getSpaceFiller1();
		// Originator Direct Clearer Settlement Code
		$value .= $this->getOriginatorDirectClearerSettlementCode();
		// Invalid data element ID
		$value .= $this->getInvalidDataElementId();
		return $value;
	}
}
