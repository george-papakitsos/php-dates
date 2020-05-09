<?php

namespace GPapakitsos\PHPdates\Tests;

use PHPUnit\Framework\TestCase;
use GPapakitsos\PHPdates\Dates;

class Test extends TestCase
{
	const GREEK_DATE_FORMAT = '23/04/1981';
	const ISO_DATE_FORMAT = '1981-04-23';
	const GREEK_DATETIME_FORMAT = '23/04/1981 07:10:23';
	const GREEK_DATETIME_NO_SECONDS_FORMAT = '23/04/1981 07:10';
	const ISO_DATETIME_FORMAT = '1981-04-23 07:10:23';

	public function testDateToGreek()
	{
		$this->assertEquals(self::GREEK_DATE_FORMAT, Dates::dateToGreek(self::ISO_DATE_FORMAT));
		$this->assertEquals(self::GREEK_DATE_FORMAT, Dates::dateToGreek(self::ISO_DATETIME_FORMAT));
	}

	public function testDatetimeToGreek()
	{
		$this->assertEquals(self::GREEK_DATETIME_FORMAT, Dates::datetimeToGreek(self::ISO_DATETIME_FORMAT));
		$this->assertEquals(self::GREEK_DATETIME_NO_SECONDS_FORMAT, Dates::datetimeToGreek(self::ISO_DATETIME_FORMAT, false));
	}

	public function testDateToISO()
	{
		$this->assertEquals(self::ISO_DATE_FORMAT, Dates::dateToISO(self::GREEK_DATE_FORMAT));
	}

	public function testDatetimeToISO()
	{
		$this->assertEquals(self::ISO_DATETIME_FORMAT, Dates::datetimeToISO(self::GREEK_DATETIME_FORMAT));
	}

	public function testHasCorrectFormat()
	{
		$this->assertTrue(Dates::hasCorrectFormat(self::GREEK_DATE_FORMAT, Dates::GREEK_DATE_FORMAT));
		$this->assertTrue(Dates::hasCorrectFormat(self::ISO_DATE_FORMAT, Dates::ISO_DATE_FORMAT));
		$this->assertTrue(Dates::hasCorrectFormat(self::GREEK_DATETIME_FORMAT, Dates::GREEK_DATETIME_FORMAT));
		$this->assertTrue(Dates::hasCorrectFormat(self::ISO_DATETIME_FORMAT, Dates::ISO_DATETIME_FORMAT));
	}
}
