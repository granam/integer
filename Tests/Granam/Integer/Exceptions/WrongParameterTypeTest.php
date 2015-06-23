<?php
namespace Granam\Integer\Exceptions;

class WrongParameterTypeTest extends RuntimeTest {

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function can_be_thrown()
    {
        throw new WrongParameterType;
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\Runtime
     */
    public function is_based_on_local_runtime_exception()
    {
        throw new WrongParameterType;
    }
}
