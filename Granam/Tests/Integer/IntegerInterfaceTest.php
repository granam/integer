<?php declare(strict_types = 1);

namespace Granam\Tests\Integer;

use PHPUnit\Framework\TestCase;
use Granam\Integer\IntegerInterface;
use Granam\Number\NumberInterface;

class IntegerInterfaceTest extends TestCase
{
    /**
     * @test
    */
    public function interface_exists()
    {
        self::assertTrue(interface_exists(IntegerInterface::class));
    }

    /**
     * @test
    */
    public function inherits_from_scalar_interface()
    {
        self::assertTrue(is_a(
            IntegerInterface::class,
            NumberInterface::class,
            true /* allow string as tested class name*/
        ));
    }
}