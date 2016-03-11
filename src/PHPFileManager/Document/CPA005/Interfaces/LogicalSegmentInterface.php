<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\Interfaces;

interface LogicalSegmentInterface
{
	/**
	 * Add segment to logical record type
	 * @param SegmentInterface $segment
	 */
	public function addSegment(SegmentInterface $segment);

	/**
	 * Get segments
	 * @return array (SegmentInterface)
	 */
	public function getSegments();

	/**
	 * Dump segments
	 * @return string
	 */
	public function dumpSegments();
}
