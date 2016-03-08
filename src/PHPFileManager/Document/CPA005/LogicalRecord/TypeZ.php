<?php

namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

class TypeZ extends Base implements LogicalRecordTypeInterface
{
	/**
	 * Logical Record Type ID
	 * Example:(A, C, D, Z), Length=1, Position[start]=1, Position[end]=1
	 *
	 * @var string
	 */
	const LOGICAL_RECORD_ID = 'Z';

	/**
	 * Transaction Type (Credit or Debit)
	 *    Use "C" for Credit and "D" for Debit
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Total Amount Of Debits
	 *     Total dollar value of debits, The sum of the Amount fields on all D records
	 *     Zero fill if there are no debit records
	 *     The file will be rejected if this field does not balance to the SUM of amount in D records 
	 * Example: (00000000005000), Length=14, Position[start]=25, Position[end]=38
	 *
	 * @var integer
	 */
	protected $totalAmountOfDebits;

	/**
	 * Total Number of Debits
	 *     The number of D records in the file
	 *     Zero fill if there are no debit records
	 *     The file will be rejected if this field does not balance to the number of D records
	 * Example: (00000006), Length=8, Position[start]=39, Position[end]=46
	 *
	 * @var integer
	 */
	protected $totalNumberOfDebits;

	/**
	 * Total Amount Of Credits
	 *     Total dollar value of credits, The sum of the Amount fields on all C records
	 *     Zero fill if there are no credit records
	 *     The file will be rejected if this field does not balance to the SUM of amount in C records 
	 * Example: (00000000008000), Length=14, Position[start]=47, Position[end]=60
	 *
	 * @var integer
	 */
	protected $totalAmountOfCredits;

	/**
	 * Total Number of Credits
	 *     The number of C records in the file
	 *     Zero fill if there are no credit records
	 *     The file will be rejected if this field does not balance to the number of C records
	 * Example: (000000026), Length=8, Position[start]=61, Position[end]=68
	 *
	 * @var integer
	 */
	protected $totalNumberOfCredits;

	/**
	 * Total Value of Error Corrections "E"
	 *
	 * @var integer
	 */
	protected $totalValueOfErrorCorrectionsForE;

	/**
	 * Total Number of Error Corrections "E"
	 *
	 * @var integer
	 */
	protected $totalNumberOfErrorCorrectionsForE;

	/**
	 * Total Value of Error Corrections "F"
	 *
	 * @var integer
	 */
	protected $totalValueOfErrorCorrectionsForF;

	/**
	 * Total Number of Error Corrections "F"
	 *
	 * @var integer
	 */
	protected $totalNumberOfErrorCorrectionsForF;

	public function __construct($type)
	{
		if (!is_string($type)) {
			throw new \Exception('Type must be in string format, '.gettype($type). 'given');
		}
		if (!in_array($type, array('C', 'D'))) {
			throw new \Exception('Type must contain the value C or D, '.$type.' given');
		}
		$this->type = $type;
	}

	/**
	 * Get Type (Credit[C] or Debit[D])
	 *
	 * @return string
	 */
	protected function getType()
	{
		return $this->type;
	}

	/**
	 * Set Total Amount of Debits
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalAmountOfDebits($value)
	{
		$value = (int)$value;
		$this->totalAmountOfDebits = sprintf('%014d', $value);
		return $this;
	}

	/**
	 * Get Total Amount of Debits
	 *
	 * @return integer
	 */
	public function getTotalAmountOfDebits()
	{
		return $this->totalAmountOfDebits;
	}

	/**
	 * Set Total Number of Debits
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalNumberOfDebits($value)
	{
		$value = (int)$value;
		$this->totalNumberOfDebits = sprintf('%08d', $value);
		return $this;
	}

	/**
	 * Get Total Number of Debits
	 *
	 * @return integer
	 */
	public function getTotalNumberOfDebits()
	{
		return $this->totalNumberOfDebits;
	}

	/**
	 * Set Total Amount of Credits
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalAmountOfCredits($value)
	{
		$value = (int)$value;
		$this->totalAmountOfCredits = sprintf('%014d', $value);
		return $this;
	}

	/**
	 * Get Total Amount of Credits
	 *
	 * @return integer
	 */
	public function getTotalAmountOfCredits()
	{
		return $this->totalAmountOfCredits;
	}

	/**
	 * Set Total Number of Credits
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalNumberOfCredits($value)
	{
		$value = (int)$value;
		$this->totalNumberOfCredits = sprintf('%08d', $value);
		return $this;
	}

	/**
	 * Get Total Number of Credits
	 *
	 * @return integer
	 */
	public function getTotalNumberOfCredits()
	{
		return $this->totalNumberOfCredits;
	}

