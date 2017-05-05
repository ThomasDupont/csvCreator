<?php

namespace Test\CsvCreate\Csv;

use CsvCreate\Csv\Writer;

class WriterText extends TestCase {

	private $file;

	public function setUp()
	{
		parent::setUp();
		$temp = tempnam(sys_get_temp_dir(), 'gourmetli_csv');
		$this->file = new \SplFileObject($temp, 'w');
	}

	private function providerCsv()
	{
		static $csv = [
		    ['Name', 'Age'],
		    ['John Doe', '42'],
		];

		return $csv;
	}

	public function testFromPath()
	{
		$file = Writer::fromPath('php://temp');
		$this->assertInstanceOf(Writer::class, $file);
	}

	public function testAddRow()
	{
		$writer = new Writer($this->file);

		foreach ($this->providerCsv() as $row){
			$writer->addRow($row);
		}
		$writer->save();

		$this->assertFileExists($this->file->getPathname());
	}

	public function testAddAllRows()
	{
		$writer = new Writer($this->file);

		$writer->addAllRows($this->providerCsv());
		$writer->save();

		$this->assertFileExists($this->file->getPathname());
	}

}
