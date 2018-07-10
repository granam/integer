<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace Granam\Integer\Tools;

use Granam\Number\Tools\ToNumber;
use Granam\Strict\Object\StrictObject;
use Granam\Tools\ValueDescriber;

class ToInteger extends StrictObject
{
    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, empty string and null (which remains null)
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int|null
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    public static function toIntegerOrNull($value, bool $strict = true, bool $paranoid = false): ?int
    {
        if ($value === null) {
            return null;
        }

        return static::toInteger($value, $strict, $paranoid);
    }

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    public static function toInteger($value, bool $strict = true, bool $paranoid = false): int
    {
        $value = self::convertToNumber($value, $strict, $paranoid);

        if (\is_int($value)) {
            return (int)$value;
        }

        $integerValue = (int)$value;
        self::checkIfValueHasNotBeenLost($integerValue, $value);

        return $integerValue;
    }

    /**
     * @param mixed $value
     * @param bool $strict
     * @param bool $paranoid
     * @return int|float
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    private static function convertToNumber($value, bool $strict, bool $paranoid)
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
     * @param mixed $floatValue
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     */
    private static function checkIfValueHasNotBeenLost(int $integerValue, $floatValue): void
    {
        if ((float)$integerValue !== (float)$floatValue) { // some decimal value or integer overflow has been lost on cast to integer
            throw new Exceptions\WrongParameterType(
                'Some value has been lost on cast. Got ' . ValueDescriber::describe($floatValue) .
                ', cast into ' . ValueDescriber::describe($integerValue)
            );
        }
    }

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, empty string and null (which remains null)
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     * @throws \Granam\Integer\Tools\Exceptions\PositiveIntegerCanNotBeNegative
     */
    public static function toPositiveIntegerOrNull($value, bool $strict = true, bool $paranoid = false): ?int
    {
        if ($value === null) {
            return null;
        }

        return static::toPositiveInteger($value, $strict, $paranoid);
    }

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     * @throws \Granam\Integer\Tools\Exceptions\PositiveIntegerCanNotBeNegative
     */
    public static function toPositiveInteger($value, bool $strict = true, bool $paranoid = false): int
    {
        $integerValue = static::toInteger($value, $strict, $paranoid);
        if ($integerValue < 0) {
            throw new Exceptions\PositiveIntegerCanNotBeNegative(
                'Expected zero or greater, got ' . ValueDescriber::describe($value)
            );
        }

        return $integerValue;
    }

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, empty string and null (which remains null)
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int|null
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     * @throws \Granam\Integer\Tools\Exceptions\NegativeIntegerCanNotBePositive
     */
    public static function toNegativeIntegerOrNull($value, bool $strict = true, bool $paranoid = false): ?int
    {
        if ($value === null) {
            return null;
        }

        return static::toNegativeInteger($value, $strict, $paranoid);
    }

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid = false Throws exception if some value is lost on cast due to rounding on cast
     * @return int
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     * @throws \Granam\Integer\Tools\Exceptions\NegativeIntegerCanNotBePositive
     */
    public static function toNegativeInteger($value, bool $strict = true, bool $paranoid = false): int
    {
        $negativeInteger = static::toInteger($value, $strict, $paranoid);
        if ($negativeInteger > 0) {
            throw new Exceptions\NegativeIntegerCanNotBePositive(
                'Expected zero or lesser, got ' . ValueDescriber::describe($value)
            );
        }

        return $negativeInteger;
    }
}
