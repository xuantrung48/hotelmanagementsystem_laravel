<?php

namespace libs;

use libs\CheckUtil;
use libs\MessageUtil;

class DateUtil
{

    /**
     * get current date
     * @param string format(optional), string timezone(optional)
     * @return date
     */
    public function getDate($format = 'Y-m-d', $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');

            $date_obj = new \DateTimeImmutable('now', new \DateTimeZone($timezone));
        } else {
            $date_obj = new \DateTimeImmutable();
        }
        $result = $date_obj->format($format);
        return $result;
    }

    /**
     * add month
     * @param date $date(required), number $num(required), string $timezone(optional)
     * @return date
     */
    public function addMonth($date, $num, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');
        if (!$checkUtil->checkDate($date)) $messageUtil->errorMessage('10011', 'Date');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $date_obj = new \DateTimeImmutable($date, new \DateTimeZone($timezone));
        } else {
            $date_obj = new \DateTimeImmutable($date);
        }

        $normalMonth  = $date_obj->format('Y-m') . '-01';
        $normalDay = $date_obj->format('d');
        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $tmp_date_obj = new \DateTimeImmutable($normalMonth, new \DateTimeZone($timezone));
        } else {
            $tmp_date_obj = new \DateTimeImmutable($normalMonth);
        }
        $addMonthObj  = $tmp_date_obj->modify($num . ' month');
        $addMonth = $addMonthObj->format('Y-m');
        $addLastDay = $addMonthObj->format('t');
        if ($normalDay > $addLastDay) {
            $result = $addMonth . '-' . $addLastDay;
        } else {
            $result = $addMonth . '-' . $normalDay;
        }
        return $result;
    }

    /**
     * add day
     * @param date $date(required), number $num(required), string $timezone(optional)
     * @return date
     */
    public function addDay($date, $num, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');
        if (!$checkUtil->checkDate($date)) $messageUtil->errorMessage('10011', 'Date');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $date_obj = new \DateTimeImmutable($date, new \DateTimeZone($timezone));
        } else {
            $date_obj = new \DateTimeImmutable($date);
        }
        $modi_date_obj = $date_obj->modify("$num day");
        $result = $modi_date_obj->format('Y-m-d');
        return $result;
    }

    /**
     * add year
     * @param date $date(required), number $num(required), string $timezone(optional)
     * @return date
     */
    public function addYear($date, $num, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->checkNumeric($num)) $messageUtil->errorMessage('10011', 'Number');
        if (!$checkUtil->checkDate($date)) $messageUtil->errorMessage('10011', 'Date');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $date_obj = new \DateTimeImmutable($date, new \DateTimeZone($timezone));
        } else {
            $date_obj = new \DateTimeImmutable($date);
        }
        $modi_date_obj = $date_obj->modify("$num year");
        $result = $modi_date_obj->format('Y-m-d');
        return $result;
    }

    /**
     * get difference days between two dates
     * @param date $date1(required), date $date2(required), string $timezone(optional)
     * @return number days
     */
    public function dateDiff($date1, $date2, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($date1)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->requireCheck($date2)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->checkDate($date1)) $messageUtil->errorMessage('10011', 'Date');
        if (!$checkUtil->checkDate($date2)) $messageUtil->errorMessage('10011', 'Date');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $date1_obj = new \DateTimeImmutable($date1, new \DateTimeZone($timezone));
            $date2_obj = new \DateTimeImmutable($date2, new \DateTimeZone($timezone));
        } else {
            $date1_obj = new \DateTimeImmutable($date1);
            $date2_obj = new \DateTimeImmutable($date2);
        }
        $diff = $date1_obj->diff($date2_obj);
        $result = $diff->format("%a");
        return $result;
    }

    /**
     * get last day of month
     * @param date $date(required),string $timezone(optional)
     * @return number day
     */
    public function lastday($date, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($date)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->checkDate($date)) $messageUtil->errorMessage('10011', 'Date');

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $date_obj = new \DateTimeImmutable($date, new \DateTimeZone($timezone));
        } else {
            $date_obj = new \DateTimeImmutable($date);
        }
        $result = $date_obj->format('t');
        return $result;
    }
}
