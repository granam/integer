<?php
namespace Granam\Tests\Integer;

abstract class ICanUseItSameWayAsUsing extends \PHPUnit_Framework_TestCase
{
    protected function I_can_create_it_same_way_as_using()
    {
        $toIntegerClassReflection = new \ReflectionClass('\Granam\Integer\Tools\ToInteger');
        $toIntegerParameters = $toIntegerClassReflection->getMethod('toInteger')->getParameters();
        $integerObjectReflection = new \ReflectionClass('\Granam\Integer\IntegerObject');
        $integerConstructor = $integerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $this->extractParametersDetails($toIntegerParameters),
            $this->extractParametersDetails($integerConstructor)
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
