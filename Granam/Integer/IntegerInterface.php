<?php declare(strict_types = 1);

namespace Granam\Integer;

use Granam\Number\NumberInterface;

interface IntegerInterface extends NumberInterface
{
    /**
     * @return int
     */
    public function getValue();
}