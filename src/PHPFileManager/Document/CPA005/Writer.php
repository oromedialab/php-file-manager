<?php

namespace Oml\PHPFileManager\Document\CPA005;

use Oml\PHPFileManager\Document\CPA005\Interfaces\FileWriterInterface;

class Writer
{
	protected $file;

	public function setFile(FileWriterInterface $file)
	{
		$this->file = $file;
		return $this;
	}

	public function download()
	{
		
	}

	public function dump()
	{
		return $this->file->dump();
	}
}
