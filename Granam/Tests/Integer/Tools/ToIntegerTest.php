<?php
namespace Granam\Tests\Integer\Tools;

use Granam\Tests\Integer\ICanUseItSameWayAsUsing;
use Granam\Integer\Tools\ToInteger;
use Granam\Integer\IntegerObject;

class ToIntegerTest extends ICanUseItSameWayAsUsing
{
    /**
     * @test
     */
    public function I_can_use_it_just_with_value_parameter()
    {
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toInteger');
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toPositiveInteger');
        $this->assertUsableWithJustValueParameter(ToInteger::class, 'toNegativeInteger');
    }

    /**
     * @test
     */
    public function I_can_create_it_same_way_as_using_integer_object()
    {
        $this->I_can_create_it_same_way_as_using('toInteger', IntegerObject::class);
    }
}