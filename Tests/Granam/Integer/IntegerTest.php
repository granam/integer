<?php
namespace Granam\Integer;

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_create_instance()
    {
        $instance = new Integer(12345);
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
        $withInteger = new Integer($integerValue = 123456);
        $this->assertSame($integerValue, $withInteger->getValue());
        $withString = new Integer($stringValue = '123456');
        $this->assertSame(intval($stringValue), $withString->getValue());
    }

    /**
     * @test
     *
     * @depends gives_same_value_as_created_with
     */
    public function can_be_turned_into_string()
    {
        $integer = new Integer($integerValue = 123456);
        $this->assertSame((string)$integerValue, (string)$integer);
    }

    /**
     * @test
     */
    public function float_without_decimal_can_be_used()
    {
        $integer = new Integer($floatValue = 1.0);
        $this->assertSame(1, $integer->getValue());
        $this->assertSame(intval($floatValue), $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function float_with_decimal_cause_exception()
    {
        new Integer(1.1);
    }

    /**
     * @test
     */
    public function false_is_converted_to_zero()
    {
        $integer = new Integer(false);
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(false), $integer->getValue());
    }

    /**
     * @test
     */
    public function true_is_converted_to_one()
    {
        $integer = new Integer(true);
        $this->assertSame(1, $integer->getValue());
        $this->assertSame(intval(true), $integer->getValue());
    }

    /**
     * @test
     */
    public function null_is_converted_to_zero()
    {
        $integer = new Integer(null);
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(null), $integer->getValue());
    }

    /**
     * @test
     */
    public function empty_string_is_converted_to_zero()
    {
        $integer = new Integer('');
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval(''), $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function array_cause_exception()
    {
        new Integer([]);
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function resource_cause_exception()
    {
        new Integer(tmpfile());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function object_cause_exception()
    {
        new Integer(new \stdClass());
    }

    /**
     * @test
     */
    public function to_string_object_is_converted_to_its_integer_value()
    {
        $integer = new Integer(new TestWithToString($integerValue = 12345));
        $this->assertSame($integerValue, $integer->getValue());
        $stringInteger = new Integer(new TestWithToString($stringValue = '98765'));
        $this->assertSame(intval($stringValue), $stringInteger->getValue());
        $floatInteger = new Integer(new TestWithToString($floatValue = 123.0));
        $this->assertSame(intval($floatValue), $floatInteger->getValue());
        $stringFloatInteger = new Integer(new TestWithToString($stringFloatValue = '987.0'));
        $this->assertSame(intval($stringFloatValue), $stringFloatInteger->getValue());
    }

    /**
     * @test
     */
    public function to_string_object_without_integer_is_zero()
    {
        $integer = new Integer(new TestWithToString($string = 'non-integer'));
        $this->assertSame(0, $integer->getValue());
        $this->assertSame(intval($string), $integer->getValue());
    }

    /**
     * @test
     */
    public function wrapping_zeroes_are_stripped_away()
    {
        $integer = new Integer($withLeadingZeroes = '000123');
        $this->assertSame(123, $integer->getValue());
        $this->assertSame(intval($withLeadingZeroes), $integer->getValue());
        $integer = new Integer($zeroesAround = '00012345.000');
        $this->assertSame(12345, $integer->getValue());
        $this->assertSame(intval($zeroesAround), $integer->getValue());
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function decimal_value_lost_cause_exception()
    {
        new Integer(123.456);
    }

    /**
     * @test
     * @expectedException \Granam\Integer\Exceptions\WrongParameterType
     */
    public function integer_value_lost_cause_exception()
    {
        new Integer(PHP_INT_MAX . '123');
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
