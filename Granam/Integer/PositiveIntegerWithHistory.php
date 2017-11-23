<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace Granam\Integer;

/**
 * @method PositiveIntegerWithHistory add(int | float | NumberInterface $value)
 * @method PositiveIntegerWithHistory sub(int | float | NumberInterface $value)
 */
class PositiveIntegerWithHistory extends PositiveIntegerObject
{
    use IntegerWithHistoryTrait;
}