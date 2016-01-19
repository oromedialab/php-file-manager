PHP File Manager
=============
PHP Utility Class to Manage Files and Operations

#### Install using composer
```
composer.phar require oro-media-lab/php-file-manager dev-master
```

#### Install using GIT clone
```
git clone https://github.com/oro-media-lab/php-file-manager.git
```

Xls Writer
-------------

```php
use Oml\PHPFileManager\Document\Xls;

$doc = new Xls\Writer;
$doc->addRows(array('Ibrahim', 'Azhar', 'azhar@iarmar.com'));
$doc->addRows(array('John', 'Doe', 'john@doe.com'));
$doc->download();
```