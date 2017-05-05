<?php

namespace CsvCreate\Csv;

use CsvCreate\Csv\Model\Bom;
use CsvCreate\Csv\Model\Csv;

class Writer {

	const DELIMITER = "\t";
	const NEW_LINE = PHP_EOL;
	const CHARSET = 'UTF-16LE';

	/**
	 * @var SplFileObject
	 */
	private $file;

	/**
	 * @var mixed
	 */
	private $fromEncoding;

	/**
	 * @var Csv
	 */
	private $csv;

	/**
	 * @param SplFileObject $file
	 * @param mixed $fromEncoding
	 */
	public function __construct(\SplFileObject $file, $fromEncoding = null)
	{
		$this->file = $file;

		// See mb_convert_encoding() for possible values to this variable
		$this->fromEncoding = (is_null($fromEncoding)) ? mb_internal_encoding()
			: $fromEncoding;

		$this->csv = new Csv(self::DELIMITER, self::NEW_LINE);

		$this->reset();
	}

	public function __destruct()
	{
		$this->file->fflush();
		$this->file = null;
	}

	/**
	 * Create a new writer given a path to a file
	 * @param string $path
	 * @return \self
	 */
	public static function fromPath($path)
	{
		return new self(new \SplFileObject($path, 'w'));
	}

	/**
	 * Reset and initialize the file stream
	 * @return void
	 */
	private final function reset() {
		$this->file->fwrite(Bom::utf16Le());
	}

	/**
	 * Insert a row into the file
	 * @param array<string> $row
	 * @param mixed $fromEncoding
	 * @return void
	 */
	public function addRow(array $row) {
		$data = $this->csv->createRow($row);
		$dataUtf16 = mb_convert_encoding($data, self::CHARSET, $this->fromEncoding);
		$this->file->fwrite($dataUtf16);
	}

	/**
	 * Shortcut for batch inserting rows using $this->insert() method
	 * @param array<array<string>> $rows
	 * @param mixed $fromEncoding
	 * @return void
	 */
	public function addAllRows(array $rows) {
		foreach ($rows as $row) {
			$this->addRow($row);
		}
	}

	/**
	 * Flush and make sure the contents of the file is saved.
	 * @return void
	 */
	public function save() {
		$this->file->fflush();
	}

}
