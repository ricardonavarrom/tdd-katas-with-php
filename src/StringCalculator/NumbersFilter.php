<?php

namespace StringCalculator;

class NumbersFilter
{
    public function filter($numbers)
    {
        $filteredNumbers = array();
        foreach ($numbers as $number) {
            if (1000 >= $number) {
                $filteredNumbers[] = $number;
            }
        }

        return $filteredNumbers;
    }
}