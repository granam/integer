<?php declare(strict_types=1);

namespace Granam\Integer;

use Granam\Number\NumberInterface;

interface IntegerInterface extends NumberInterface
{
    public function getValue(): int;
}
