<?php

namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

class TypeA extends Base implements LogicalRecordTypeInterface
{
	/**
	 * Logical Record Type ID
	 * Example:(A, C, D, Z), Length=1, Position[start]=1, Position[end]=1
	 *
	 * @var string
	 */
	const LOGICAL_RECORD_ID = 'A';

	/**
	 * File Creation Date
	 *    Julian Format - 0yyddd where yy are the last two digits of the yearin the range 001-366
	 *    October 2, 2001 is represented as 001275.
	 *    The file will be rejected if this field is invalid, contains a date in the future, or contains a date more than ten days prior to transmission date
	 * Example: (001275), Length=6, Position[start]=25, Position[end]=30
	 *
	 * @var \DateTime
	 */
	protected $fileCreationDate;

	/**
	 * File Processing Centre (The centre where the file will be processed.)
	 *     Example: (81510), Length=5, Position[start]=31, Position[end]=35
	 */
	protected $fileProcessingCentre;

	public function getLogicalRecordTypeId()
	{
		return self::LOGICAL_RECORD_ID;
	}

	/**
	 * Set File Creation Date
	 *
	 * @param \DateTime $value
	 * @return $this
	 */
	public function setFileCreationDate(\DateTime $value)
	{
		$this->fileCreationDate = $value;
		return $this;
	}

	/**
	 * Get File Creation Date (convert into julian date format (0yyddd))
	 *
	 * @return string
	 */
	public function getFileCreationDate()
	{
		$date = $this->fileCreationDate;
		if (!$date instanceof \DateTime) {
			throw new \Exception('File creation date must be instance of datetime, '.gettype($date).' given');
		}
		$firstDayOfTheYear = new \DateTime($date->format('Y').'-01-01');
		$difference = $firstDayOfTheYear->diff($date);
		$daysDifference = $difference->days + 1;
		$value  = '0';
		$value .= $date->format('y');
		$value .= sprintf('%03d', $daysDifference);
		return $value;
	}

	/**
	 * Set File Processing Centre
	 *
	 * @param $value string
	 * @return $this
	 */
	public function setFileProcessingCentre($value)
	{
		$this->fileProcessingCentre = $value;
		return $this;
	}

	/**
	 * Get File Processing Centre
	 *
	 * @return string
	 */
	public function getFileProcessingCentre()
	{
		return $this->fileProcessingCentre;
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
		// File Creation Number
		$value .= $this->getFileCreationNumber();
		// File Creation Date
		$value .= $this->getFileCreationDate();
		// File Processing Centre
		$value .= $this->getFileProcessingCentre();
		// Fillers
		$value .= $this->fillers($value);
		return $value;
	}
}
