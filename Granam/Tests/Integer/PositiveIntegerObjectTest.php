<?php declare(strict_types = 1);

namespace Granam\Tests\Integer;

use Granam\Integer\PositiveInteger;
use Granam\Integer\PositiveIntegerObject;
use Granam\Number\PositiveNumber;

class PositiveIntegerObjectTest extends ICanUseItSameWayAsUsing
{
    /**
     * @test
    */
    public function I_can_use_it(): void
    {
        $positiveInteger = new PositiveIntegerObject(3);
        self::assertSame(3, $positiveInteger->getValue());
        self::assertInstanceOf(PositiveInteger::class, $positiveInteger);
        self::assertInstanceOf(PositiveNumber::class, $positiveInteger);
    }

    /**
     * @test
    */
    public function I_can_create_it_with_zero(): void
    {
        $zeroPositiveInteger = new PositiveIntegerObject(0);
        self::assertSame(0, $zeroPositiveInteger->getValue());
    }

    /**
     * @test
     */
    public function I_can_not_create_it_negative(): void
    {
        $this->expectException(\Granam\Integer\Tools\Exceptions\PositiveIntegerCanNotBeNegative::class);
        $this->expectExceptionMessageRegExp('~\s-1~');
        new PositiveIntegerObject(-1);
    }

    /**
     * @test
    */
    public function I_can_use_it_just_with_value_parameter(): void
    {
        $this->assertUsableWithJustValueParameter(PositiveIntegerObject::class, '__construct');
    }

    /**
     * @test
    */
    public function I_can_create_it_same_way_as_using_to_positive_integer_conversion(): void
    {
        $this->I_can_create_it_same_way_as_using('toPositiveInteger', PositiveIntegerObject::class);
    }
}