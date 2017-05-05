<?php

namespace CsvCreate\Csv\Model;

class Bom {

	/**
	 * Get the UTF-16LE byte order mark character. Should be the first character in the file.
	 * @return string
	 */
	public static function utf16Le()
	{
		return chr(255) . chr(254);
	}

}
