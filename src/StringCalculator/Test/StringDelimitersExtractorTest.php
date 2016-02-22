<?php

namespace StringCalculator\Test;

use StringCalculator\StringDelimitersExtractor;

require __DIR__ . '/../../../vendor/autoload.php';

class StringDelimitersExtractorTest extends \PHPUnit_Framework_TestCase
{
    /** @var StringDelimitersExtractor */
    private $delimitersExtractor;

    protected function setUp()
    {
        $this->delimitersExtractor = new StringDelimitersExtractor();
    }

    public function test_extract_with_empty_string_returns_empty_array()
    {
        $this->assertEquals(array(), $this->delimitersExtractor->extract(''));
    }

    public function test_extract_without_custom_delimiter_returns_basic_delimiters()
    {
        $this->assertEquals(array(',', '\n'), $this->delimitersExtractor->extract('1'));
        $this->assertEquals(array(',', '\n'), $this->delimitersExtractor->extract('1,2'));
        $this->assertEquals(array(',', '\n'), $this->delimitersExtractor->extract('1\n2,3'));
    }

    public function test_extract_with_custom_delimiter_returns_array_with_custom_delimiter()
    {
        $this->assertEquals(array(';'), $this->delimitersExtractor->extract('//;\n1;2'));
    }

    public function test_extract_with_any_lenght_custom_delimiter_returns_array_with_custom_delimiter()
    {
        $this->assertEquals(array('***'), $this->delimitersExtractor->extract('//[***]\n1***2***3'));
    }

    public function test_extract_with_multiple_custom_delimiters_returns_array_with_those_delimiters()
    {
        $this->assertEquals(array('*', '%'), $this->delimitersExtractor->extract('//[*][%]\n1*2%3'));
    }

    public function test_extract_with_any_lenght_multiple_custom_delimiters_returns_array_with_those_delimiters()
    {
        $this->assertEquals(array('***', '%%%'), $this->delimitersExtractor->extract('//[***][%%%]\n1***2%%%3'));
    }

    public function test_has_custom_delimiters()
    {
        $this->assertFalse($this->delimitersExtractor->hasCustomDelimiters(''));
        $this->assertFalse($this->delimitersExtractor->hasCustomDelimiters('1'));
        $this->assertFalse($this->delimitersExtractor->hasCustomDelimiters('1,2'));
        $this->assertFalse($this->delimitersExtractor->hasCustomDelimiters('1\n2,3'));
        $this->assertTrue($this->delimitersExtractor->hasCustomDelimiters('//;\n1;2'));
        $this->assertTrue($this->delimitersExtractor->hasCustomDelimiters('//[*][%]\n1*2%3'));
    }

    public function test_get_numbers_string_with_empty_string_returns_empty_string()
    {
        $this->assertEquals('', $this->delimitersExtractor->getNumbersString(''));
    }

    public function test_get_numbers_string_without_custom_delimiter()
    {
        $this->assertEquals('1', $this->delimitersExtractor->getNumbersString('1'));
        $this->assertEquals('1\n2,3', $this->delimitersExtractor->getNumbersString('1\n2,3'));
    }

    public function test_get_numbers_string_with_custom_delimiter()
    {
        $this->assertEquals('1;2', $this->delimitersExtractor->getNumbersString('//;\n1;2'));
        $this->assertEquals('1***2***3', $this->delimitersExtractor->getNumbersString('//[***]\n1***2***3'));
    }
}
