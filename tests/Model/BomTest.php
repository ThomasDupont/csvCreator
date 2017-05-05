<?php

namespace Test\CsvCreate\Csv\Model;

use Test\CsvCreate\Csv\TestCase;
use CsvCreate\Csv\Model\Bom;

class BomTest extends TestCase {

	public function testUtf16Le()
	{
		$bom = Bom::utf16Le();
		$this->assertEquals(2, strlen($bom));
	}

}
