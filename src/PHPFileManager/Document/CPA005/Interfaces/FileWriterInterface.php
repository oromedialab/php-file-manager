<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\Interfaces;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;

interface FileWriterInterface
{
	/**
	 * Set File Name
	 * @param string $fileName
	 */
	public function setFileName($fileName);

	/**
	 * Get File Name
	 * @return string
	 */
	public function getFileName();

	/**
	 * Set File Extension
	 * @return string
	 */
	public function getFileExtension();	

	/**
	 * Add Logical Record
	 * @param LogicalRecordTypeInterface $logicalRecord
	 */
	public function addLogicalRecord(LogicalRecordTypeInterface $logicalRecord);

	/**
	 * Dump logical record content
	 * @return string
	 */
	public function dump();
}
