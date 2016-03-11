<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;
use Oml\PHPFileManager\Document\CPA005\Utility\Functions;
use Oml\PHPFileManager\Document\CPA005\Utility\Fillers;

class TypeA extends Base implements LogicalRecordTypeInterface
{
	/**
	 * Logical Record Type ID
	 * [Length=1, Position[start]=1, Position[end]=1, Example:(A, C, D, Z)]
	 *
	 * @var string
	 */
	const LOGICAL_RECORD_ID = 'A';

	/**
	 * File Creation Date
	 *    Julian Format - 0yyddd where yy are the last two digits of the yearin the range 001-366
	 *    October 2, 2001 is represented as 001275.
	 *    The file will be rejected if this field is invalid, contains a date in the future, or contains a date more than ten days prior to transmission date
	 * [Length=6, Position[start]=25, Position[end]=30, Example: (001275)]
	 *
	 * @var \DateTime
	 */
	protected $fileCreationDate;

	/**
	 * File Processing Centre (The centre where the file will be processed.)
	 * [Length=5, Position[start]=31, Position[end]=35]
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
	 * Get File Creation Date
	 *
	 * @return string
	 */
	public function getFileCreationDate()
	{
		return Functions::dateTimeToJulianFormat($this->fileCreationDate);
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
		// Originator Account Number
		$value .= $this->getOriginatorAccountNumber();
		// File Creation Number
		$value .= $this->getFileCreationNumber();
		// File Creation Date
		$value .= $this->getFileCreationDate();
		// File Processing Centre
		$value .= $this->getFileProcessingCentre();
		// Fillers
		$value .= Fillers::generate($value);
		return $value;
	}
}
