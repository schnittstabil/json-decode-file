<?php

namespace Schnittstabil\JsonDecodeFile;

use KHerGe\File\File;
use KHerGe\File\Exception\ResourceException;
use Seld\JsonLint\JsonParser;
use Seld\JsonLint\ParsingException;
use duncan3dc\Bom\Util as BomUtil;

/**
 * Read and decode JSON files.
 */
class JsonDecodeFile
{
    /**
     * Reads entire file into a string.
     *
     * @param string $path the file path
     *
     * @return string the read data
     *
     * @throws ResourceException
     */
    protected static function readFile($path)
    {
        @$file = new File($path, 'r');

        return $file->read();
    }

    /**
     * Converts JSON encoded string into a PHP variable.
     *
     * @param string $json  JSON string
     * @param bool   $assoc returned objects will be converted into associative arrays
     *
     * @return mixed the value encoded in json in appropriate PHP type
     *
     * @throws ParsingException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    protected static function parse($json, $assoc = false)
    {
        $falgs = JsonParser::DETECT_KEY_CONFLICTS;

        if ($assoc) {
            $falgs |= JsonParser::PARSE_TO_ASSOC;
        }

        $parser = new JsonParser();

        return $parser->parse($json, $falgs);
    }

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
     * @throws ResourceException
     * @throws ParsingException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function call($path, $assoc = false)
    {
        return self::parse(BomUtil::removeBom(self::readFile($path)), $assoc);
    }
}
