<?php
namespace Granam\Integer;

use Granam\Integer\Tools\ToInteger;
use Granam\Scalar\Scalar;

class Integer extends Scalar implements IntegerInterface
{

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = ToInteger::toInteger($value);
    }

}
