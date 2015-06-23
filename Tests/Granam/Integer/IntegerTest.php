<?php
namespace Granam\Integer;

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_create_instance()
    {
        $instance = new IntegerObject(12345);
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @param Integer $integer
     *
     * @test
     *
     * @depends can_create_instance
     */
    public function has_local_interface($integer)
    {
        $this->assertInstanceOf('Granam\Integer\IntegerInterface', $integer);
    }

    /**
     * @test
     *
     * @depends can_create_instance
     */
    public function gives_same_value_as_created_with()
    {
        $withInteger = new IntegerObject($integerValue = 123456);
        $this->assertSame($integerValue, $withInteger->getValue());
        $withString = new IntegerObject($stringValue = '123456');
        $this->assertSame(intval($stringValue), $withString->getValue());
    }

    /**
     * @test
     *
     * @depends gives_same_value_as_created_with
     */
    public function can_be_turned_into_string()
    {
        $integer = new IntegerObject($integerValue = 123456);
        $this->assertSame((string)$integerValue, (string)$integer);
    }

    /**
     * @test
     */
    public function float_without_decimal_can_be_used()
    {
        $integer = new IntegerObject($floatValue = 1.0);
        $this->assertSame(1, $integer->getValue());
        $this->assertSame(intval($floatValue), $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function float_with_decimal_cause_exception()
    {
        new IntegerObject(1.1);
    }

    /**
     * @test
     */
    public function false_is_converted_to_zero()
    {
        $integer = new IntegerObject(false);
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(false), $integer->getValue());
    }

    /**
     * @test
     */
    public function true_is_converted_to_one()
    {
        $integer = new IntegerObject(true);
        $this->assertSame(1, $integer->getValue());
        $this->assertSame(intval(true), $integer->getValue());
    }

    /**
     * @test
     */
    public function null_is_converted_to_zero()
    {
        $integer = new IntegerObject(null);
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(null), $integer->getValue());
    }

    /**
     * @test
     */
    public function empty_string_is_converted_to_zero()
    {
        $integer = new IntegerObject('');
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(''), $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function array_cause_exception()
    {
        new IntegerObject([]);
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function resource_cause_exception()
    {
        new IntegerObject(tmpfile());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function object_cause_exception()
    {
        new IntegerObject(new \stdClass());
    }

    /**
     * @test
     */
    public function to_string_object_is_converted_to_its_integer_value()
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
    public function to_string_object_without_integer_is_zero()
    {
        $integer = new IntegerObject(new TestWithToString($string = 'non-integer'));
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval($string), $integer->getValue());
    }

    /**
     * @test
     */
    public function wrapping_zeroes_are_stripped_away()
    {
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
    public function decimal_value_lost_cause_exception()
    {
        new IntegerObject(123.456);
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function integer_value_lost_cause_exception()
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
