<?php

namespace Oml\PHPFileManager\Document\CPA005\File;

use Oml\PHPFileManager\Document\CPA005\Interfaces\FileWriterInterface;
use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

class Base implements FileWriterInterface
{
	protected $logicalRecordA = array();

	protected $logicalRecordZ = array();

	protected $logicalRecords = array();

	public function addLogicalRecord(LogicalRecordTypeInterface $logicalRecord, $type = null)
	{
		if ('A' == $type) {
			$this->logicalRecordA = $logicalRecord;
			return $this;
		}
		if ('Z' == $type) {
			$this->logicalRecordZ = $logicalRecord;
			return $this;
		}
		$this->logicalRecords[] = $logicalRecord;
		return $this;
	}

	protected function getLogicalRecordA()
	{
		return $this->logicalRecordA;
	}

	protected function getLogicalRecordZ()
	{
		return $this->logicalRecordZ;
	}

	protected function getLogicalRecords()
	{
		return $this->getLogicalRecords;
	}

	public function dump()
	{
		if (empty($this->getLogicalRecordA())) {
			throw new \Exception('Logical record type A is missing or unavailable');
		}
		if (empty($this->getLogicalRecordZ())) {
			throw new \Exception('Logical record type Z is missing or unavailable');
		}
		$values = $this->getLogicalRecordA()->dump().PHP_EOL;
		foreach ($this->logicalRecords as $logicalRecord) {
			$values .= $logicalRecord->dump().PHP_EOL;
		}
		$values .= $this->getLogicalRecordZ()->dump().PHP_EOL;
		return $values;
	}

	public function getFileExtension()
	{
		return static::FILE_EXTENSION;
	}
}
