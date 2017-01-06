<?php
namespace Granam\Tests\Integer\Tools;

use Granam\Integer\IntegerInterface;
use Granam\Number\NumberObject;
use Granam\Tests\Exceptions\Tools\AbstractExceptionsHierarchyTest;

class ExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return str_replace('\Tests', '', __NAMESPACE__);
    }

    protected function getRootNamespace()
    {
        $rootReflection = new \ReflectionClass(IntegerInterface::class);

        return $rootReflection->getNamespaceName();
    }

    protected function getExternalRootNamespaces()
    {
        $externalRootReflection = new \ReflectionClass(NumberObject::class);

        return $externalRootReflection->getNamespaceName();
    }

}