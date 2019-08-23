<?php declare(strict_types = 1);

namespace Granam\Tests\Integer\Tools;

use Granam\Integer\IntegerInterface;
use Granam\Number\NumberObject;
use Granam\Tests\ExceptionsHierarchy\Exceptions\AbstractExceptionsHierarchyTest;

class IntegerExceptionsHierarchyTest extends AbstractExceptionsHierarchyTest
{
    protected function getTestedNamespace(): string
    {
        return str_replace('\Tests', '', __NAMESPACE__);
    }

    protected function getRootNamespace(): string
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