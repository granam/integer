<?php
namespace Granam\Tests\Integer\Tools;

use Granam\Tests\Exceptions\Tools\AbstractExceptionsHierarchyTest;

class ExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return str_replace('\Tests', '', __NAMESPACE__);
    }

    protected function getRootNamespace()
    {
        $rootReflection = new \ReflectionClass('\Granam\Integer\IntegerInterface');

        return $rootReflection->getNamespaceName();
    }

    protected function getExternalRootNamespaces()
    {
        $externalRootReflection = new \ReflectionClass('\Granam\Number\NumberObject');

        return $externalRootReflection->getNamespaceName();
    }

}
