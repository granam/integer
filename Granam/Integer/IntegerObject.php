<?php
namespace Granam\Integer;

use Granam\Integer\Tools\ToInteger;
use Granam\Number\NumberObject;

class IntegerObject extends NumberObject implements IntegerInterface
{

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct(ToInteger::toInteger($value));
    }

}
