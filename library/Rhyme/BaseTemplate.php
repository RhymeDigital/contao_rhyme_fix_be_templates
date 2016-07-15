<?php

/**
 * Copyright (C) 2016 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @author		Cassondra Hayden <cassie@rhyme.digital>
 * @author		Melissa Frechette <melissa@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Rhyme;

use Replaced\BaseTemplate as ReplacedBackendTemplate;


class BaseTemplate extends ReplacedBackendTemplate
{
	
	/**
	 * Parse the template file and return it as string
	 * Updated to remove the HTML comments in BE mode
	 *
	 * @return string The template markup
	 */
	public function parse()
	{
		$strBuffer = parent::parse();
		
		if (TL_MODE === 'BE')
		{
			$strBuffer = static::replaceSectionsOfString($strBuffer, "\n<!-- TEMPLATE START: ", "-->");
			$strBuffer = static::replaceSectionsOfString($strBuffer, "\n<!-- TEMPLATE END: ", "-->");
		}

		return $strBuffer;
	}

	
	/**
	 * Remove sections of a string using a start and end (use "[caption" and "]" to remove any caption blocks)
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return string
	 */
	public static function replaceSectionsOfString($strSubject, $strStart, $strEnd, $strReplace='', $blnCaseSensitive=true, $blnRecursive=true)
	{
		// First index of start string
		$varStart = $blnCaseSensitive ? strpos($strSubject, $strStart) : stripos($strSubject, $strStart);
		
		if ($varStart === false)
			return $strSubject;
		
		// First index of end string
		$varEnd = $blnCaseSensitive ? strpos($strSubject, $strEnd, $varStart+1) : stripos($strSubject, $strEnd, $varStart+1);
		
		// The string including the start string, end string, and everything in between
		$strFound = $varEnd === false ? substr($strSubject, $varStart) : substr($strSubject, $varStart, ($varEnd + strlen($strEnd) - $varStart));
		
		// The string after the replacement has been made
		$strResult = $blnCaseSensitive ? str_replace($strFound, $strReplace, $strSubject) : str_ireplace($strFound, $strReplace, $strSubject);
		
		// Check for another occurence of the start string
		$varStart = $blnCaseSensitive ? strpos($strSubject, $strStart) : stripos($strSubject, $strStart);
		
		// If this is recursive and there's another occurence of the start string, keep going
		if ($blnRecursive && $varStart !== false)
		{
			$strResult = static::replaceSectionsofString($strResult, $strStart, $strEnd, $strReplace, $blnCaseSensitive, $blnRecursive);
		}
		
		return $strResult;
	}
}