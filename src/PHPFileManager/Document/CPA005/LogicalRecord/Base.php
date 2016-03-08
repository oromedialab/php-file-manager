<?php

namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

class Base
{
	/**
	 * Filler Value (Space)
	 *
	 * @var string
	 */
	const FILLER_VALUE_SPACE = ' ';

	/**
	 * Filler Value (Zero)
	 *
	 * @var string
	 */
	const FILLER_VALUE_ZERO = 0;

	/**
	 * Record Length
	 *
	 * @var integer
	 */
	const RECORD_LENGTH = 1464;

	/**
	 * Logical Record Type Count
	 * Example:(000000001, 000000002...), Length=9, Position[start]=2, Position[end]=10
	 *
	 * @var integer
	 */
	protected $logicalRecordCount;

	/**
	 * Customer Number (Originator's ID)
	 *     10 digit customer number as follows: 6 digit client number assigned by Bank & 4 digit Operating subsidiary number assigned by the client or 0000. 
	 * Example: (1111111111), Length=10, Position[start]=11, Position[end]=20
	 *
	 * @var integer
	 */
	protected $customerNumber;

	/**
	 * File creation number (FCN)
	 *     4 digit number (numeric) to identify this file, must be different from previous 9 numbers submitting for processing
	 *     When submitting a test file, the FCN must be TEST or 0000
	 *     This number is used to prevent the inadvertent processing of duplicate file
	 *     It must contain a unique non-zero value for each production file processed by bank
	 *     It is recommended to start with FCN 0001 and incrementing this number by one for each production file submitted
	 *     Production files will be rejected if this field is not unique
	 * Example: (3128), Length=4, Position[start]=21, Position[end]=24
	 */
	protected $fileCreationNumber;

	/**
	 * Set Logical Record Count
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setLogicalRecordCount($value)
	{
		$this->logicalRecordCount = sprintf('%09d', $value);
		return $this;
	}

	/**
	 * Get Logical Record Count
	 *
	 * @return integer
	 */
	public function getLogicalRecordCount()
	{
		return $this->logicalRecordCount;
	}

	/**
	 * Set Customer Number
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setCustomerNumber($value)
	{
		if (10 != strlen($value)) {
			throw new \Exception('Customer number must contain 10 characters, '.strlen($value). 'given');
		}
		$this->customerNumber = $value;
		return $this;
	}

	/**
	 * Get Customer Number
	 *
	 * @return integer
	 */
	public function getCustomerNumber()
	{
		return $this->customerNumber;
	}

	/**
	 * Set File Creation Number
	 *
	 * @param integer $value
	 * @return $this
	 */
	public function setFileCreationNumber($value)
	{
		if (4 != strlen($value)) {
			throw new \Exception('File creation number (FCN) must contain 4 characters, '.strlen($value). 'given');
		}
		$this->fileCreationNumber = $value;
		return $this;
	}

	/**
	 * Get File Creation Number
	 *
	 * @return integer
	 */
	public function getFileCreationNumber()
	{
		return $this->fileCreationNumber;
	}

	public function getLogicalRecordTypeId()
	{
		return static::LOGICAL_RECORD_ID;
	}

	/**
	 * Generate Fillers
	 *
	 * @return string
	 */
	protected function fillers($record, $length = null, $filler = self::FILLER_VALUE_SPACE)
	{
		$multiplier = null === $length && null !== $record ? self::RECORD_LENGTH - strlen($record) : $length;
		$multiplier = (int)$multiplier;
		return str_repeat($filler, $multiplier);
	}
}
