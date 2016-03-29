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
    }

    /**
     * @test
     */
    public function I_can_create_it_same_way_as_using_number_object()
    {
        parent::I_can_create_it_same_way_as_using();
    }
}