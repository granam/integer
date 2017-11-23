<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace Granam\Integer;

/**
 * @method NegativeIntegerWithHistory add(int | float | NumberInterface $value)
 * @method NegativeIntegerWithHistory sub(int | float | NumberInterface $value)
 */
class NegativeIntegerWithHistory extends NegativeIntegerObject
{
    use IntegerWithHistoryTrait;
}