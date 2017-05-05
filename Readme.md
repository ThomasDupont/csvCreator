# CsvCreate

A little library used to simply create CSV.

This project does not bother with a complete solution, I'm sure there are tons of fancy
features missing. However, it is a bare minimum of what is needed to create a CSV file using
the *UTF-16LE* encoding and possibly enough for most use cases. These CSV files should
work on all platforms and software.

## Usage

The two examples below demonstrates pretty much every function and functionality
or this library. It's that simple!

### Example 1

If you'd like to offer a CSV for download:

```php
use CsvCreate\Csv\Writer;
use CsvCreate\Csv\Model\Headers;

$csv = [
	['Name', 'Age'],
	['John Doe', '42'],
];

// Must be first, will send appropriate headers to download
// the CSV file
Headers::download('persons.csv');

$file = new SplFileObject('php://output');
$writer = new Writer($file);

$writer->addAllRows($csv);

$writer->save();
```

### Example 2

Save to a file:

```php
use CsvCreate\Csv\Writer;

$csv = [
	['Name', 'Age'],
	['John Doe', '42'],
];

$writer = Writer::fromPath('/path/to/a/file');

foreach($csv as $row) {
	$writer->addRow($row);
}

$writer->save();
```
