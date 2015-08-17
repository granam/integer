<?php
namespace Granam\Integer\Exceptions;

class RuntimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function is_marked_by_local_interface()
    {
        $this->assertTrue(is_a('Granam\Integer\Exceptions\Runtime', 'Granam\Integer\Exceptions\Exception', true));
    }

    /**
     * @test
     */
    public function is_marked_by_granam_number_runtime_interface()
    {
        $this->assertTrue(is_a('Granam\Integer\Exceptions\Runtime', 'Granam\Number\Exceptions\Runtime', true));
    }
}
