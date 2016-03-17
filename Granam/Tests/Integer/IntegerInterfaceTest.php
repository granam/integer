<?php
namespace Granam\Tests\Integer;

class IntegerInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function interface_exists()
    {
        self::assertTrue(interface_exists('Granam\Integer\IntegerInterface'));
    }

    /** @test */
    public function inherits_from_scalar_interface()
    {
        self::assertTrue(is_a(
            'Granam\Integer\IntegerInterface',
            'Granam\Number\NumberInterface',
            true /* allow string as tested class name*/
        ));
    }
}
