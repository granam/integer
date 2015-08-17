<?php
namespace Granam\Integer;

class IntegerInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function interface_exists()
    {
        $this->assertTrue(interface_exists('Granam\Integer\IntegerInterface'));
    }

    /** @test */
    public function inherits_from_scalar_interface()
    {
        $this->assertTrue(is_a('Granam\Integer\IntegerInterface', 'Granam\Number\NumberInterface', true /* allow string as tested class name*/));
    }
}
