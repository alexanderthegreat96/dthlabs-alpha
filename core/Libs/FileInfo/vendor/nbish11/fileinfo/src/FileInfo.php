<?php

/**
 * Provides a simple and flexible API wrapper around PHP's pathinfo function.
 *
 * @version 1.0.0
 * @author Nathan Bishop (nbish11)
 * @copyright 2016 Nathan Bishop
 * @license MIT
 *
 * @property string $directory
 * @property string $basename
 * @property string $extension
 * @property string $filename
 * @property string $mediatype
 */
class FileInfo
{
    /**
     * If a mimetype was NOT found this will be returned; which is
     * sufficient in most cases.
     *
     * @var string
     */
    const DEFAULT_MIMETYPE = 'application/octet-stream';

    /**
     * The file to check for.
     *
     * @var string
     */
    private $file;

    /**
     * The loaded media types.
     *
     * @var array[]
     */
    private static $mediaTypes;

    /**
     * Constructs a new `FileInfo` instance.
     *
     * @param string $file Path to file.
     */
    public function __construct($file)
    {
        if ( ! is_string($file)) {
            throw new InvalidArgumentException('FileInfo expects a string.');
        }

        // cache loaded media types
        if (self::$mediaTypes === null) {
            self::$mediaTypes = $this->loadMediaTypes();
        }

        $this->file = $file;
    }

    /**
     * Retrieve the directory of the file.
     *
     * @return string E.g. C:/wamp/www/FileInfo/src
     */
    public function getDirectory()
    {
        return dirname($this->file);
    }

    /**
     * Retrieve the filename and the extension.
     *
     * @return string E.g. FileInfo.php
     */
    public function getBaseName()
    {
        return basename($this->file);
    }

    /**
     * The extension of the file.
     *
     * @return string E.g. php
     */
    public function getExtension()
    {
        return substr(strrchr($this->getBasename(), '.'), 1);
    }

    /**
     * The basename without the extension.
     *
     * @return string E.g. FileInfo
     */
    public function getFileName()
    {
        return basename($this->file, '.' . $this->getExtension());
    }

    /**
     * The media type of the file, or the most likely.
     *
     * @return string E.g. application/json
     */
    public function getMediaType()
    {
        return $this->guessMediaTypeFromExtension();
    }

    /**
     * Checks if an arbitrary property exists.
     *
     * @param  string $key
     * @return boolean
     */
    public function __isset($key)
    {
        $allowed = array(
            'directory',
            'basename',
            'extension',
            'filename',
            'mediatype'
        );

        return in_array(strtolower($key), $allowed);
    }

    /**
     * Retrieve an arbitrary property.
     *
     * @param  string $key
     * @return string
     */
    public function __get($key)
    {
        switch (strtolower($key)) {
            case 'directory':
                return $this->getDirectory();

            case 'basename':
                return $this->getBaseName();

            case 'extension':
                return $this->getExtension();

            case 'filename':
                return $this->getFileName();

            case 'mediatype':
                return $this->getMediaType();

            default:
                throw new Exception(sprintf('Undefined property: %s::$%s', __CLASS__, $key));
        }
    }

    /**
     * Guess the media type from the file extension.
     *
     * @return string
     */
    private function guessMediaTypeFromExtension()
    {
        $self = $this;  // Hack for PHP 5.3. 5.4 and up works as expected.

        $mediaType = array_filter(self::$mediaTypes, function ($extensions) use ($self) {
            return in_array($self->getExtension(), $extensions);
        });

        return empty($mediaType) ? self::DEFAULT_MIMETYPE : key($mediaType);
    }

    /**
     * Loads the "mediatypes.json" file.
     *
     * @see https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
     * @return array
     */
    private function loadMediaTypes()
    {
        return json_decode(file_get_contents(__DIR__ . '/mediatypes.json'), true);
    }
}
