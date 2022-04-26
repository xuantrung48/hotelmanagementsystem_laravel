<?php

namespace libs;

use App\Exceptions\ParameterErrorException;
use Throwable;

class MessageUtil
{

    /**
     * get message data from message.php
     *
     * @author thiri win htwe
     * @create 03/12/2020
     * @param message code, attribute
     * @return message string
     *
     **/
    public function getMessage($data, $attribute = '')
    {
        try {

            $messages = trans('messages.' . $data, ['attribute' => $attribute]);
        } catch (Throwable $e) {
            return $e;
        }
        return $messages;
    }

    /**
     * get error message data from errorMessage.php
     *
     * @author thiri win htwe
     * @create 03/12/2020
     * @param string code, attribute
     * @return string string
     *
     **/
    public function getErrorMessage($data, $attribute = '')
    {
        try {
            $errMessages =  trans('errorMessages.' . $data, ['attribute' => $attribute]);
        } catch (Throwable $e) {
            return $e->getMessage();
        }
        return $errMessages;
    }

    /**
     * throw error message
     * @param string timezone
     * @return boolean
     */

    public function errorMessage($errno, $attribute = '')
    {
        $errorMsg = $this->getErrorMessage($errno, $attribute);
        throw new ParameterErrorException($errorMsg, $errno);
    }
}
