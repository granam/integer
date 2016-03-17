<?php
namespace Granam\Tests\Integer;

use Granam\Tests\Exceptions\Tools\AbstractExceptionsHierarchyTest;

class ExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return $this->getRootNamespace();
    }

    protected function getRootNamespace()
    {
        return str_replace('\Tests', '', __NAMESPACE__);
    }

    protected function getExternalRootNamespace()
    {
        $externalRootReflection = new \ReflectionClass('\Granam\Number\NumberInterface');

        return $externalRootReflection->getNamespaceName();
    }

}
