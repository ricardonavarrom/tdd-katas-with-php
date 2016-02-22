<?php

namespace StringCalculator\Test;

use StringCalculator\StringNumbersExtractor;

require __DIR__ . '/../../../vendor/autoload.php';

class StringNumbersExtractorTest extends \PHPUnit_Framework_TestCase
{
    /** @var StringNumbersExtractor */
    private $numbersExtractor;

    protected function setUp()
    {
        $this->numbersExtractor = new StringNumbersExtractor();
    }

    public function test_extract_with_empty_string_returns_empty_array()
    {
        $this->assertEquals(array(), $this->numbersExtractor->extract(''));
    }

    public function test_extract_with_one_number_string_returns_an_array_with_that_number()
    {
        $this->assertEquals(array(1), $this->numbersExtractor->extract('1'));
    }

    public function test_extract_with_two_numbers_string_returns_an_array_with_those_numbers()
    {
        $this->assertEquals(array(1, 2), $this->numbersExtractor->extract('//;\n1;2'));
    }

    public function test_extract_with_multiple_numbers_string_returns_an_array_with_those_numbers()
    {
        $this->assertEquals(array(1, 2, 3), $this->numbersExtractor->extract('//[*][%]\n1*2%3'));
    }
}
