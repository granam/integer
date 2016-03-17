<?php
namespace Granam\Tests\Integer;

use Granam\Integer\IntegerObject;

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function I_can_create_integer_object()
    {
        $integerObject = new IntegerObject(12345);
        self::assertNotNull($integerObject);
        self::assertInstanceOf('Granam\Integer\IntegerInterface', $integerObject);
    }

    /**
     * @test
     */
    public function I_can_get_value()
    {
        $withInteger = new IntegerObject($integerValue = 123456);
        self::assertSame($integerValue, $withInteger->getValue());
        $withString = new IntegerObject($stringValue = '123456');
        self::assertSame((int)$stringValue, $withString->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_integer_object_as_string()
    {
        $integer = new IntegerObject($integerValue = 123456);
        self::assertSame((string)$integerValue, (string)$integer);
    }

    /**
     * @test
     */
    public function I_can_use_float_without_decimal()
    {
        $integer = new IntegerObject($floatValue = 1.0);
        self::assertSame(1, $integer->getValue());
        self::assertSame((int)$floatValue, $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function I_cannot_use_float_with_decimal()
    {
        new IntegerObject(1.1);
    }

    /**
     * @test
     */
    public function I_can_use_false_as_integer_zero()
    {
        $integer = new IntegerObject(false);
        self::assertSame(0, $integer->getValue());
        self::assertSame((int)false, $integer->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_true_as_integer_one()
    {
        $integer = new IntegerObject(true);
        self::assertSame(1, $integer->getValue());
        self::assertSame((int)true, $integer->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_null_as_integer_zero()
    {
        $integer = new IntegerObject(null);
        self::assertSame(0, $integer->getValue());
        self::assertSame((int)null, $integer->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_empty_string_as_integer_zero()
    {
        $integer = new IntegerObject('');
        self::assertSame(0, $integer->getValue());
        self::assertSame((int)'', $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function I_cannot_use_array()
    {
        new IntegerObject([]);
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function I_cannot_use_resource()
    {
        new IntegerObject(tmpfile());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function I_cannot_use_object()
    {
        new IntegerObject(new \stdClass());
    }

    /**
     * @test
     */
    public function I_can_use_to_string_object()
    {
        $integer = new IntegerObject(new TestWithToString($integerValue = 12345));
        self::assertSame($integerValue, $integer->getValue());
        $stringInteger = new IntegerObject(new TestWithToString($stringValue = '98765'));
        self::assertSame((int)$stringValue, $stringInteger->getValue());
        $floatInteger = new IntegerObject(new TestWithToString($floatValue = 123.0));
        self::assertSame((int)$floatValue, $floatInteger->getValue());
        $stringFloatInteger = new IntegerObject(new TestWithToString($stringFloatValue = '987.0'));
        self::assertSame((int)$stringFloatValue, $stringFloatInteger->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_to_string_object_without_number_as_integer_zero()
    {
        $integer = new IntegerObject(new TestWithToString($string = 'non-integer'));
        self::assertSame(0, $integer->getValue());
        self::assertSame((int)$string, $integer->getValue());
    }

    /**
     * @test
     */
    public function I_get_value_without_trash()
    {
        $integer = new IntegerObject($wrappedWithTrash = '   000123   foo bar');
        self::assertSame(123, $integer->getValue());
        self::assertSame((int)$wrappedWithTrash, $integer->getValue());
        $integer = new IntegerObject($withLeadingZeroes = '000123');
        self::assertSame(123, $integer->getValue());
        self::assertSame((int)$withLeadingZeroes, $integer->getValue());
        $integer = new IntegerObject($zeroesAround = '00012345.000');
        self::assertSame(12345, $integer->getValue());
        self::assertSame((int)$zeroesAround, $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function I_cannot_use_string_number_greater_than_int_max()
    {
        new IntegerObject(PHP_INT_MAX . '123');
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Tools\Exceptions\ValueLostOnCast
     */
    public function I_can_force_exception_throw_for_rounding()
    {
        $value = '123.999999999999999999';
        try {
            $silentlyRounded = new IntegerObject($value);
            self::assertSame(124, $silentlyRounded->getValue());
        } catch (\Exception $exception) {
            self::fail('Unexpected exception: ' . $exception->getMessage());
        }

        new IntegerObject($value, true /* paranoid */);
    }
}

/** inner */
class TestWithToString
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string)$this->value;
    }
}
