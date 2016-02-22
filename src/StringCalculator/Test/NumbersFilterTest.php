<?php

namespace StringCalculator\Test;

use StringCalculator\NumbersFilter;

require __DIR__ . '/../../../vendor/autoload.php';

class NumbersFiltersTest extends \PHPUnit_Framework_TestCase
{
    /** @var NumbersFilter */
    private $numbersFilter;

    protected function setUp()
    {
        $this->numbersFilter = new NumbersFilter();
    }

    public function test_filter_with_empty_array_returns_empty_array()
    {
        $this->assertEquals(array(), $this->numbersFilter->filter(array()));
    }

    public function test_filter_with_valid_numbers_returns_the_same_array()
    {
        $this->assertEquals(array(1, 2, 3), $this->numbersFilter->filter(array(1, 2, 3)));
    }

    public function test_filter_with_numbers_bigger_than_1000_returns_an_ignore_those_numbers_array()
    {
        $this->assertEquals(array(1), $this->numbersFilter->filter(array(1, 1001)));
    }
}
