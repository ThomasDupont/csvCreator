<?php

namespace CsvCreate\Csv\Model;

use CsvCreate\Csv\Writer;

class Headers {

	/**
	 * Send response headers to download a CSV file
	 * @param type $filename
	 */
	public static function download($filename)
	{
		header('Content-Type: text/csv; charset=' . Writer::CHARSET);
		header("Content-Disposition: attachment; filename=\"$filename\"");
	}

}
