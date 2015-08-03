<?php
namespace Granam\Integer;

use Granam\Integer\Tools\ToInteger;
use Granam\Scalar\Scalar;

class IntegerObject extends Scalar implements IntegerInterface
{

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct(ToInteger::toInteger($value));
    }

}
