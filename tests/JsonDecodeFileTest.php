<?php

namespace Schnittstabil\JsonDecodeFile;

use KHerGe\File\Exception\ResourceException;
use Seld\JsonLint\ParsingException;
use PHPUnit\Framework\TestCase;

/**
 * schnittstabil/sugared-phpunit may depend on Schnittstabil/JsonDecodeFile,
 * thus we need to run tests in seperate processes with new global state
 * to gather code coverage informations of this library, and not the (global)
 * schnittstabil/sugared-phpunit one.
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class JsonDecodeFileTest extends TestCase
{
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
        $this->expectException(ResourceException::class);
        $this->expectExceptionMessage('The file "tests/Fixtures/ENOENT.json" could not be opened (r).');
        jsonDecodeFile('tests/Fixtures/ENOENT.json');
    }

    public function testJsonDecodeFileShouldThrowOnEPERM()
    {
        $this->expectException(ResourceException::class);
        $this->expectExceptionMessage('The file "tests/Fixtures/EPERM.json" could not be opened (r).');
        jsonDecodeFile('tests/Fixtures/EPERM.json');
    }

    public function testJsonDecodeFileShouldThrowOnInvalidJson()
    {
        $this->expectException(ParsingException::class);
        $this->expectExceptionMessage('Parse error on line 1:

^
Expected one of: \'STRING\', \'NUMBER\', \'NULL\', \'TRUE\', \'FALSE\', \'{\', \'[\'');
        jsonDecodeFile('tests/Fixtures/empty.json');
    }
}
