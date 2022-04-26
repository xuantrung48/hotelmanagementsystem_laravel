<?php

namespace App\Exceptions;

use LogicException;

/**
 * get custome error message and error code
 * note::write ParameterErrorException checking in app/Exceptions/Handler.php
 *
 * @author thiri win htwe
 * @create 11/12/2020
 *
 */

class ParameterErrorException extends LogicException
{
    /**
     * Report the exception.
     *
     * @return void
     *
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json(["message" => $request->getMessage(), "exceptionCode" => $request->getCode(), "flag" => false]);
    }
}
