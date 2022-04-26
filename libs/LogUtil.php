<?php

namespace libs;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogUtil
{
    /**
     * write information data in log file
     *
     * @author thiri win htwe
     * @create 03/12/2020
     * @param data string
     * @return None (Log output to log file)data can any of the system generate string
     *
     */
    public function logInfo($data, $timezone = null)
    {
        $userId = Auth::id();
        $data = "User ID is :" . $userId . ". Info is :" . $data;

        //check timezone is default or not
        if ($timezone != null) {
            date_default_timezone_set($timezone);
        }
        Log::info($data);
        return false;
    }

    /**
     * write debug data in log file
     *
     * @author thiri win htwe
     * @create 03/12/2020
     * @param data string
     * @return None (Log output to log file)data can any of the system generate string
     *
     */
    public function logDebug($data, $timezone = null)
    {
        $userId = Auth::id();
        $data = "User ID is :" . $userId . ". Info is :" . $data;

        //check timezone is default or not
        if ($timezone != null) {
            date_default_timezone_set($timezone);
        }
        Log::debug($data);
        return false;
    }

    /**
     * write fatal data in log file
     *
     * @author thiri win htwe
     * @create 03/12/2020
     * @param data string
     * @return None (Log output to log file)data can any of the system generate string
     *
     */
    public function logFatal($data, $timezone = null)
    {
        $userId = Auth::id();
        $data = "User ID is :" . $userId . ". Info is :" . $data;

        //check timezone is default or not
        if ($timezone != null) {
            date_default_timezone_set($timezone);
        }

        Log::critical($data);
        return false;
    }

    /**
     * write error data in log file
     *
     * @author thiri win htwe
     * @create 03/12/2020
     * @param data string
     * @return None (Log output to log file)data can any of the system generate string
     *
     */
    public function logError($data, $timezone = null)
    {
        $userId = Auth::id();
        $data = "User ID is :" . $userId . ". Info is :" . $data;

        //check timezone is default or not
        if ($timezone != null) {
            date_default_timezone_set($timezone);
        }

        Log::error($data);
        return false;
    }
}
