<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005;

use Oml\PHPFileManager\Document\CPA005\Interfaces\FileWriterInterface;
use Oml\PHPFileManager\Utility\Functions;

class Writer
{
	/**
	 * File type
	 * @var FileWriterInterface
	 */
	protected $file;

	/**
	 * Set File
	 * @param FileWriterInterface $file
	 */
	public function setFile(FileWriterInterface $file)
	{
		$this->file = $file;
		return $this;
	}

	/**
	 * Download file
	 * @return void
	 */
	public function download()
	{
		Functions::forceDownload($this->file->dump(), $this->file->getFileName(), $this->file->getFileExtension());
	}

	/**
	 * Dump file content
	 * @return string
	 */
	public function dump()
	{
		return $this->file->dump();
	}
}
