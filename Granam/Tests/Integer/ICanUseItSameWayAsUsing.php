<?php
namespace Granam\Tests\Integer;

use PHPUnit\Framework\TestCase;
use Granam\Integer\Tools\ToInteger;
use Granam\Integer\PositiveIntegerObject;
use Granam\Integer\NegativeIntegerObject;

abstract class ICanUseItSameWayAsUsing extends TestCase
{
    protected function I_can_create_it_same_way_as_using(
        $toIntegerMethod,
        $integerClassToCompare
    )
    {
        $toIntegerClassReflection = new \ReflectionClass(ToInteger::class);

        $toIntegerParameters = $toIntegerClassReflection->getMethod($toIntegerMethod)->getParameters();
        $integerObjectReflection = new \ReflectionClass($integerClassToCompare);
        $integerConstructor = $integerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $this->extractParametersDetails($toIntegerParameters),
            $this->extractParametersDetails($integerConstructor)
        );

        $toPositiveIntegerParameters = $toIntegerClassReflection->getMethod('toPositiveInteger')->getParameters();
        $positiveIntegerObjectReflection = new \ReflectionClass(PositiveIntegerObject::class);
        $positiveIntegerConstructor = $positiveIntegerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $this->extractParametersDetails($toPositiveIntegerParameters),
            $this->extractParametersDetails($positiveIntegerConstructor)
        );

        $toNegativeIntegerParameters = $toIntegerClassReflection->getMethod('toNegativeInteger')->getParameters();
        $positiveIntegerObjectReflection = new \ReflectionClass(NegativeIntegerObject::class);
        $positiveIntegerConstructor = $positiveIntegerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $this->extractParametersDetails($toNegativeIntegerParameters),
            $this->extractParametersDetails($positiveIntegerConstructor)
        );
    }

    /**
     * @param array|\ReflectionParameter[] $parameterReflections
     * @return array
     */
    private function extractParametersDetails(array $parameterReflections)
    {
        $extracted = [];
        foreach ($parameterReflections as $parameterReflection) {
            $extractedParameter = [];
            foreach (get_class_methods($parameterReflection) as $methodName) {
                if (in_array($methodName, ['getName', 'isPassedByReference', 'canBePassedByValue', 'isArray',
                        'isCallable', 'allowsNull', 'getPosition', 'isOptional', 'isDefaultValueAvailable',
                        'getDefaultValue', 'isVariadic'], true)
                    && ($methodName !== 'getDefaultValue' || $parameterReflection->isDefaultValueAvailable())
                ) {
                    $extractedParameter[$methodName] = $parameterReflection->$methodName();
                }
            }
            $extracted[] = $extractedParameter;
        }

        return $extracted;
    }

    protected function assertUsableWithJustValueParameter($sutClass, $testedMethod)
    {
        $classReflection = new \ReflectionClass($sutClass);
        $method = $classReflection->getMethod($testedMethod);
        self::assertSame(1, $method->getNumberOfRequiredParameters(), 'Only single required parameter expected');
    }
}
