<?php
/**
 * Xls Writer
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\FileManager\Xls
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\Xls;

use PHPExcel;
use PHPExcel_IOFactory;

use Zend\Math\Rand;

class Writer
{
	/**
	 * File extension (used while download)
	 *
	 * @var string
	 */
	const FILE_EXTENSION = 'xls';

	/**
	 * File content type (used while download)
	 *
	 * @var string
	 */
	const CONTENT_TYPE = 'application/vnd.ms-excel';

	/**
	 * File name
	 *
	 * @param string
	 */
	protected $fileName;

	/**
	 * Excel rows for writing
	 * 
	 * @param $rows array
	 */
	protected $rows = array();

	/**
	 * Add rows to excel file for writing
	 *
	 * @param $row array
	 * @return $this
	 */
	public function addRows(array $rows)
	{
		$this->rows[] = $rows;
		return $this;
	}

	/**
	 * Download Xls File
	 */
	public function download()
	{
		$doc = new PHPExcel;
		$doc->setActiveSheetIndex(0);
		$index = 1;
		foreach ($this->getRows() as $row) {
			$doc->getActiveSheet()->fromArray(array($row), null, 'A'.$index);
			$index++;
		}
		$fileName = !empty($this->getFileName()) ? $this->getFileName() : $this->generateRandomString(8);
		$file = $fileName.'.'.$this->getFileExtension();
		$writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
		header('Content-type: '.$this->getContentType());
		header('Content-Disposition: attachment; filename="'.$file.'"');
		return $writer->save('php://output');
	}

	/**
	 * Get Content Type
	 *
	 * @return string
	 */
	protected function getContentType()
	{
		return self::CONTENT_TYPE;
	}

	/**
	 * Get file extension
	 *
	 * @return string
	 */
	protected function getFileExtension()
	{
		return self::FILE_EXTENSION;
	}

	/**
	 * Get rows to add in excel
	 *
	 * @return array
	 */
	protected function getRows()
	{
		return $this->rows;
	}

	/**
	 * Get File Name
	 *
	 * @return string
	 */
	protected function getFileName()
	{
		return $this->fileName;
	}

	/**
	 * Generate random string from a given length
	 */
	protected function generateRandomString($length)
	{
		$length = (int)$length;
		return Rand::getString($length, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', true);
	}
}
