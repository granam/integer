<?php
namespace Granam\Tests\Integer;

use Granam\Number\NumberInterface;
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
        $externalRootReflection = new \ReflectionClass(NumberInterface::class);

        return $externalRootReflection->getNamespaceName();
    }

}
