<?php
namespace Granam\Integer;

use Granam\Integer\Tools\ToInteger;
use Granam\Number\NumberObject;

class IntegerObject extends NumberObject implements IntegerInterface
{

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid Throws exception if some value is lost on cast because of rounding
     */
    public function __construct($value, $strict = true, $paranoid = false)
    {
        parent::__construct(ToInteger::toInteger($value, $strict, $paranoid));
    }

}
