<?php
namespace Granam\Tests\Integer;

abstract class ICanUseItSameWayAsUsing extends \PHPUnit_Framework_TestCase
{
    protected function I_can_create_it_same_way_as_using()
    {
        $integerObjectReflection = new \ReflectionClass('\Granam\Integer\IntegerObject');
        $integerConstructor = $integerObjectReflection->getConstructor()->getParameters();
        $toIntegerClassReflection = new \ReflectionClass('\Granam\Integer\Tools\ToInteger');
        $toIntegerParameters = $toIntegerClassReflection->getMethod('toInteger')->getParameters();
        self::assertEquals($toIntegerParameters, $integerConstructor);
        foreach ($integerConstructor as $index => $constructorParameter) {
            $toIntegerParameter = $toIntegerParameters[$index];
            self::assertEquals($toIntegerParameter, $constructorParameter);
            self::assertSame($toIntegerParameter->isOptional(), $constructorParameter->isOptional());
            self::assertSame($toIntegerParameter->allowsNull(), $constructorParameter->allowsNull());
            self::assertSame($toIntegerParameter->isDefaultValueAvailable(), $constructorParameter->isDefaultValueAvailable());
            if ($constructorParameter->isDefaultValueAvailable()) {
                self::assertSame($toIntegerParameter->getDefaultValue(), $constructorParameter->getDefaultValue());
            }
            self::assertSame($toIntegerParameter->getName(), $constructorParameter->getName());
        }
    }

    protected function assertUsableWithJustValueParameter($sutClass, $testedMethod)
    {
        $classReflection = new \ReflectionClass($sutClass);
        $method = $classReflection->getMethod($testedMethod);
        self::assertSame(1, $method->getNumberOfRequiredParameters(), 'Only single required parameter expected');
    }
}