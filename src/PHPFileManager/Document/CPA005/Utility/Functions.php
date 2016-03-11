<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\Utility;

use DateTime;

class Functions
{
	/**
	 * Format Amount
	 *
	 * @param decimal|intger|float $amount
	 * @param integer $precision
	 * @param integer $scale
	 * @return string
	 */
	public static function formatAmount($amount, $precision = 8, $scale = 2)
	{
		$amount = explode('.', number_format((float)$amount, $scale, '.', ''));
		if (strlen($amount[0]) > $precision) {
			throw new \Exception('Amount must be in format '.str_repeat('$', $precision).str_repeat('¢', $scale).'with the precision value of '.$precision.', '.$scale);
		}
		$value  = sprintf('%0'.$precision.'d', $amount[0]);
		$value .= sprintf('%0'.$scale.'d', $amount[1]);
		return $value;
	}

	/**
	 * Convert into julian date format (0yyddd)
	 *
	 * @param DateTime $date
	 * @return string
	 */
	public static function dateTimeToJulianFormat(DateTime $date)
	{
		$firstDayOfTheYear = new \DateTime($date->format('Y').'-01-01');
		$difference = $firstDayOfTheYear->diff($date);
		$daysDifference = $difference->days + 1;
		$value  = '0';
		$value .= $date->format('y');
		$value .= sprintf('%03d', $daysDifference);
		return $value;
	}
}
