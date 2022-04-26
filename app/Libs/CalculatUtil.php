<?php

namespace App\Libs;

use App\Libs\CheckUtil;
use App\Libs\MessageUtil;

class CalculatUtil
{
    /**
     * add numbers
     * @param numeric $a(required),$b(required), boolean $errorFlg(not required)
     * @return numeric, string for error
     */
    public function add($a, $b, $errorFlg = true)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;

        if (!$checkUtil->checkNumeric($a) || !$checkUtil->checkNumeric($b)) {
            $errorFlg = false;
        }
        if ($errorFlg) {
            $result = ($a + $b);
            return $result;
        } else {
            $messageUtil->errorMessage('10011', 'Number');
        }
    }

    /**
     * subtract numbers
     * @param numeric $a(required), $b(required), boolean $errorFlg(not required)
     * @return numeric ,string for error
     */
    public function subtract($a, $b, $errorFlg = true)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;

        if (!$checkUtil->checkNumeric($a) || !$checkUtil->checkNumeric($b)) {
            $errorFlg = false;
        }
        if ($errorFlg) {
            $result = ($a - $b);
            return $result;
        } else {
            $messageUtil->errorMessage('10011', 'Number');
        }
    }

    /**
     * divide numbers
     * @param numeric $a(required), $b(required), boolean $errorFlg(not required)
     * @return numeric, string for error
     */
    public function division($a, $b, $errorFlg = true)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->checkNumeric($a) || !$checkUtil->checkNumeric($b)) {
            $errorFlg = false;
        }
        if ($errorFlg) {
            if ($b == 0) {
                return 0;
            }
            $result = ($a / $b);
            return $result;
        } else {
            $messageUtil->errorMessage('10011', 'Number');
        }
    }

    /**
     * multiply numbers
     * @param numeric $a(required), $b(required), boolean $errorFlg(not required)
     * @return numeric, string for error
     */
    public function multiply($a, $b, $errorFlg = true)
    {
        $checkUtil    = new CheckUtil;
        $messageUtil  = new MessageUtil;
        if (!$checkUtil->checkNumeric($a) || !$checkUtil->checkNumeric($b)) {
            $errorFlg = false;
        }
        if ($errorFlg) {
            $result = ($a * $b);
            return $result;
        } else {
            $messageUtil->errorMessage('10011', 'Number');
        }
    }
}
