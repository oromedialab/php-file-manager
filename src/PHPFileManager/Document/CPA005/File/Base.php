<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\File;

use Oml\PHPFileManager\Document\CPA005\Interfaces\FileWriterInterface;
use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

class Base implements FileWriterInterface
{
	/**
	 * Logical Record A
	 * @var array
	 */
	protected $logicalRecordA = array();

	/**
	 * Logical Record Z
	 * @var array
	 */
	protected $logicalRecordZ = array();

	/**
	 * Logical Records (C, D)
	 * @var array
	 */
	protected $logicalRecords = array();

	/**
	 * File Name
	 * @var string
	 */
	protected $fileName;

	/**
	 * Get File Extension
	 * @return string
	 */
	public function getFileExtension()
	{
		return static::FILE_EXTENSION;
	}

	/**
	 * Add Logical Record
	 * @param LogicalRecordTypeInterface $logicalRecord
	 * @param string                     $type         
	 */
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

	/**
	 * Set File Name
	 * @param string $fileName
	 */
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
		return $this;
	}

	/**
	 * Get File Name
	 * @return string
	 */
	public function getFileName()
	{
		return $this->fileName;
	}

	/**
	 * Get Logical Record A
	 * @return LogicalRecord\TypeA
	 */
	protected function getLogicalRecordA()
	{
		return $this->logicalRecordA;
	}

	/**
	 * Get Logical Record Z
	 * @return LogicalRecord\TypeZ
	 */
	protected function getLogicalRecordZ()
	{
		return $this->logicalRecordZ;
	}

	/**
	 * Get Logical Records
	 * @return array LogicalReord
	 */
	protected function getLogicalRecords()
	{
		return $this->getLogicalRecords;
	}

	/**
	 * Dump Logical Records
	 * @return string
	 */
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
}
