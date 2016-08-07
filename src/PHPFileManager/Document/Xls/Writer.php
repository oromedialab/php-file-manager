<?php
/**
 * Xls Writer
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\Xls
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\Xls;

use PHPExcel;
use PHPExcel_IOFactory;
use Oml\PHPFileManager\Utility\Functions;

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
	 * Text alignment
	 * 
	 * @var array
	 */
	protected static $alignment = array(
		'HORIZONTAL_CENTER' => array(
			'alignment' => array(
		        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		    )
		),
		'HORIZONTAL_LEFT' => array(
			'alignment' => array(
		        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		    )
		),
		'HORIZONTAL_RIGHT' => array(
			'alignment' => array(
		        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
		    )
		)
	);

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
	 * Style excel rows
	 *
	 * @param $styles array
	 */
	protected $styles = array(
		'width' => null
	);

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
	 * Add width
	 * 
	 * @param string $cell
	 * @param string $value
	 */
	public function setWidthForColumn($cell, $value)
	{
		$this->styles['width'][$cell] = $value;
		return $this;
	}

	/**
	 * Set background color for column rage
	 *
	 * @param string $columnRange
	 * @param string $colorHex
	 */
	public function setBackgroundColorForColumnRange($columnRange, $colorHex)
	{
		$this->styles['background_color'][$columnRange] = $colorHex;
		return $this;
	}

	/**
	 * Set font color for column rage
	 *
	 * @param string $columnRange
	 * @param string $colorHex
	 */
	public function setFontColorForColumnRange($columnRange, $colorHex)
	{
		$this->styles['font_color'][$columnRange] = $colorHex;
		return $this;
	}

	/**
	 * Align text for column range
	 *
	 * @param string $columnRange
	 * @param string $alignment
	 */
	public function alignTextForColumnRange($columnRange, $alignment)
	{
		$this->styles['align'][$columnRange] = $alignment;
		return $this;
	}

	/**
	 * Download Xls File
	 */
	public function download()
	{
		$doc = new PHPExcel;
		$doc->setActiveSheetIndex(0);
		// Width
		if (array_key_exists('width', $this->styles) && !empty($this->styles['width']) && is_array($this->styles['width'])) {
			foreach ($this->styles['width'] as $widthColumn => $widthValue) {
				$doc->getActiveSheet()->getColumnDimension($widthColumn)->setAutoSize(false)->setWidth($widthValue);
			}
		}
		// Background color
		if (array_key_exists('background_color', $this->styles) && !empty($this->styles['background_color']) && is_array($this->styles['background_color'])) {
			foreach ($this->styles['background_color'] as $columnRange => $colorHex) {
				$doc->getActiveSheet()->getStyle($columnRange)->applyFromArray(array(
			        'fill' => array(
			            'type' => \PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => $colorHex)
			        )
			    ));
			}
		}
		// Font color
		if (array_key_exists('font_color', $this->styles) && !empty($this->styles['font_color']) && is_array($this->styles['font_color'])) {
			foreach ($this->styles['font_color'] as $columnRange => $colorHex) {
				$doc->getActiveSheet()->getStyle($columnRange)->applyFromArray(array(
			        'font'  => array(
				        'color' => array('rgb' => $colorHex)
				    )
			    ));
			}
		}
		// Alignment
		if (array_key_exists('align', $this->styles) && !empty($this->styles['align']) && is_array($this->styles['align'])) {
			foreach ($this->styles['align'] as $columnRange => $alignment) {
				$doc->getActiveSheet()->getStyle($columnRange)->applyFromArray(self::$alignment[$alignment]);
			}
		}
		// Alignment
		$index = 1;
		foreach ($this->getRows() as $row) {
			$doc->getActiveSheet()->fromArray(array($row), null, 'A'.$index);
			$index++;
		}
		$fileName = !empty($this->getFileName()) ? $this->getFileName() : Functions::generateRandomString(10);
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
	 * Set File Name
	 *
	 * @param string $fileName
	 * @return $this
	 */
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
		return $this;
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
}
