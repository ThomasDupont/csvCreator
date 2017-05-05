<?php

namespace CsvCreate\Csv\Model;

class Csv {

	/**
	 * @var string
	 */
	private $delimiter;

	/**
	 * @var string
	 */
	private $newLine;

	/**
	 * @param string $delimiter
	 * @param string $newLine
	 */
	public function __construct($delimiter, $newLine)
	{
		$this->delimiter = $delimiter;
		$this->newLine 	 = $newLine;
	}

	/**
	 * Escape double quotes in data about to be inserted
	 * @param string $data
	 * @return string
	 */
	public static function escape($data)
	{
		$escaped = is_numeric($data) ? '=' : '';
		$escaped .= '"' . str_replace(['"'], ['""'], $data) . '"';
		return $escaped;
	}

	/**
	 * Convert an array of strings to a CSV row
	 * @param array<string> $row
	 * @return string
	 */
	public function createRow(array $row)
	{
		$data = '';

		foreach ($row as $attribute) {
			$attribute = trim($attribute);

			if (strlen($attribute) > 0) {
				$data .= self::escape($attribute);
			}

			$data .= $this->delimiter;
		}

		return rtrim($data, $this->delimiter) . $this->newLine;
	}

}
