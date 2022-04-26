<?php

namespace libs;

use libs\CheckUtil;
use libs\MessageUtil;

class TimeUtil
{

    /**
     * get current date time
     * @param string format(optional), string timezone(optional)
     * @return time
     */
    public function getTime($format = 'H:i:s', $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $time_obj = new \DateTimeImmutable('now', new \DateTimeZone($timezone));
        } else {
            $time_obj = new \DateTimeImmutable();
        }
        $result = $time_obj->format($format);
        return $result;
    }

    /**
     * add month
     * @param date $date(required), number $num(required), string timezone(optional)
     * @return time
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
        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $result_date_obj = new \DateTimeImmutable($result, new \DateTimeZone($timezone));
        } else {
            $result_date_obj = new \DateTimeImmutable($result);
        }
        $result = $result_date_obj->format('H:i:s');
        return $result;
    }

    /**
     * add day
     * @param date $date(required), number $num(required), string timezone(optional)
     * @return time
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
        $result = $modi_date_obj->format('H:i:s');
        return $result;
    }

    /**
     * add year
     * @param date $date(required), number $num(required), string timezone(optional)
     * @return time
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
        $result = $modi_date_obj->format('H:i:s');
        return $result;
    }

    /**
     * add hour
     * @param date $date(required), number $num(required), string timezone(optional)
     * @return time
     */
    public function addHour($date, $num, $timezone = '')
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
        $modi_date_obj = $date_obj->modify("$num hour");
        $result = $modi_date_obj->format('H:i:s');
        return $result;
    }

    /**
     * add minute
     * @param date $date(required), number $num(required), string timezone(optional)
     * @return time
     */
    public function addMinute($date, $num, $timezone = '')
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
        $modi_date_obj = $date_obj->modify("$num minute");
        $result = $modi_date_obj->format('H:i:s');
        return $result;
    }

    /**
     * add second
     * @param date $date(required), number $num(required), string timezone(optional)
     * @return time
     */
    public function addSecond($date, $num, $timezone = '')
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
        $modi_date_obj = $date_obj->modify("$num second");
        $result = $modi_date_obj->format('H:i:s');
        return $result;
    }

    /**
     * get difference time between two dates
     * @param date $date1(required), date $date2(required), string timezone(optional)
     * @return time H:i:s
     */
    public function timeDiff($date1, $date2, $timezone = '')
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->requireCheck($date1)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->requireCheck($date2)) $messageUtil->errorMessage('10010', 'Date');
        if (!$checkUtil->checkDate($date1)) $messageUtil->errorMessage('10011', 'Date');
        if (!$checkUtil->checkDate($date2)) $messageUtil->errorMessage('10011', 'Date');

        $hour1 = 0;
        $hour2 = 0;

        if ($timezone) {
            if (!$checkUtil->checkTimeZone($timezone)) $messageUtil->errorMessage('10011', 'Time Zone');
            $datetimeObj1 = new \DateTimeImmutable($date1, new \DateTimeZone($timezone));
            $datetimeObj2 = new \DateTimeImmutable($date2, new \DateTimeZone($timezone));
        } else {
            $datetimeObj1 = new \DateTimeImmutable($date1);
            $datetimeObj2 = new \DateTimeImmutable($date2);
        }
        $interval = $datetimeObj1->diff($datetimeObj2);

        if ($interval->format('%a') > 0) {
            $hour1 = $interval->format('%a') * 24;
        }
        if ($interval->format('%h') > 0) {
            $hour2 = $interval->format('%h');
        }
        $minute = $interval->format('%i');
        $second = $interval->format('%s');
        $result = ($hour1 + $hour2) . ':' . $minute . ':' . $second;
        return $result;
    }
}
