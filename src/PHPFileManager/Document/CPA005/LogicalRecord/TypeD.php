<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\LogicalRecord;

use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalRecordTypeInterface;
use Oml\PHPFileManager\Document\CPA005\Interfaces\SegmentInterface;
use Oml\PHPFileManager\Document\CPA005\Interfaces\LogicalSegmentInterface;
use Oml\PHPFileManager\Document\CPA005\Utility\Fillers;

class TypeD extends Base implements LogicalRecordTypeInterface, LogicalSegmentInterface
{
	/**
	 * Logical Record Type ID
	 * [Length=1, Position[start]=1, Position[end]=1, Example:(A, C, D, Z)]
	 *
	 * @var string
	 */
	const LOGICAL_RECORD_ID = 'D';

	/**
	 * Logical Record Segments
	 * @var array
	 */
	protected $segments = array();

	/**
	 * Add segment(s) to logical record
	 * @param SegmentInterface $segment
	 */
	public function addSegment(SegmentInterface $segment)
	{
		if (count($this->getSegments()) > ($this->getSegmentLimit() - 1)) {
			throw new \Exception('Segment limit exceeded. Only 6 segments can be added per instance for logical record type "C"');
		}
		$this->segments[spl_object_hash($segment)] = $segment;
		return $this;
	}

	/**
	 * Get segments
	 * @return array SegmentInterface
	 */
	public function getSegments()
	{
		return $this->segments;
	}

	/**
	 * Dump segments
	 * @return string
	 */
	public function dumpSegments()
	{
		$value = '';
		foreach ($this->getSegments() as $segment) {
			$value .= $segment->dump();
		}
		return $value;
	}

	/**
	 * Dump logical record contents (including segments)
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
		// Dump segments
		$value .= $this->dumpSegments();
		// Fillers
		$value .= Fillers::generate($value);
		return $value;
	}
}
