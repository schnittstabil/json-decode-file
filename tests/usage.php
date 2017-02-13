#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use function Schnittstabil\JsonDecodeFile\jsonDecodeFile;

try {
    $json = jsonDecodeFile('composer.json');
} catch (\KHerGe\File\Exception\ResourceException $err) {
    echo $err->getMessage(), PHP_EOL;
} catch (\Seld\JsonLint\ParsingException $err) {
    echo $err->getMessage(), PHP_EOL;
}
