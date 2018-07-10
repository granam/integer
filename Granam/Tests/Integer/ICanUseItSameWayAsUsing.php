<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace Granam\Tests\Integer;

use Granam\Tests\Tools\TestWithMockery;
use Granam\Integer\Tools\ToInteger;
use Granam\Integer\PositiveIntegerObject;
use Granam\Integer\NegativeIntegerObject;

abstract class ICanUseItSameWayAsUsing extends TestWithMockery
{
    /**
     * @param string $toIntegerMethod
     * @param string $integerClassToCompare
     * @throws \ReflectionException
     */
    protected function I_can_create_it_same_way_as_using(string $toIntegerMethod, string $integerClassToCompare): void
    {
        $toIntegerClassReflection = new \ReflectionClass(ToInteger::class);

        $toIntegerParameters = $toIntegerClassReflection->getMethod($toIntegerMethod)->getParameters();
        $integerObjectReflection = new \ReflectionClass($integerClassToCompare);
        $integerConstructor = $integerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $toIntegerDetails = $this->extractParametersDetails($toIntegerParameters),
            $constructorDetails = $this->extractParametersDetails($integerConstructor),
            'Method ' . self::getSutClass() . "::{$toIntegerMethod} si called differently than constructor of {$integerClassToCompare}"
        );

        $toPositiveIntegerParameters = $toIntegerClassReflection->getMethod('toPositiveInteger')->getParameters();
        $positiveIntegerObjectReflection = new \ReflectionClass(PositiveIntegerObject::class);
        $positiveIntegerConstructor = $positiveIntegerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $toIntegerDetails = $this->extractParametersDetails($toPositiveIntegerParameters),
            $constructorDetails = $this->extractParametersDetails($positiveIntegerConstructor),
            'Method ' . self::getSutClass() . '::toPositiveInteger() si called differently than constructor of ' . PositiveIntegerObject::class
        );

        $toNegativeIntegerParameters = $toIntegerClassReflection->getMethod('toNegativeInteger')->getParameters();
        $positiveIntegerObjectReflection = new \ReflectionClass(NegativeIntegerObject::class);
        $positiveIntegerConstructor = $positiveIntegerObjectReflection->getConstructor()->getParameters();
        self::assertEquals(
            $this->extractParametersDetails($toNegativeIntegerParameters),
            $this->extractParametersDetails($positiveIntegerConstructor),
            'Method ' . self::getSutClass() . '::toNegativeInteger() si called differently than constructor of ' . NegativeIntegerObject::class
        );
    }

    /**
     * @param array|\ReflectionParameter[] $parameterReflections
     * @return array
     */
    private function extractParametersDetails(array $parameterReflections): array
    {
        $extracted = [];
        foreach ($parameterReflections as $parameterReflection) {
            $extractedParameter = [];
            foreach (get_class_methods($parameterReflection) as $methodName) {
                if (\in_array($methodName, ['getName', 'isPassedByReference', 'canBePassedByValue', 'isArray',
                        'isCallable', 'allowsNull', 'getPosition', 'isOptional', 'isDefaultValueAvailable',
                        'getDefaultValue', 'isVariadic', 'hasType', 'getType'], true)
                    && ($methodName !== 'getDefaultValue' || $parameterReflection->isDefaultValueAvailable())
                ) {
                    try {
                        $extractedParameter[$methodName] = $parameterReflection->$methodName();
                    } catch (\ReflectionException $reflectionException) {
                        self::fail(
                            'A problem occurs when calling ' . $methodName . ' on a parameter reflection: '
                            . $reflectionException->getMessage()
                        );
                    }
                }
            }
            $extracted[] = $extractedParameter;
        }

        return $extracted;
    }

    /**
     * @param string $sutClass
     * @param string $testedMethod
     * @throws \ReflectionException
     */
    protected function assertUsableWithJustValueParameter(string $sutClass, string $testedMethod): void
    {
        $classReflection = new \ReflectionClass($sutClass);
        $method = $classReflection->getMethod($testedMethod);
        self::assertSame(1, $method->getNumberOfRequiredParameters(), 'Only single required parameter expected');
    }
}
