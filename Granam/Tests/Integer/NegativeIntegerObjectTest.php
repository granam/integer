<?php
namespace Granam\Tests\Integer;

use Granam\Integer\NegativeInteger;
use Granam\Integer\NegativeIntegerObject;
use Granam\Number\NegativeNumber;

class NegativeIntegerObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function I_can_use_it()
    {
        $zeroNegativeInteger = new NegativeIntegerObject(0);
        self::assertSame(0, $zeroNegativeInteger->getValue());
        self::assertInstanceOf(NegativeInteger::class, $zeroNegativeInteger);
        self::assertInstanceOf(NegativeNumber::class, $zeroNegativeInteger);

        $negativeInteger = new NegativeIntegerObject(-1);
        self::assertSame(-1, $negativeInteger->getValue());
        self::assertInstanceOf(NegativeInteger::class, $negativeInteger);
        self::assertInstanceOf(NegativeNumber::class, $negativeInteger);
    }

    /**
     * @test
     */
    public function I_can_create_it_with_zero()
    {
        $zeroNegativeInteger = new NegativeIntegerObject(0);
        self::assertSame(0, $zeroNegativeInteger->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\NegativeIntegerCanNotBePositive
     * @expectedExceptionMessageRegExp ~\s1~
     */
    public function I_can_not_create_it_positive()
    {
        new NegativeIntegerObject(1);
    }
}