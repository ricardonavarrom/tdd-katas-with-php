<?php

namespace StringCalculator\Test;

use StringCalculator\NumbersValidator;

require __DIR__ . '/../../../vendor/autoload.php';

class NumbersValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var NumbersValidator */
    private $numbersValidator;

    protected function setUp()
    {
        $this->numbersValidator = new NumbersValidator();
    }

    public function test_validate_with_empty_array_returns_true()
    {
        $this->assertTrue($this->numbersValidator->validate(array()));
    }

    public function test_validate_with_valid_numbers_returns_true()
    {
        $this->assertTrue($this->numbersValidator->validate(array(1, 2)));
    }

    /**
     * @expectedException \StringCalculator\Exception\StringCalculatorNegativeNumbersException
     * @expectedExceptionMessage Negatives not allowed: -2
     */
    public function test_validate_with_one_negative_number_throws_exception()
    {
        $this->numbersValidator->validate(array(1, -2, 3));
    }

    /**
     * @expectedException \StringCalculator\Exception\StringCalculatorNegativeNumbersException
     * @expectedExceptionMessage Negatives not allowed: -2, -4
     */
    public function test_validate_with_multiple_negative_numbers_throws_exception()
    {
        $this->numbersValidator->validate(array(1, -2, 3, -4));
    }
}
