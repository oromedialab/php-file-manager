<?php
/**
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Document\CPA005
 * @version 0.1
 */
namespace Oml\PHPFileManager\Document\CPA005\Utility;

class Fillers
{
	/**
	 * Default filler length
	 *
	 * @var integer
	 */
	const DEFAULT_LENGTH = 1464;

	/**
	 * Filler Value (Space)
	 *
	 * @var string
	 */
	const SPACE_FILLER = ' ';

	/**
	 * Filler Value (Zero)
	 *
	 * @var string
	 */
	const ZERO_FILLER = '0';

	/**
	 * Generate Fillers
	 * @param  string $record
	 * @param  int    $length
	 * @param  string $filler
	 * @return string
	 */
	public static function generate($record, $length = null, $filler = self::SPACE_FILLER)
	{
		$multiplier = null !== $record && null === $length ? self::DEFAULT_LENGTH - strlen($record) : $length;
		$multiplier = (int)$multiplier;
		return str_repeat($filler, $multiplier);
	}

	/**
	 * Truncate or fill given text
	 * @param  string $text      Text to truncate
	 * @param  int    $maxLength Maximum length
	 * @param  string $filler    Filler character (Zero or space)
	 * @return text              Return truncated or filled text
	 */
	public static function truncateOrFill($text, $maxLength, $filler = self::SPACE_FILLER)
	{
		$text = (string)$text;
		$maxLength = (int)$maxLength;
		$textLength = strlen($text);
		// Truncate
		if ($textLength > $maxLength) {
			return mb_substr($text, 0, $maxLength);
		}
		// Add fillers
		return $text.self::generate(null, $maxLength - $textLength, $filler);
	}
}
