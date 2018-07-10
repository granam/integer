<?php
namespace Granam\Tests\Integer\Tools;

use Granam\Tests\Integer\ICanUseItSameWayAsUsing;
use Granam\Integer\Tools\ToInteger;
use Granam\Integer\IntegerObject;

class ToIntegerTest extends ICanUseItSameWayAsUsing
{
    /**
     * @test
     * @throws \ReflectionException
     */
    public function I_can_use_it_just_with_value_parameter(): void
    {
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toInteger');
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toPositiveInteger');
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toPositiveIntegerOrNull');
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toNegativeInteger');
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toNegativeIntegerOrNull');
    }

    /**
     * @test
     * @throws \ReflectionException
     */
    public function I_can_create_it_same_way_as_using_integer_object(): void
    {
        $this->I_can_create_it_same_way_as_using('toInteger', IntegerObject::class);
    }

    /**
     * @test
     * @dataProvider provideValueOrNull
     * @param $value
     * @param int|null $expectedValue
     */
    public function I_can_get_integer_or_null($value, ?int $expectedValue): void
    {
        self::assertSame($expectedValue, ToInteger::toIntegerOrNull($value));
        if ($expectedValue === null || $expectedValue <= 0) {
            self::assertSame($expectedValue, ToInteger::toNegativeIntegerOrNull($value));
        }
        if ($expectedValue === null || $expectedValue >= 0) {
            self::assertSame($expectedValue, ToInteger::toPositiveIntegerOrNull($value));
        }
    }

    public function provideValueOrNull(): array
    {
        return [
            [null, null],
            [1, 1],
            [new IntegerObject(-159), -159],
            ['999.0', 999],
        ];
    }
}