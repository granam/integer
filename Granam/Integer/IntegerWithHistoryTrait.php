<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace Granam\Integer;

use Granam\History\Partials\WithHistoryTrait;
use Granam\Number\NumberInterface;
use Granam\Number\NumberObject;

trait IntegerWithHistoryTrait
{
    use WithHistoryTrait;

    /**
     * @param mixed $value
     * @param bool $strict = true allows only explicit values, not null and empty string
     * @param bool $paranoid Throws exception if some value is lost on cast because of rounding
     * @throws \Granam\Integer\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    public function __construct($value, bool $strict = true, bool $paranoid = false)
    {
        parent::__construct($value, $strict, $paranoid);
        $this->noticeHistoryChangeFromOutside($this);
    }

    /**
     * @param int|float|string|NumberInterface $value
     * @return IntegerWithHistory|NumberObject
     * @throws \Granam\Number\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function add($value): NumberObject
    {
        /** @var IntegerWithHistory $added */
        $added = parent::add($value);
        $added->adoptHistory($this); // because add() creates new instance (due to immutability)

        return $added;
    }

    /**
     * @param int|float|string|NumberInterface $value
     * @return IntegerWithHistory|NumberObject
     * @throws \Granam\Number\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function sub($value): NumberObject
    {
        /** @var IntegerWithHistory $subtracted */
        $subtracted = parent::sub($value);
        $subtracted->adoptHistory($this); // because sub() creates new instance (due to immutability)

        return $subtracted;
    }

}