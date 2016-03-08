<?php

namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

class TypeD extends Base implements LogicalRecordTypeInterface
{
	const LOGICAL_RECORD_ID = 'D';

	public function getLogicalRecordId()
	{
		return self::LOGICAL_RECORD_ID;
	}
}
