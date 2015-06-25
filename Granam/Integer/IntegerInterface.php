<?php
namespace Granam\Integer;

use Granam\Scalar\ScalarInterface;

interface IntegerInterface extends ScalarInterface
{
    /**
     * @return int
     */
    public function getValue();
}
