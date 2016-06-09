<?php
/**
 * Xls Reader
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\Xls
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\Xls;

use PHPExcel;
use PHPExcel_IOFactory;
use Oml\PHPFileManager\Utility\Functions;

class Reader
{
	/**
	 * File with absolute path
	 * 
	 * @var string
	 */
	protected $file;

	/**
	 * Replace column with indexes
	 * 
	 * @var array
	 */
	protected $replaceColumnWithIndexes = array();

	/**
	 * Remove column with indexes
	 * 
	 * @var array
	 */
	protected $removeColumnWithIndexes = array();

	/**
	 * Init with absolute file path
	 *
	 * @param string $file
	 */
	public function __construct($file)
	{
		if (is_dir($file)) {
			throw new \Exception('"'.$file.'" is a directory, file expected.');
		}
		if (!file_exists($file)) {
			throw new \Exception('File "'.$file.'" does not exist at given path');
		}
		$this->file = $file;
	}

	/**
	 * Replace column key on index with given value
	 *
	 * @param  string $index
	 * @param  string $value
	 * @return $this
	 */
	public function replaceColumnWithIndex($index, $value)
	{
		$this->replaceColumnWithIndexes[$index] = $value;
		return $this;
	}

	/**
	 * Remove column with indexes
	 * 
	 * @param  array  $indexes
	 * @return $this
	 */
	public function removeColumnWithIndexes(array $indexes)
	{
		$this->removeColumnWithIndexes = $indexes;
		return $this;
	}

	/**
	 * Dump content to array
	 * 
	 * @param integer $startRow
	 * @return array
	 */
	public function toArray($startRow = 5)
	{
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($this->file);
		    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
		    $objPHPExcel = $objReader->load($this->file);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($this->file,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
		$result = array();
		for ($row = $startRow; $row <= $highestRow; $row++) {
			$rowContent = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
			if (!empty($rowContent) && is_array($rowContent) && array_key_exists('0', $rowContent)) {
				$result[] = $rowContent[0];
			}
		}
		// Replace indexes if available
		foreach ($result as $rowIndex => $row) {
			foreach ($this->replaceColumnWithIndexes as $k => $v) {
				if (array_key_exists($k, $row)) {
					$result[$rowIndex][$v] = $result[$rowIndex][$k];
					unset($result[$rowIndex][$k]);
				}
			}
			// Remove column with defined indexes
			foreach ($this->removeColumnWithIndexes as $columnIndex) {
				unset($result[$rowIndex][$columnIndex]);
			}
		}
		return $result;
	}
}
