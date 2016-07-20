<?php
namespace Granam\Tests\Integer\Tools;

use Granam\Tests\Integer\ICanUseItSameWayAsUsing;

class ToIntegerTest extends ICanUseItSameWayAsUsing
{
    /**
     * @test
     */
    public function I_can_use_it_just_with_value_parameter()
    {
        $this->assertUsableWithJustValueParameter('\Granam\Integer\Tools\ToInteger', 'toInteger');
        $this->assertUsableWithJustValueParameter('\Granam\Integer\Tools\ToInteger', 'toPositiveInteger');
        $this->assertUsableWithJustValueParameter('\Granam\Integer\Tools\ToInteger', 'toNegativeInteger');
    }

    /**
     * @test
     */
    public function I_can_create_it_same_way_as_using_integer_object()
    {
        $this->I_can_create_it_same_way_as_using('toInteger', '\Granam\Integer\IntegerObject');
    }
}