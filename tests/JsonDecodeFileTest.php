<?php

namespace Schnittstabil\JsonDecodeFile;

use KHerGe\File\Exception\FileException;
use Seld\JsonLint\ParsingException;
use VladaHejda\AssertException;

/**
 * schnittstabil/sugared-phpunit may depend on Schnittstabil/JsonDecodeFile,
 * thus we need to run tests in seperate processes with new global state
 * to gather code coverage informations of this library, and not the (global)
 * schnittstabil/sugared-phpunit one.
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class JsonDecodeFileTest extends \PHPUnit_Framework_TestCase
{
    use AssertException;

    public static function setUpBeforeClass()
    {
        chmod('tests/Fixtures/EPERM.json', 0);
    }

    public static function tearDownAfterClass()
    {
        chmod('tests/Fixtures/EPERM.json', 0644);
    }

    public function testJsonDecodeFileShouldReturnObjects()
    {
        $this->assertInternalType('object', jsonDecodeFile('composer.json'));
    }

    public function testJsonDecodeFileShouldReturnAssocArrays()
    {
        $this->assertInternalType('array', jsonDecodeFile('composer.json', true));
    }

    public function testJsonDecodeFileShouldAcceptBomFile()
    {
        $this->assertSame(42, jsonDecodeFile('tests/Fixtures/bom-number.json'));
    }

    public function testJsonDecodeFileShouldThrowOnENOENT()
    {
        $this->assertException(function () {
            jsonDecodeFile('tests/Fixtures/ENOENT.json');
        }, FileException::class);
    }

    public function testJsonDecodeFileShouldThrowOnEPERM()
    {
        $this->assertException(function () {
            jsonDecodeFile('tests/Fixtures/EPERM.json');
        }, FileException::class);
    }

    public function testJsonDecodeFileShouldThrowOnInvalidJson()
    {
        $this->assertException(function () {
            jsonDecodeFile('tests/Fixtures/empty.json');
        }, ParsingException::class);
    }
}
