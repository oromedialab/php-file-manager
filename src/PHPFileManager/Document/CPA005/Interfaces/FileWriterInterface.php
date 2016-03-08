<?php

namespace Oml\PHPFileManager\Document\CPA005\Interfaces;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

interface FileWriterInterface
{
	public function getFileExtension();	

	public function addLogicalRecord(LogicalRecordTypeInterface $logicalRecord);

	public function dump();
}
