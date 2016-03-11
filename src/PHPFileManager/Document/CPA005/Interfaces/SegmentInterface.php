<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\Interfaces;

use Oml\PHPFileManager\Document\CPA005\LogicalRecord\Segment;

interface SegmentInterface
{
	/**
	 * Dump segment content
	 * @return string
	 */
	public function dump();
}
