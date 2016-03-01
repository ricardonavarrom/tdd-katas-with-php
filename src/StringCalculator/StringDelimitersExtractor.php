<?php

namespace StringCalculator;

require __DIR__ . '/../../vendor/autoload.php';

class StringDelimitersExtractor
{
    const CUSTOM_DELIMITER_BEGIN = '//';
    const CUSTOM_DELIMITER_END = '\n';
    const CUSTOM_DELIMITER_SEPARATOR_BEGIN = '[';
    const CUSTOM_DELIMITER_SEPARATOR_END = ']';

    private $basicDelimiters = array(',', '\n');

    public function extract($string)
    {
        if ('' === $string) {
            return array();
        }

        return !$this->hasCustomDelimiters($string)
            ? $this->basicDelimiters
            : $this->getCustomDelimiters($string);
    }

    public function hasCustomDelimiters($string)
    {
        return 0 === strpos($string, self::CUSTOM_DELIMITER_BEGIN, 0);
    }

    private function getCustomDelimiters($string)
    {
        $customDelimitersString = $this->getCustomDelimitersString($string);

        return 1 == strlen($customDelimitersString)
            ? array($customDelimitersString)
            : $this->getCustomDelimitersWithSeparator($customDelimitersString);
    }

    private function getCustomDelimitersString($string)
    {
        return substr(
            $string,
            strlen(self::CUSTOM_DELIMITER_BEGIN),
            strpos($string, self::CUSTOM_DELIMITER_END) - strlen(self::CUSTOM_DELIMITER_END)
        );
    }

    private function getCustomDelimitersWithSeparator($customDelimitersString) {
        $matches = array();
        $regex = '/\\'.self::CUSTOM_DELIMITER_SEPARATOR_BEGIN.'(.*?)\\'.self::CUSTOM_DELIMITER_SEPARATOR_END.'/';
        preg_match_all($regex, $customDelimitersString, $matches);

        return $matches[1];
    }

    public function getNumbersString($string)
    {
        return !$this->hasCustomDelimiters($string)
            ? $string
            : substr($string, strpos($string, self::CUSTOM_DELIMITER_END) + strlen(self::CUSTOM_DELIMITER_END));
    }
}