	/**
	 * Set Total Value of Error Corrections For "E"
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalValueOfErrorCorrectionsForE($value)
	{
		$this->totalValueOfErrorCorrectionsForE = $value;
		return $this;
	}

	/**
	 * Get Total Value of Error Corrections For "E"
	 *
	 * @return integer (If value is empty return with zero filles of 14 characters)
	 */
	public function getTotalValueOfErrorCorrectionsForE()
	{
		return empty($this->totalValueOfErrorCorrectionsForE) ? $this->fillers(null, 14, parent::FILLER_VALUE_ZERO) : $this->totalValueOfErrorCorrectionsForE;
	}

	/**
	 * Set Total Number Of Error Corrections For E
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalNumberOfErrorCorrectionsForE($value)
	{
		$this->totalNumberOfErrorCorrectionsForE = $value;
		return $this;
	}

	/**
	 * Get Total Number Of Error Corrections For E
	 *
	 * @return integer (If value is empty return with zero filles of 8 characters)
	 */
	public function getTotalNumberOfErrorCorrectionsForE()
	{
		return empty($this->totalNumberOfErrorCorrectionsForE) ? $this->fillers(null, 8, parent::FILLER_VALUE_ZERO) : $this->totalNumberOfErrorCorrectionsForE;
	}

	/**
	 * Set Total Value of Error Corrections For F
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalValueOfErrorCorrectionsForF($value)
	{
		$this->totalValueOfErrorCorrectionsForF = $value;
		return $this;
	}

	/**
	 * Get Total Value of Error Corrections For F
	 *
	 * @return integer (If value is empty return with zero filles of 8 characters)
	 */
	public function getTotalValueOfErrorCorrectionsForF()
	{
		return empty($this->totalValueOfErrorCorrectionsForF) ? $this->fillers(null, 14, parent::FILLER_VALUE_ZERO) : $this->totalValueOfErrorCorrectionsForF;
	}

	/**
	 * Set Total Number Of Error Corrections For F
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setTotalNumberOfErrorCorrectionsForF($value)
	{
		$this->totalNumberOfErrorCorrectionsForF = $value;
		return $this;
	}

	/**
	 * Get Total Number Of Error Corrections For F
	 *
	 * @return integer (If value is empty return with zero filles of 8 characters)
	 */
	public function getTotalNumberOfErrorCorrectionsForF()
	{
		return empty($this->totalNumberOfErrorCorrectionsForF) ? $this->fillers(null, 8, parent::FILLER_VALUE_ZERO) : $this->totalNumberOfErrorCorrectionsForF;
	}

	/**
	 * Dump Logical Record Content
	 *
	 * @return string
	 */
	public function dump()
	{
		// Logical Record Type
		$value  = $this->getLogicalRecordTypeId();
		// Logical Record Count
		$value .= $this->getLogicalRecordCount();
		// Customer Number
		$value .= $this->getCustomerNumber();
		// File Creation Number (FCN)
		$value .= $this->getFileCreationNumber();
		switch ($this->getType()) {
			case 'C':
				if (empty($this->getTotalAmountOfCredits())) {
					throw new \Exception('Empty or invalid total amount of credits, set total amount of credits using '.__CLASS__.'::setTotalAmountOfCredits()');
				}
				if (empty($this->getTotalNumberOfCredits())) {
					throw new \Exception('Empty or invalid total number of credits, set total number of credits using '.__CLASS__.'::setTotalNumberOfCredits');
				}
				$value .= $this->fillers(null, 14, parent::FILLER_VALUE_ZERO);
				$value .= $this->fillers(null, 8, parent::FILLER_VALUE_ZERO);
				$value .= $this->getTotalAmountOfCredits();
				$value .= $this->getTotalNumberOfCredits();
			break;
			case 'D':
				if (empty($this->getTotalAmountOfDebits())) {
					throw new \Exception('Empty or invalid total amount of debits, set total amount of debits using '.__CLASS__.'::setTotalAmountOfDebits()');
				}
				if (empty($this->getTotalNumberOfDebits())) {
					throw new \Exception('Empty or invalid total number of debits, set total number of debits using '.__CLASS__.'::setTotalNumberOfDebits()');
				}
				$value .= $this->getTotalAmountOfDebits();
				$value .= $this->getTotalNumberOfDebits();
				$value .= $this->fillers(null, 14, parent::FILLER_VALUE_ZERO);
				$value .= $this->fillers(null, 8, parent::FILLER_VALUE_ZERO);
			break;
		}
		// Total Value of Error Corrections "E"
		$value .= $this->getTotalValueOfErrorCorrectionsForE();
		// Total Number of Error Corrections "E"
		$value .= $this->getTotalNumberOfErrorCorrectionsForE();
		// Total Value of Error Corrections "F"
		$value .= $this->getTotalValueOfErrorCorrectionsForF();
		// Total Number of Error Corrections "F"
		$value .= $this->getTotalNumberOfErrorCorrectionsForF();
		// Fillers
		$value .= $this->fillers($value);
		return $value;
	}
}
