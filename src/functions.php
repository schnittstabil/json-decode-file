<?php

namespace Schnittstabil\JsonDecodeFile;

use KHerGe\File\Exception\FileException;
use Seld\JsonLint\ParsingException;

if (!function_exists('Schnittstabil\JsonDecodeFile\jsonDecodeFile')) {
    /**
     * Read and decode a JSON file.
     *
     * @see http://php.net/manual/en/function.json-decode.php json_decode documentation
     *
     * @param string $path  the file path
     * @param bool   $assoc returned objects will be converted into associative arrays
     *
     * @return mixed the value encoded in json in appropriate PHP type
     *
     * @throws FileException
     * @throws ParsingException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    function jsonDecodeFile($path, $assoc = false)
    {
        return JsonDecodeFile::call($path, $assoc);
    }
}
