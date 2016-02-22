<?php

namespace StringCalculator;

class StringNumbersExtractor
{
    private $delimitersExtractor;

    public function __construct()
    {
        $this->delimitersExtractor = new StringDelimitersExtractor();
    }

    public function extract($string)
    {
        if ('' == $string) {
            return array();
        }

        $delimiters = $this->delimitersExtractor->extract($string);
        $numberString = $this->delimitersExtractor->getNumbersString($string);
        $numbers = explode($delimiters[0], $numberString);

        for ($i=1; $i<count($delimiters); $i++) {
            $explodedNumbers = array();
            foreach ($numbers as $number) {
                $explodedNumbers = array_merge($explodedNumbers, explode($delimiters[$i], $number));
            }
            $numbers = $explodedNumbers;
        }

        return $numbers;
    }
}