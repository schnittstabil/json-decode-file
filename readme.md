# jsonDecodeFile [![Build Status](https://travis-ci.org/schnittstabil/json-decode-file.svg?branch=master)](https://travis-ci.org/schnittstabil/json-decode-file) [![Coverage Status](https://coveralls.io/repos/schnittstabil/json-decode-file/badge.svg?branch=master&service=github)](https://coveralls.io/github/schnittstabil/json-decode-file?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/schnittstabil/json-decode-file/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/schnittstabil/json-decode-file/?branch=master) [![Code Climate](https://codeclimate.com/github/schnittstabil/json-decode-file/badges/gpa.svg)](https://codeclimate.com/github/schnittstabil/json-decode-file)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a4e650d4-67a8-4556-a85f-d4f27d323259/big.png)](https://insight.sensiolabs.com/projects/a4e650d4-67a8-4556-a85f-d4f27d323259)

> Read and decode JSON files

[Handles UTF byte order marks (BOM)](https://github.com/duncan3dc/bom-string), uses [kherge/file-manager](https://github.com/kherge-php/file-manager) and [seld/jsonlint](https://github.com/Seldaek/jsonlint) to throw helpful File and JSON Exceptions respectively.

## Install

```
$ composer require schnittstabil/json-decode-file
```

## Usage

```php
use function Schnittstabil\JsonDecodeFile\jsonDecodeFile;

try {
    $json = jsonDecodeFile('composer.json');
} catch (\KHerGe\File\Exception\ResourceException $err) {
    echo $err->getMessage(), PHP_EOL;
} catch (\Seld\JsonLint\ParsingException $err) {
    echo $err->getMessage(), PHP_EOL;
}
```

## Related

- [load-json-file](https://github.com/sindresorhus/load-json-file) – Node.js version and inspiration of this projeject

## License

MIT © [Michael Mayer](http://schnittstabil.de)
