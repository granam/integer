<?php
namespace Granam\Integer\Tools;

use Granam\Number\Tools\ToNumber;
use Granam\Scalar\Tools\ToString;

class ToInteger
{
    /**
     * @param mixed $value
     * @param bool $paranoid Throws exception if some value is lost on cast due to rounding on cast
     *
     * @return int
     */
    public static function toInteger($value, $paranoid = false)
    {
        $value = self::convertToNumber($value, $paranoid);

        if (is_int($value)) {
            return intval($value);
        }

        $stringValue = self::convertToString($value);
        $integerValue = intval($stringValue);

        self::checkIfValueHasNotBeenLost($integerValue, $stringValue);

        return $integerValue;
    }

    private static function convertToNumber($value, $paranoid)
    {
        try {
            return ToNumber::toNumber($value, $paranoid);
        } catch (\Granam\Number\Tools\Exceptions\WrongParameterType $exception) {
            // wrapping by local one
            throw new Exceptions\WrongParameterType($exception->getMessage(), $exception->getCode(), $exception);
        } catch (\Granam\Number\Tools\Exceptions\ValueLostOnCast $exception) {
            // wrapping by local one
            throw new Exceptions\ValueLostOnCast($exception->getMessage(), $exception->getCode(), $exception);
        }
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
