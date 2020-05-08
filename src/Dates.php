<?php namespace GPapakitsos\PHPdates;

/**
 * Some helper methods for nesbot/carbon
 *
 * @author George Papakitsos <papakitsos_george@yahoo.gr>
 * @copyright 2015 George Papakitsos
 */

use Carbon\Carbon;

class Dates {

	const GREEK_DATE_FORMAT = 'd/m/Y';
	const ISO_DATE_FORMAT = 'Y-m-d';
	const GREEK_DATETIME_FORMAT = 'd/m/Y H:i:s';
	const ISO_DATETIME_FORMAT = 'Y-m-d H:i:s';


	/**
	 * Coverts date from ISO format to Greek format
	 *
	 * @param string $date (YYYY-MM-DD)
	 *
	 * @return string (DD/MM/YYYY)
	 */
	public static function dateToGreek($date)
	{
		$pos = strpos($date, ' ');
		if ($pos !== false) $date = substr($date, 0, $pos);

		$carbonDate = Carbon::createFromFormat(self::ISO_DATE_FORMAT, $date);

		return $carbonDate->format(self::GREEK_DATE_FORMAT);
	}


	/**
	 * Coverts datetime from ISO format to Greek format
	 *
	 * @param string $datetime (YYYY-MM-DD HH:MM:SS)
	 * @param bool $showSeconds Whether to seconds or not
	 *
	 * @return string (DD/MM/YYYY HH:MM:SS)
	 */
	public static function datetimeToGreek($datetime, $showSeconds = true)
	{
		$pieces = explode(' ', $datetime);
		$time = $pieces[1];
		if ($showSeconds == false && substr_count($time, ':') == 2) $time = substr($time, 0, -3);

		return self::dateToGreek($pieces[0]).' '.$time;
	}


	/**
	 * Coverts date from Greek format to ISO format
	 *
	 * @param string $date (DD/MM/YYYY)
	 *
	 * @return string (YYYY-MM-DD)
	 */
	public static function dateToISO($date)
	{
		$carbonDate = Carbon::createFromFormat(self::GREEK_DATE_FORMAT, $date);

		return $carbonDate->format(self::ISO_DATE_FORMAT);
	}


	/**
	 * Coverts datetime from Greek format to ISO format
	 *
	 * @param string $datetime (DD/MM/YYYY HH:MM:SS)
	 *
	 * @return string (YYYY-MM-DD HH:MM:SS)
	 */
	public static function datetimeToISO($datetime)
	{
		$pieces = explode(' ', $datetime);

		return self::dateToISO($pieces[0]).' '.$pieces[1];
	}


	/**
	 * Checks if given date string has valid format
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return bool
	 */
	public static function hasCorrectFormat($date, $format)
	{
		$d = \DateTime::createFromFormat($format, $date);

		return $d && $d->format($format) === $date;
	}

}
