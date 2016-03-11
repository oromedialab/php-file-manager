<?php

/**
 * Utility Functions
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @package Oml\PHPFileManager\Utility
 * @version 0.1
 */
namespace Oml\PHPFileManager\Utility;

class Functions
{
	/**
	 * Force download string
	 * @param  string $text
	 * @param  string $extension
	 * @param  string $fileName
	 * @return void
	 */
	public static function forceDownload($text, $fileName = null, $fileExtension)
	{
		if (null === $fileName) {
			$fileName = self::generateRandomString(10);
		}
		header('Content-Disposition: attachment; filename="'.$fileName.$fileExtension.'"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($text));
		header('Connection: close');
		echo $text;
	}

	/**
	 * Generate random string
	 * @param  integer $length
	 * @return string
	 */
	public static function generateRandomString($length = 10)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
