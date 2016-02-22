<?php

namespace StringCalculator;

use StringCalculator\Exception\StringCalculatorNegativeNumbersException;

class NumbersValidator
{
    public function validate($numbers)
    {
        $negativeNumbers = array();
        foreach ($numbers as $number) {
            if (0 > $number) {
                $negativeNumbers[] = $number;
            }
        }

        if (0 < count($negativeNumbers)) {
            throw new StringCalculatorNegativeNumbersException($negativeNumbers);
        }

        return true;
    }
}