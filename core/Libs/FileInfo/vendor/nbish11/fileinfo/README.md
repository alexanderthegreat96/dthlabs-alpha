# FileInfo

[![Build Status][build-img]][build-url]

Provides a simple and flexible API wrapper around PHP's [pathinfo](http://php.net/manual/en/function.pathinfo.php) method.

## Installation
The recommended way of installing this package is through [Composer](https://getcomposer.org/):

```bash
$ composer require nbish11/fileinfo
```

## Basic Usage
```php
<?php
require 'vendor/autoload.php';
$finfo = new FileInfo('C:/path/to/file.txt');

// Using standard API methods:
echo $finfo->getDirectory(); // 'C:/path/to/'
echo $finfo->getBaseName();  // 'file.txt'
echo $finfo->getExtension(); // 'txt'
echo $finfo->getFileName();  // 'file'
echo $finfo->getMimeType();  // 'text/plain'

// Using class properties:
echo $finfo->directory; // 'C:/path/to/'
echo $finfo->basename;  // 'file.txt'
echo $finfo->extension; // 'txt'
echo $finfo->filename;  // 'file'
echo $finfo->mimetype;  // 'text/plain'
```

## Contributing

> Please see [CONTRIBUTING](CONTRIBUTING.md).

## <a name="license"></a>License

> Copyright &copy; 2016 [Nathan Bishop](nbish11@hotmail.com)
>
> Please see [LICENSE](LICENSE.md) for more information.

[build-url]: https://travis-ci.org/nbish11/FileInfo
[build-img]: https://travis-ci.org/nbish11/FileInfo.svg?branch=master
