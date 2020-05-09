<?php

/**
 * Some helper methods for nesbot/carbon
 *
 * @author George Papakitsos <papakitsos_george@yahoo.gr>
 * @copyright George Papakitsos
 */

namespace GPapakitsos\PHPdates;

use Carbon\Carbon;
use Exception;
use DateTime;

class Dates {

	const GREEK_DATE_FORMAT = 'd/m/Y';
	const ISO_DATE_FORMAT = 'Y-m-d';
	const GREEK_DATETIME_FORMAT = 'd/m/Y H:i:s';
	const ISO_DATETIME_FORMAT = 'Y-m-d H:i:s';
	private const WRONG_FORMAT = 'The provided value has wrong format, please use "%s" format';

	/**
	 * Converts the provided date/datetime from ISO format to Greek format
	 *
	 * @param string $date (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS)
	 *
	 * @throws Exception
	 * @return string (DD/MM/YYYY)
	 */
	public static function dateToGreek($date)
	{
		if (($pos = strpos($date, ' ')) !== false) $date = substr($date, 0, $pos);
		if (self::hasCorrectFormat($date, self::ISO_DATE_FORMAT) === false) throw new Exception(sprintf(self::WRONG_FORMAT, self::ISO_DATE_FORMAT));

		return Carbon::createFromFormat(self::ISO_DATE_FORMAT, $date)->format(self::GREEK_DATE_FORMAT);
	}

	/**
	 * Converts the provided datetime from ISO format to Greek format
	 *
	 * @param string $datetime (YYYY-MM-DD HH:MM:SS)
	 * @param bool $withSeconds Whether to return seconds or not
	 *
	 * @throws Exception
	 * @return string (DD/MM/YYYY HH:MM:SS)
	 */
	public static function datetimeToGreek($datetime, $withSeconds = true)
	{
		if (self::hasCorrectFormat($datetime, self::ISO_DATETIME_FORMAT) === false) throw new Exception(sprintf(self::WRONG_FORMAT, self::ISO_DATETIME_FORMAT));

		return Carbon::createFromFormat(self::ISO_DATETIME_FORMAT, $datetime)->format(($withSeconds) ? self::GREEK_DATETIME_FORMAT : substr(self::GREEK_DATETIME_FORMAT, 0, -2));
	}

	/**
	 * Converts the provided date from Greek format to ISO format
	 *
	 * @param string $date (DD/MM/YYYY)
	 *
	 * @throws Exception
	 * @return string (YYYY-MM-DD)
	 */
	public static function dateToISO($date)
	{
		if (self::hasCorrectFormat($date, self::GREEK_DATE_FORMAT) === false) throw new Exception(sprintf(self::WRONG_FORMAT, self::GREEK_DATE_FORMAT));

		return Carbon::createFromFormat(self::GREEK_DATE_FORMAT, $date)->format(self::ISO_DATE_FORMAT);
	}

	/**
	 * Converts the provided datetime from Greek format to ISO format
	 *
	 * @param string $datetime (DD/MM/YYYY HH:MM:SS)
	 *
	 * @throws Exception
	 * @return string (YYYY-MM-DD HH:MM:SS)
	 */
	public static function datetimeToISO($datetime)
	{
		if (self::hasCorrectFormat($datetime, self::GREEK_DATETIME_FORMAT) === false) throw new Exception(sprintf(self::WRONG_FORMAT, self::GREEK_DATETIME_FORMAT));

		return Carbon::createFromFormat(self::GREEK_DATETIME_FORMAT, $datetime)->format(self::ISO_DATETIME_FORMAT);
	}

	/**
	 * Checks if provided date/datetime has correct format
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return bool
	 */
	public static function hasCorrectFormat($date, $format)
	{
		$d = DateTime::createFromFormat($format, $date);

		return $d && $d->format($format) === $date;
	}

}
