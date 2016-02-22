<?php

namespace StringCalculator;

class StringCalculator
{
    /** @var StringNumbersExtractor */
    private $numbersExtractor;

    /** @var NumbersFilter */
    private $numbersFilter;

    /** @var NumbersValidator */
    private $numbersValidator;

    public function __construct()
    {
        $this->numbersExtractor = new StringNumbersExtractor();
        $this->numbersFilter = new NumbersFilter();
        $this->numbersValidator = new NumbersValidator();
    }

    public function add($numbers)
    {
        $numbers = $this->numbersExtractor->extract($numbers);
        $numbers = $this->numbersFilter->filter($numbers);
        $this->numbersValidator->validate($numbers);

        $result = 0;
        foreach ($numbers as $number) {
            $result += $number;
        }

        return $result;
    }
}