<?php

namespace libs;

use libs\CheckUtil;
use libs\MessageUtil;

class StringUtil
{
    /**
     * convert null to string
     * @param null or string $element(required)
     * @return string
     */
    public function convertNULLString($element)
    {
        if (is_null($element)) $element = '';
        return $element;
    }

    /**
     * convert null to number
     * @param null or number $element(required)
     * @return number
     */
    public function convertNULLNumber($element)
    {
        if (is_null($element)) $element = 0;
        return $element;
    }

    /**
     * parse string for fields of csv to array
     * @param string $file (required)
     * @return array
     */
    public function convertCSVFileToArray($file, $header = false)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->checkFileExist($file)) $messageUtil->errorMessage('10005');
        if (!$checkUtil->checkCsvExtension($file)) $messageUtil->errorMessage('10006');

        $csv = array_map('str_getcsv', file($file));

        if ($header === true) { // if header exist in file
            array_walk($csv, function (&$a) use ($csv) {
                if (count($csv[0]) == count($a)) {
                    $a = array_combine($csv[0], $a);
                } else {
                    if (count($csv[0]) > count($a)) {
                        $data = array_splice($csv[0], 0, count($a));
                        $a = array_combine($data, $a);
                    }
                }
            });
            array_shift($csv);
        }
        return  $csv;
    }

    /**
     * change csv string to array
     * @param string $string (required),$separator(optional)
     * @return array
     */
    public function convertCSVToArray($str, $separator = ',')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($str)) $messageUtil->errorMessage('10010', 'String');

        $result = str_getcsv($str, $separator);
        return $result;
    }

    /**
     * check string contains matches of a pattern.
     * @param string $pattern(required), string $str(required)
     * @return boolean
     */
    public function match($pattern, $str)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($pattern)) $messageUtil->errorMessage('10010', 'Pattern');
        if (!$checkUtil->requireCheck($str)) $messageUtil->errorMessage('10010', 'String');
        $result = preg_match($pattern, $str);
        return $result;
    }

    /**
     * replace all of the matches of the pattern in a string with another string
     * @param string $pattern(required), $str(required), $replace_str(required)
     * @return string
     */
    public function substring($pattern, $str, $replace_str)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($pattern)) $messageUtil->errorMessage('10010', 'Pattern');
        if (!$checkUtil->requireCheck($str)) $messageUtil->errorMessage('10010', 'String');
        if (!$checkUtil->requireCheck($replace_str)) $messageUtil->errorMessage('10010', 'Replace string');
        $result = preg_replace($pattern, $replace_str, $str);
        return $result;
    }
}
