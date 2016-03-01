<?php

namespace StringCalculator\Test;

use StringCalculator\StringCalculator;

require __DIR__ . '/../../../vendor/autoload.php';

class StringCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var StringCalculator */
    private $calculator;

    protected function setUp()
    {
        $this->calculator = new StringCalculator();
    }

    public function test_add_with_empty_string_returns_0()
    {
        $this->assertEquals(0, $this->calculator->add(''));
    }

    public function test_add_with_one_number_returns_that_number()
    {
        $this->assertEquals(1, $this->calculator->add('1'));
    }

    public function test_add_with_two_numbers_returns_the_sum_of_the_two_numbers()
    {
        $this->assertEquals(3, $this->calculator->add('1,2'));
    }

    public function test_add_with_multiple_numbers_returns_the_sum_of_those_numbers()
    {
        $this->assertEquals(6, $this->calculator->add('1,2,3'));
    }

    public function test_add_with_new_lines_delimiter()
    {
        $this->assertEquals(6, $this->calculator->add('1\n2,3'));
    }

    public function test_add_with_custom_delimiter()
    {
        $this->assertEquals(3, $this->calculator->add('//;\n1;2'));
    }

    /**
     * @expectedException \StringCalculator\Exception\StringCalculatorNegativeNumbersException
     * @expectedExceptionMessage Negatives not allowed: -2
     */
    public function test_add_with_one_negative_number_throws_exception()
    {
        $this->calculator->add('1,-2,3');
    }

    /**
     * @expectedException \StringCalculator\Exception\StringCalculatorNegativeNumbersException
     * @expectedExceptionMessage Negatives not allowed: -2, -4
     */
    public function test_add_with_multiple_negative_numbers_throws_exception()
    {
        $this->calculator->add('1,-2,3,-4');
    }

    public function test_add_with_numbers_bigger_than_1000_returns_an_ignore_those_numbers()
    {
        $this->assertEquals(2, $this->calculator->add('2,1001'));
    }

    public function test_add_with_with_any_lenght_custom_delimiter()
    {
        $this->assertEquals(6, $this->calculator->add('//[***]\n1***2***3'));
    }

    public function test_add_with_multiple_custom_delimiters()
    {
        $this->assertEquals(6, $this->calculator->add('//[*][%]\n1*2%3'));
    }

    public function test_extract_with_any_lenght_multiple_custom_delimiters()
    {
        $this->assertEquals(6, $this->calculator->add('//[***][%%%]\n1***2%%%3'));
    }
}