# Converter and object wrapper for an integer

[![Build Status](https://travis-ci.org/jaroslavtyc/granam-integer.svg?branch=master)](https://travis-ci.org/jaroslavtyc/granam-integer)

## Hint
First of all, make sure you don't need just a [simple  built-in int validation](http://php.net/manual/en/function.filter-var.php).

#### Versions requirements
 - 6.* requires [PHP 7.1+](http://php.net/releases/7_1_0.php) ```composer require granam/integer:6.*```
 - 5.* requires [PHP 7.0+](http://php.net/releases/7_0_0.php) ```composer require granam/integer:5.*```
 - 4.* requires [PHP 5.6+](http://php.net/releases/5_6_0.php) ```composer require granam/integer:4.*```
 - 3.* requires [PHP 5.4+](http://php.net/releases/5_4_0.php) ```composer require granam/integer:3.*```
```php
<?php
use Granam\Integer\IntegerObject;
use Granam\Integer\Tools\Exceptions\WrongParameterType;

$integer = new IntegerObject(12345);

// int(12345)
var_dump($integer->getValue());

$integerFromString = new IntegerObject('124578');
// int(124578)
var_dump($integerFromString->getValue());

$integerFromFloatString = new IntegerObject('987.0');
// int(987)
var_dump($integerFromFloatString->getValue());

try {
    new IntegerObject(987.123);
} catch (WrongParameterType $integerException) {
   // Something get wrong: Some value has been lost on cast. Got '987.456', cast into integer 987
   echo('Something get wrong: ' . $integerException->getMessage() . "\n");
 }

$integerFromTrue = new IntegerObject(true);
// int(1)
var_dump($integerFromTrue->getValue());

$integerFromNull = new IntegerObject(null);
// int(0)
var_dump($integerFromNull->getValue());
// ...

$stringWithAlmostInteger = '0.9999999999999999';
$integerFromStringWithAlmostInteger = new IntegerObject($stringWithAlmostInteger);
// int(1)
var_dump($integerFromStringWithAlmostInteger->getValue());
// int(0) -- because of (int)(float)$value
var_dump((int)$stringWithAlmostInteger);

```
