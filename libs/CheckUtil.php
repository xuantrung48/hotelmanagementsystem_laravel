<?php

namespace libs;

use DateTimeImmutable;
use Exception;
use libs\MessageUtil;


class CheckUtil
{
    /**
     * check date with format
     * @param date $date(required),string $format(required)
     * @return boolean $result
     */
    public function dateValidate($date, $format)
    {

        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$this->requireCheck($format)) $messageUtil->errorMessage('10010', 'Format');

        $date_obj = date_create_from_format($format, $date);
        if ($date_obj && date_format($date_obj, $format) == $date)
            $result = true;
        else
            $result = false;
        return $result;
    }

    /**
     * check date with timezone
     * @param date $date(required),string $timezone(optional)
     * @return boolean $result
     */
    public function dateCheck($date, $timezone = '')
    {
        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');

        if ($this->checkDate($date, $timezone))
            $result = true;
        else
            $result = false;
        return $result;
    }

    /**
     * check date exist in range
     * @param date $date(required),date $date_range1(required),date date_range2(required),string $timezone(optional)
     * @return boolean $result
     */
    public function dateRangeCheck($date, $date_range1, $date_range2, $timezone = '')
    {
        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$this->requireCheck($date_range1)) $messageUtil->errorMessage('10010', 'Start Date of Range');
        if (!$this->requireCheck($date_range2)) $messageUtil->errorMessage('10010', 'End Date of Range');
        if ($timezone) {
            if (!$this->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
        }
        if (!$this->checkDate($date, $timezone)) $messageUtil->errorMessage('10011', 'Date');
        if (!$this->checkDate($date_range1, $timezone)) $messageUtil->errorMessage('10011', 'Start Date of Range');
        if (!$this->checkDate($date_range2, $timezone)) $messageUtil->errorMessage('10011', 'End Date of Range');

        $date_timestamp   = $this->getTimestampWithZone($date, $timezone);
        $range1_timestamp = $this->getTimestampWithZone($date_range1, $timezone);
        $range2_timestamp = $this->getTimestampWithZone($date_range2, $timezone);

        if ($date_timestamp && $range1_timestamp && $range2_timestamp) {
            if ($date_timestamp >= $range1_timestamp && $date_timestamp <= $range2_timestamp) {
                $result  = true;
            } else if ($date_timestamp < $range1_timestamp) {
                $result  = false;
            } else if ($date_timestamp > $range2_timestamp) {
                $result  = false;
            }
            return $result;
        }
    }


    /**
     * check time with format
     * @param date $time(required),string $format(required)
     * @return boolean $result
     */
    public function timeValidate($time, $format)
    {
        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($time)) $messageUtil->errorMessage('10010', 'Time');
        if (!$this->requireCheck($format)) $messageUtil->errorMessage('10010', 'Format');

        $time_obj = date_create_from_format($format, $time);
        if ($time_obj && date_format($time_obj, $format) == $time) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * check time with timezone
     * @param date $time(required),string $timezone(optional)
     * @return boolean $result
     */
    public function timeCheck($time, $timezone = '')
    {
        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($time)) $messageUtil->errorMessage('10010', 'Time');
        $date = date('Y-m-d') . ' ' . $time;
        if ($this->checkDate($date, $timezone)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * check time exist in range
     * @param time $time(required),time $time_range1(required),time time_range2(required), string $timezone(optional)
     * @return boolean $result
     */
    public function timeRangeCheck($time, $time_range1, $time_range2, $timezone = '')
    {
        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($time)) $messageUtil->errorMessage('10010', 'Time');
        if (!$this->requireCheck($time_range1)) $messageUtil->errorMessage('10010', 'Start Time Of Range');
        if (!$this->requireCheck($time_range2)) $messageUtil->errorMessage('10010', 'End Time Of Range');

        $date        = date('Y-m-d') . ' ' . $time;
        $date_range1 = date('Y-m-d') . ' ' . $time_range1;
        $date_range2 = date('Y-m-d') . ' ' . $time_range2;

        if ($timezone) {
            if (!$this->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
        }
        if (!$this->checkDate($date)) $messageUtil->errorMessage('10011', 'Time');
        if (!$this->checkDate($date_range1)) $messageUtil->errorMessage('10011', 'Start Time Of Range');
        if (!$this->checkDate($date_range2)) $messageUtil->errorMessage('10011', 'End Time Of Range');

        $date_timestamp   = $this->getTimestampWithZone($date, $timezone);
        $range1_timestamp = $this->getTimestampWithZone($date_range1, $timezone);
        $range2_timestamp = $this->getTimestampWithZone($date_range2, $timezone);

        if ($date_timestamp && $range1_timestamp && $range2_timestamp) {
            if ($date_timestamp >= $range1_timestamp && $date_timestamp <= $range2_timestamp) {
                $result = true;
            } else if ($date_timestamp < $range1_timestamp) {
                $result = false;
            } else if ($date_timestamp > $range2_timestamp) {
                $result = false;
            }
            return $result;
        }
    }

    /**
     * check number or numeric string
     * @param numeric $element(required)
     * @return boolean $result
     */
    public function numericValidate($element)
    {
        $result = [];
        if (is_numeric($element)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * check number exist in range
     * @param number $num(required),number $num_range1(required),number num_range2(required)
     * @return boolean $result
     */
    public function numericRangeCheck($num, $num_range1, $num_range2)
    {
        $messageUtil  = new MessageUtil;
        if ($num != 0 && !$this->requireCheck($num)) $messageUtil->errorMessage('10010', 'Number');
        if ($num_range1 != 0 && !$this->requireCheck($num_range1)) $messageUtil->errorMessage('10010', 'Start Number Of Range');
        if ($num_range2 != 0 && !$this->requireCheck($num_range2)) $messageUtil->errorMessage('10010', 'End Number Of Range');

        if (!$this->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');
        if (!$this->checkNumeric($num_range1)) $messageUtil->errorMessage('10011', 'Start Number Of Range');
        if (!$this->checkNumeric($num_range2)) $messageUtil->errorMessage('10011', 'End Number Of Range');

        if ($num >= $num_range1 && $num <= $num_range2) {
            $result = true;
        } else if ($num < $num_range1) {
            $result = false;
        } else if ($num > $num_range2) {
            $result = false;
        }
        return $result;
    }

    /**
     * check employee number
     * @param number $num(required)
     * @return boolean $result
     */
    public function employeeNumberCheck($num)
    {
        $messageUtil  = new MessageUtil;
        if ($num != 0 && !$this->requireCheck($num)) $messageUtil->errorMessage('10010', 'Employee Number');
        $empid_length = config('employee_id_length'); // at least length of employee id

        $pattern = "/^[\d]{" . $empid_length . ",}$/";
        if (preg_match($pattern, $num)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * check phone number
     * @param string $ph_no(required)
     * @return boolean $result
     */
    public function checkPhoneNumber($ph_no)
    {
        $messageUtil  = new MessageUtil;
        if (!$this->requireCheck($ph_no)) $messageUtil->errorMessage('10010', 'Phone Number');

        $pattern  = "/^[(]{0,1}\+?[\d]{1,4}[)]{0,1}[-\s\.\d]*$/";
        if (preg_match($pattern, $ph_no)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * check data exist
     * @param string or other $element
     * @return boolean
     */
    public function requireCheck($element)
    {
        if (is_null($element) || empty($element))
            return false;
        else
            return true;
    }

    /**
     * check number or numeric string
     * @param integer or other, $element
     * @return boolean
     */
    public function checkNumeric($element)
    {
        return is_numeric($element);
    }

    /**
     * check date or time
     * @param date or time $element(required),string $timezone(optional)
     * @return boolean
     */
    public function checkDate($element, $timezone = '')
    {

        try {
            if ($timezone) {
                new \DateTimeImmutable($element, new \DateTimeZone($timezone));
            } else {
                new \DateTimeImmutable($element);
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * get timestamp from date or time
     * @param date or time $element, string $timezone
     * @return timestamp
     */
    public function getTimestampWithZone($date, $timezone = '')
    {
        $messageUtil  = new MessageUtil;
        try {
            if ($timezone) {
                $date_obj  = new \DateTimeImmutable($date, new \DateTimeZone($timezone));
            } else {
                $date_obj  = new \DateTimeImmutable($date);
            }
        } catch (Exception $e) {
            $messageUtil->errorMessage('10011', 'Date');
        }
        $timestamp =  $date_obj->getTimestamp();
        return $timestamp;
    }

    /**
     * check timezone
     * @param string timezone
     * @return boolean
     */
    public function checkTimeZone($timezone)
    {
        try {
            new DateTimeImmutable('now', new \DateTimeZone($timezone));
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * check number only
     * @param string $num
     * @return boolean
     */
    public function checkNumberOnly($num)
    {
        return preg_match("/^[\d]+$/", $num);
    }

    /**
     * check file exist or not
     * @param file $file(required)
     * @return boolean
     */
    public function checkFileExist($file)
    {
        if (file_exists($file))
            return true;
        else
            return false;
    }

    /**
     * check file extension csv or not
     * @param string $file
     * @return boolean
     */
    public function checkCsvExtension($file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext == 'csv')
            return true;
        else
            return false;
    }

    /**
     * check boolean (true or false)
     * @param boolean element
     * @return boolean
     */
    public function checkBoolean($element)
    {
        return is_bool($element);
    }
}
