<?php declare(strict_types=1);

namespace Granam\Integer;

use Granam\Integer\Tools\ToInteger;
use Granam\Number\NumberObject;

class IntegerObject extends NumberObject implements IntegerInterface
{

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid Throws exception if some value is lost on cast because of rounding
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    public function __construct($value, bool $strict = true, bool $paranoid = false)
    {
        parent::__construct(ToInteger::toInteger($value, $strict, $paranoid));
    }

    public function getValue(): int
    {
        return parent::getValue();
    }

}
