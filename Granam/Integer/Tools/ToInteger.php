<?php
namespace Granam\Integer\Tools;

use Granam\Number\Tools\ToNumber;
use Granam\Tools\ValueDescriber;

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
            return (int)$value;
        }

        $integerValue = (int)$value;
        self::checkIfValueHasNotBeenLost($integerValue, $value);

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

    /**
     * @param int $integerValue
     * @param float $floatValue
     */
    private static function checkIfValueHasNotBeenLost($integerValue, $floatValue)
    {
        if ((float)$integerValue !== (float)$floatValue) { // some decimal value or integer overflow has been lost on cast to integer
            throw new Exceptions\WrongParameterType(
                'Some value has been lost on cast. Got ' . ValueDescriber::describe($floatValue) .
                ', cast into ' . ValueDescriber::describe($integerValue)
            );
        }
    }
}
