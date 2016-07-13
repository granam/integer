<?php
namespace Granam\Tests\Integer;

use Granam\Integer\PositiveInteger;

class PositiveIntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function I_can_use_it()
    {
        $zeroNegativeInteger = new PositiveInteger(0);
        self::assertSame(0, $zeroNegativeInteger->getValue());

        $negativeInteger = new PositiveInteger(3);
        self::assertSame(3, $negativeInteger->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\PositiveIntegerCanNotBeNegative
     * @expectedExceptionMessageRegExp ~\s-1~
     */
    public function I_can_not_create_it_negative()
    {
        new PositiveInteger(-1);
    }
}