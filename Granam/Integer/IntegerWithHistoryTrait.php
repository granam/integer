<?php
namespace Granam\Integer;

use Granam\History\Partials\WithHistoryTrait;
use Granam\Number\NumberInterface;

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
    public function __construct($value, $strict = true, $paranoid = false)
    {
        parent::__construct($value, $strict, $paranoid);
        $this->noticeHistoryChangeFromOutside($this);
    }

    /**
     * @param int|float|NumberInterface $value
     * @return IntegerWithHistory
     * @throws \Granam\Number\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function add($value)
    {
        /** @var IntegerWithHistory $added */
        $added = parent::add($value);
        $added->adoptHistory($this); // because add() creates new instance (due to immutability)

        return $added;
    }

    /**
     * @param int|float|NumberInterface $value
     * @return IntegerWithHistory
     * @throws \Granam\Number\Tools\Exceptions\WrongParameterType
     * @throws \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function sub($value)
    {
        /** @var IntegerWithHistory $subtracted */
        $subtracted = parent::sub($value);
        $subtracted->adoptHistory($this); // because sub() creates new instance (due to immutability)

        return $subtracted;
    }

}