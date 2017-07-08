<?php
namespace Granam\Integer;

/**
 * @method NegativeIntegerWithHistory add(int | float | NumberInterface $value)
 * @method NegativeIntegerWithHistory sub(int | float | NumberInterface $value)
 */
class NegativeIntegerWithHistory extends NegativeIntegerObject
{
    use IntegerWithHistoryTrait;
}