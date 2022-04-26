<?php

namespace libs;

use libs\MessageUtil;

class FormatUtil
{
    /**
     * format date
     * @param string $date(required),string $format(required), string $timezone(optional)
     * @return string
     */
    public function dateFormat($date, $format, $timezone = '')
    {
        $checkUtil   = new CheckUtil;
        $messageUtil = new MessageUtil;
        if (!$checkUtil->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->requireCheck($format)) $messageUtil->errorMessage('10010', 'Format');
        if (!$checkUtil->checkDate($date)) $messageUtil->errorMessage('10011', 'Date');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $date_obj = new \DateTimeImmutable($date, new \DateTimeZone($timezone));
        } else {
            $date_obj = new \DateTimeImmutable($date);
        }
        $result = $date_obj->format($format);
        return $result;
    }

    /**
     * format time
     * @param string $time(required),string $format(required), string $timezone(optional)
     * @return string
     */
    public function timeFormat($time, $format, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($time)) $messageUtil->errorMessage('10010', 'Time');
        if (!$checkUtil->requireCheck($format)) $messageUtil->errorMessage('10010', 'Format');
        if (!$checkUtil->checkDate($time)) $messageUtil->errorMessage('10011', 'Time');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $time_obj = new \DateTimeImmutable($time, new \DateTimeZone($timezone));
        } else {
            $time_obj = new \DateTimeImmutable($time);
        }
        $result = $time_obj->format($format);
        return $result;
    }

    /**
     * remove zero prefix in number
     * @param number $num(required)
     * @return number
     */
    public function number($num)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if ($num != 0 && !$checkUtil->requireCheck($num)) $messageUtil->errorMessage('10010', 'Number');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');

        if (strlen($num) == 2 && $num > 0 && $num < 10) {
            $num = ltrim($num, '0');
        }
        return $num;
    }

    /**
     * set zero prefix in number
     * @param number $num(required)
     * @return number
     */
    public function numberPrefixZero($num)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if ($num != 0 && !$checkUtil->requireCheck($num)) $messageUtil->errorMessage('10010', 'Number');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');

        if (strlen($num) == 1 && $num > 0 && $num < 10) {
            $num = '0' . $num;
        }
        return $num;
    }

    /**
     * format number
     * @param number $num(required),string $separator(optional),integer $digit(optional)
     * @return number
     */
    public function numberFormat($num, $separator = ',', $digit = 0)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if ($num != 0 && !$checkUtil->requireCheck($num)) $messageUtil->errorMessage('10010', 'Number');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');
        if (!$checkUtil->checkNumeric($digit)) {
            $digit = 0;
        } else {
            $digit = $this->convertPositive($digit);
        }

        $result = number_format($num, $digit, ".", $separator);
        return $result;
    }

    /**
     * format percent number
     * @param number $num(required),integer $digit(optional)
     * @return string
     */
    public function percentFormat($num, $digit = 0)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if ($num != 0 && !$checkUtil->requireCheck($num)) $messageUtil->errorMessage('10010', 'Number');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');
        if (!$checkUtil->checkNumeric($digit)) {
            $digit = 0;
        } else {
            $digit = $this->convertPositive($digit);
        }

        $result = number_format($num, $digit, ".", "") . '%';
        return $result;
    }

    /**
     * format phone number
     * @param string $ph_no(required),string $delimeter(optional)
     * @return string $result
     */
    public function phoneNumberFormat($ph_no, $delimeter = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($ph_no)) $messageUtil->errorMessage('10010', 'Phone Number');
        $result   = $ph_no;
        $check_ph = $checkUtil->checkPhoneNumber($ph_no);
        if ($check_ph) {
            if ($checkUtil->checkNumberOnly($ph_no)) {
                if (strlen($ph_no) == 11) {
                    $result = substr($ph_no, 0, 3) . $delimeter . substr($ph_no, 3, 4) . $delimeter . substr($ph_no, 7, 4);
                }
            }
        }
        return $result;
    }

    /**
     * change absloute value
     * @param integer or other, $element
     * @return absolute value of number
     */
    public function convertPositive($element)
    {
        return abs($element);
    }
}
