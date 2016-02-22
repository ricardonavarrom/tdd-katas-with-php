<?php

namespace StringCalculator\Exception;

use Exception;

class StringCalculatorNegativeNumbersException extends \Exception
{
    private $negativeNumbers;

    public function __construct($negativeNumbers)
    {
        $this->negativeNumbers = $negativeNumbers;
        parent::__construct($this->generateMessage());
    }

    private function generateMessage()
    {
        return 'Negatives not allowed: '.implode(', ', $this->negativeNumbers);
    }
}