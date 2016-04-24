<?php
namespace Granam\Integer\Tools;

use Granam\Number\Tools\ToNumber;
use Granam\Tools\ValueDescriber;

class ToInteger
{
    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    public static function toInteger($value, $strict = true, $paranoid = false)
    {
        $value = self::convertToNumber($value, $strict, $paranoid);

        if (is_int($value)) {
            return (int)$value;
        }

        $integerValue = (int)$value;
        self::checkIfValueHasNotBeenLost($integerValue, $value);

        return $integerValue;
    }

    /**
     * @param $value
     * @param bool $strict
     * @param bool $paranoid
     * @return int
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    private static function convertToNumber($value, $strict, $paranoid)
    {
        try {
            return ToNumber::toNumber($value, $strict, $paranoid);
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
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
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
