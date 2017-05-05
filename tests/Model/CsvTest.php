<?php

namespace Test\CsvCreate\Csv\Model;

use Test\CsvCreate\Csv\TestCase;
use CsvCreate\Csv\Model\Csv;

class CsvTest extends TestCase {

	public function testEscape()
	{
		$data = 'Hello" "Thomas", es-tu là?';
		$expected = '"Hello"" ""Thomas"", es-tu là?"';
		$this->assertEquals($expected, Csv::escape($data));
	}

	public function testEscapeNumber()
	{
		$data = '1337';
		$expected = '="1337"';
		$this->assertEquals($expected, Csv::escape($data));
	}

	public function testCreateRow()
	{
		$data = ['John "Doe', 42];
		$expected = '"John ""Doe";="42"' . PHP_EOL;
		$csv = new Csv(';', PHP_EOL);
		$this->assertEquals($expected, $csv->createRow($data));
	}

}
