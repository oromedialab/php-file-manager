PHP File Manager
=============
Developed and Maintained by Ibrahim Azhar Armar

[![Gitter](https://badges.gitter.im/oromedialab/php-file-manager.svg)](https://gitter.im/oromedialab/php-file-manager?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

Introduction
------------
PHP Utility Class to Manage Files and Operations
* [Canadian Payments Association - CPA-005 Writer](https://github.com/oromedialab/php-file-manager#1-canadian-payments-association---cpa-005-writer)
* [XLS](https://github.com/oromedialab/php-file-manager#2-xls)

#### Install using composer
```
composer require oromedialab/php-file-manager dev-master
```

#### Install using GIT clone
```
git clone https://github.com/oromedialab/php-file-manager.git
```

1. Canadian Payments Association - CPA-005 Writer
-------------
This library performs write operations for [CPA-005](https://www.cdnpay.ca/imis15/pdf/pdfs_rules/standard_005.pdf) files

Canadian Payments Association (CPA) layout is used by Canadian Banks when exchanging electronic CAD or USD payment details with other Canadian Banks. It is recommended for clients who have mainframe systems and only intend processing payments within Canada.  

CPA format cannot be used for electronic payments destined to the United States.  

### Instructions
* Each first and last logical record of any file must be logical record types "A" and "Z" respectively. All other logical records contain transaction information. 
* Logical file must consist of logical records in sequence of: A, D, Z.
* Multiple logical files up to a maximum of 1000 can be submitted on a physical transmission.
* The maximum length for a savings or chequing account number drawn on a Canadian financial institution is 12 digits. This 12 digit restriction is set by the Canadian Payments Association (CPA).
* Maximum of 6 segments are allowed per logical record type with segmentable interface
* File name must not exceed 27 characters (no spaces or special symbols are allowed)
* Credit and debit transactions cannot be commingled in a single file.
* Transaction value dates cannot extend beyond seven calendar days in the past or 60 calendar days in the future from the import date.
* The total number of transactions within the file, total dollar amount of the transactions in the file, and the total number of lines in the file will be validated against the values entered in the trailer record. If the figures do not match up, the file will be rejected.

### Example
```php
// Use statement
use Oml\PHPFileManager\Document\CPA005\LogicalRecord;
use Oml\PHPFileManager\Document\CPA005\Segment;
use Oml\PHPFileManager\Document\CPA005\Writer;
use Oml\PHPFileManager\Document\CPA005\File;
use Oml\PHPFileManager\Document\CPA005\Utility\TransactionType;
// Intialize file writer
$file = new File\DAT();
$file->setFileName('1111');
// Intialize logical record type "A"
$typeA = new LogicalRecord\TypeA;
$typeA->setLogicalRecordCount(1);
$typeA->setOriginatorAccountNumber('1111111111');
$typeA->setFileCreationNumber('1111');
$typeA->setFileCreationDate(new \DateTime('now'));
$typeA->setFileProcessingCentre('11111');

// Add logical record type to file for writing
$file->addLogicalRecord($typeA, 'A');

// Intialize logical record type "C"
$typeC = new LogicalRecord\TypeC;
$typeC->setLogicalRecordCount(2);
$typeC->setOriginatorAccountNumber('1111111111');
$typeC->setFileCreationNumber('1111');

// Add segments to logical record type "C" (Maximum of 6 segments can be added to each of segmentable logical record)
$segment = new Segment\TypeC;
$segment->setTransactionType(TransactionType::ACCOUNTS_PAYABLE);
$segment->setAmount('111.11');
$segment->setPaymentDate(new \DateTime('now'));
$segment->setInstitutionCode('111');
$segment->setTransitNumber('11111');
$segment->setBankAccountNumber('1111111');
$segment->setOriginatorShortName('XXXX.YYY');
$segment->setCustomerName('XXXXXXXX XXXX');
$segment->setOriginatorLongName('XXXXXXXXXXXX.YYYY');
$segment->setOriginatorDirectClearerUserId('1111111111');
$segment->setOriginatorCrossReferenceNumber('XXXXXXX XXX');
$segment->setReturnInstitutionCode('111');
$segment->setReturnBranchTransitNumber('11111');
$segment->setReturnBranchAccountNumber('111111');

// Add first segment to logical record type C
$typeC->addSegment($segment);

// Add logical record type to file for writing
$file->addLogicalRecord($typeC);

// Intialize logical record type "Z" (Pass "C" for Credit and "D" for Debit in the constructor)
$typeZ = new LogicalRecord\TypeZ('C');
$typeZ->setLogicalRecordCount(3);
$typeZ->setOriginatorAccountNumber('1111111111');
$typeZ->setFileCreationNumber('1111');
$typeZ->setTotalAmountOfCredits('111.11');
$typeZ->setTotalAmountOfDebits('0');
$typeZ->setTotalNumberOfCredits('1');
$typeZ->setTotalNumberOfDebits('1');
// Add logical record type to file for writing
$file->addLogicalRecord($typeZ, 'Z');

// Write content to file for download
$writer = new Writer;
$writer->setFile($file);
$writer->download();
// If you want to dump file content
$writer->dump();
```

2. Xls
-------------
Write and download array content to XLS file using simple to use syntax

```php
use Oml\PHPFileManager\Document\Xls;

// XLS Writer
$doc = new Xls\Writer;
$doc->addRows(array('Ibrahim', 'Azhar', 'azhar@iarmar.com'));
$doc->addRows(array('John', 'Doe', 'john@doe.com'));
$doc->download();

// XLS Reader
$doc = new Xls\Reader('/file/path/document.xlsx');
// Replace column with indexes
$doc->replaceColumnWithIndex('0', 'last_name');
$doc->replaceColumnWithIndex('1', 'first_name');
$doc->replaceColumnWithIndex('2', 'email');
// Remove column with indexes
$doc->removeColumnWithIndexes(array('25, 26, 27'));
// Dump content
$content = $doc->toArray();
```
