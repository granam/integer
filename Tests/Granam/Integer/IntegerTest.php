<?php
namespace Granam\Integer;

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function I_can_create_integer_object()
    {
        $integerObject = new IntegerObject(12345);
        $this->assertNotNull($integerObject);
        $this->assertInstanceOf('Granam\Integer\IntegerInterface', $integerObject);
    }

    /**
     * @test
     */
    public function I_can_get_value()
    {
        $withInteger = new IntegerObject($integerValue = 123456);
        $this->assertSame($integerValue, $withInteger->getValue());
        $withString = new IntegerObject($stringValue = '123456');
        $this->assertSame(intval($stringValue), $withString->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_integer_object_as_string()
    {
        $integer = new IntegerObject($integerValue = 123456);
        $this->assertSame((string)$integerValue, (string)$integer);
    }

    /**
     * @test
     */
    public function I_can_use_float_without_decimal()
    {
        $integer = new IntegerObject($floatValue = 1.0);
        $this->assertSame(1, $integer->getValue());
        $this->assertSame(intval($floatValue), $integer->getValue());
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
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(false), $integer->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_true_as_integer_one()
    {
        $integer = new IntegerObject(true);
        $this->assertSame(1, $integer->getValue());
        $this->assertSame(intval(true), $integer->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_null_as_integer_zero()
    {
        $integer = new IntegerObject(null);
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(null), $integer->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_empty_string_as_integer_zero()
    {
        $integer = new IntegerObject('');
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(''), $integer->getValue());
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
        $this->assertSame($integerValue, $integer->getValue());
        $stringInteger = new IntegerObject(new TestWithToString($stringValue = '98765'));
        $this->assertSame(intval($stringValue), $stringInteger->getValue());
        $floatInteger = new IntegerObject(new TestWithToString($floatValue = 123.0));
        $this->assertSame(intval($floatValue), $floatInteger->getValue());
        $stringFloatInteger = new IntegerObject(new TestWithToString($stringFloatValue = '987.0'));
        $this->assertSame(intval($stringFloatValue), $stringFloatInteger->getValue());
    }

    /**
     * @test
     */
    public function I_can_use_to_string_object_without_number_as_integer_zero()
    {
        $integer = new IntegerObject(new TestWithToString($string = 'non-integer'));
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval($string), $integer->getValue());
    }

    /**
     * @test
     */
    public function I_get_value_without_trash()
    {
        $integer = new IntegerObject($wrappedWithTrash = '   000123   foo bar');
        $this->assertSame(123, $integer->getValue());
        $this->assertSame(intval($wrappedWithTrash), $integer->getValue());
        $integer = new IntegerObject($withLeadingZeroes = '000123');
        $this->assertSame(123, $integer->getValue());
        $this->assertSame(intval($withLeadingZeroes), $integer->getValue());
        $integer = new IntegerObject($zeroesAround = '00012345.000');
        $this->assertSame(12345, $integer->getValue());
        $this->assertSame(intval($zeroesAround), $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function I_cannot_use_string_number_greater_than_int_max()
    {
        new IntegerObject(PHP_INT_MAX . '123');
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
