<?php

namespace Schnittstabil\JsonDecodeFile;

require __DIR__.'/../vendor/autoload.php';

/*
 * PHPUnit 5/6
 */
if (!class_exists(\PHPUnit\Framework\TestCase::class)) {
    class_alias(\PHPUnit_Framework_TestCase::class, \PHPUnit\Framework\TestCase::class);
}

/*
 * schnittstabil/sugared-phpunit may depend on schnittstabil/jsonDecodeFile which already loaded `src/functions.php`,
 * thus we need to remove all already defined functions and reload `src/functions.php` to gather the correct code
 * coverage informations.
 */
if (function_exists('runkit_function_remove')) {
    if (function_exists('Schnittstabil\JsonDecodeFile\jsonDecodeFile')) {
        runkit_function_remove('Schnittstabil\JsonDecodeFile\jsonDecodeFile');
    }

    require __DIR__.'/../src/functions.php';
}
