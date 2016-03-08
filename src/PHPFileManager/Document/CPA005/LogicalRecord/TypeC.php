<?php

namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

class TypeC extends Base implements LogicalRecordTypeInterface
{
	const LOGICAL_RECORD_ID = 'C';

	protected $segments;

	public function addSegment()
	{
		
	}

	public function getLogicalRecordId()
	{
		return self::LOGICAL_RECORD_ID;
	}

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
		return $value;
	}
}
