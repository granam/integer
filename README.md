# Converter and object wrapper for an integer

[![Build Status](https://travis-ci.org/jaroslavtyc/granam-integer.svg?branch=master)](https://travis-ci.org/jaroslavtyc/granam-integer)

Note: requires PHP 5.4+
```php
<?php
use Granam\Integer\Integer;
use Granam\Integer\Exceptions\WrongParameterType;

$integer = new Integer(12345);

// int(12345)
var_dump($integer->getValue());

$integerFromString = new Integer("124578");
// int(124578)
var_dump($integerFromString->getValue());

$integerFromFloatString = new Integer("987.0");
// int(987)
var_dump($integerFromFloatString->getValue());

try {
new Integer(987.123);
} catch (WrongParameterType $integerException) {
   // Something get wrong: Some value has been lost on cast. Got '987.456', cast into integer 987
   echo('Something get wrong: ' . $integerException->getMessage() . "\n");
 }

$integerFromTrue = new Integer(true);
// int(1)
var_dump($integerFromTrue->getValue());

$integerFromNull = new Integer(null);
// int(0)
var_dump($integerFromNull->getValue());
// ...

```
