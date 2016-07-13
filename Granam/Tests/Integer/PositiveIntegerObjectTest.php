<?php
namespace Granam\Tests\Integer;

use Granam\Integer\PositiveInteger;
use Granam\Integer\PositiveIntegerObject;
use Granam\Number\PositiveNumber;

class PositiveIntegerObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function I_can_use_it()
    {
        $positiveInteger = new PositiveIntegerObject(3);
        self::assertSame(3, $positiveInteger->getValue());
        self::assertInstanceOf(PositiveInteger::class, $positiveInteger);
        self::assertInstanceOf(PositiveNumber::class, $positiveInteger);
    }

    /**
     * @test
     */
    public function I_can_create_it_with_zero()
    {
        $zeroPositiveInteger = new PositiveIntegerObject(0);
        self::assertSame(0, $zeroPositiveInteger->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\PositiveIntegerCanNotBeNegative
     * @expectedExceptionMessageRegExp ~\s-1~
     */
    public function I_can_not_create_it_negative()
    {
        new PositiveIntegerObject(-1);
    }
}