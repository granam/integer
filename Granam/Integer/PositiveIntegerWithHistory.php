<?php
namespace Granam\Integer;

/**
 * @method PositiveIntegerWithHistory add(int | float | NumberInterface $value)
 * @method PositiveIntegerWithHistory sub(int | float | NumberInterface $value)
 */
class PositiveIntegerWithHistory extends PositiveIntegerObject
{
    use IntegerWithHistoryTrait;
}