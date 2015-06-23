<?php
namespace Granam\Integer\Tools;

use Granam\Scalar\Tools\ToString;

class ToInteger
{
    public static function toInteger($value)
    {
        if (is_int($value) || is_bool($value) || is_null($value)) {
            // true = 1; false = 0; null = 0
            return intval($value);
        }

        $stringValue = self::convertToString($value);
        $integerValue = intval($stringValue);

        self::checkIfValueHasNotBeenLost($integerValue, $stringValue);

        return $integerValue;
    }

    private static function convertToString($value)
    {
        try {
            return trim(ToString::toString($value));
        } catch (\Granam\Scalar\Exceptions\WrongParameterType $exception) {
            // wrapping the exception to local one
            throw new Exceptions\WrongParameterType($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    private static function checkIfValueHasNotBeenLost($integerValue, $stringValue)
    {
        if (floatval($integerValue) !== floatval($stringValue)) { // some decimal value or integer overflow has been lost on cast to integer
            throw new Exceptions\WrongParameterType(
                'Some value has been lost on cast. Got ' . var_export($stringValue, true) . ', cast into integer ' . $integerValue
            );
        }
    }
}
