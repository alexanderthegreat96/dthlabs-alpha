<?php

class FileInfoTest extends PHPUnit_Framework_TestCase
{
    private $finfo;

    /**
     * Setup the set environment.
     */
    public function setUp()
    {
        $this->finfo = new FileInfo('/path/to/file.txt');
    }

    /**
     * Tear down the test environment.
     */
    public function tearDown()
    {
        $this->finfo = null;
    }

    /**
     * Test instance of $this->finfo;
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf('FileInfo', $this->finfo);
    }

    /**
     * Make sure the correct exception is thrown when an
     * invalid data type is passed in through the constructor.
     *
     * @expectedException InvalidArgumentException
     */
    public function testExceptionIsThrownWhenANonStringIsProvided()
    {
        $finfo = new FileInfo(423);
    }

    /**
     * Does a bunch of tests on the magic __get()
     * and __set() methods.
     */
    public function testMagicProperties()
    {
        // Exists
        $this->assertTrue(isset($this->finfo->filename));

        // Retrieves
        $this->assertSame('file.txt', $this->finfo->basename);

        // Allows for random casing
        $this->assertSame('text/plain', $this->finfo->mediatype);
    }

    public function testGetDirectoryUsingClassMethod()
    {
        $this->assertSame('/path/to', $this->finfo->getDirectory());
    }

    public function testGetBaseNameUsingClassMethod()
    {
        $this->assertSame('file.txt', $this->finfo->getBaseName());
    }

    public function testGetExtensionUsingClassMethod()
    {
        $this->assertSame('txt', $this->finfo->getExtension());
    }

    public function testGetFileNameUsingClassMethod()
    {
        $this->assertSame('file', $this->finfo->getFileName());
    }

    public function testGetMimeTypeUsingClassMethod()
    {
        $this->assertSame('text/plain', $this->finfo->getMediaType());
    }

    public function testThrowsErrorWhenAccesingAnUnknownProperty()
    {
        $this->setExpectedException('Exception', 'Undefined property: FileInfo::$notAllowedProperty');

        $value = $this->finfo->notAllowedProperty;
    }
}
