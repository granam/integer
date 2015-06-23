<?php
namespace Granam\Integer\Exceptions;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function exception_interface_exists()
    {
        $this->assertTrue(interface_exists('Granam\Integer\Exceptions\Exception'));
    }
}
