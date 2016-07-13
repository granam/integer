<?php
namespace Granam\Tests\Integer;

use Granam\Integer\NegativeInteger;

class NegativeIntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function I_can_use_it()
    {
        $zeroNegativeInteger = new NegativeInteger(0);
        self::assertSame(0, $zeroNegativeInteger->getValue());

        $negativeInteger = new NegativeInteger(-1);
        self::assertSame(-1, $negativeInteger->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\NegativeIntegerCanNotBePositive
     * @expectedExceptionMessageRegExp ~\s1~
     */
    public function I_can_not_create_it_positive()
    {
        new NegativeInteger(1);
    }
}