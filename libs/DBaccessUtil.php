<?php

namespace libs;

use Illuminate\Support\Facades\DB;
use libs\MessageUtil;
use Exception;
use Illuminate\Support\Facades\Log;

class DBaccessUtil
{

    /**
     * Calling process method to wrap database transaction automatically
     *
     * @return boolean
     */
    public function executeProcess()
    {
        // get caller file name
        $callerFile = debug_backtrace()[0]['file'];
        // get error occur line number from caller file
        $errorLineNo = debug_backtrace()[0]['line'];

        DB::beginTransaction();
        try {
            $result = $this->process();
            // if $result is not array and `status` is not exists
            if (!is_array($result) || !isset($result['status'])) {
                DB::rollBack();
                Log::debug('process() method that instantiate from ' . __CLASS__ . ' must be return array with format [\'status\' => boolean, \'error\'=>\'some error message\'] in file ' . $callerFile . ' at line ' . $errorLineNo . ' that instantiate the class ' . get_called_class());
                return false;
            }
            // if result['status'] is true, then commit
            if ($result['status']) {
                DB::commit();
                return true;
            } else {
                // if result is false, some process error occur
                DB::rollBack();
                // writing log for strange conditions
                Log::debug('Process Error: ' . $result['error'] . ' in file ' . $callerFile . ' at line ' . $errorLineNo . ' that instantiate the class ' . get_called_class());
                return false;
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage() . ' in file ' . $callerFile . ' at line ' . $errorLineNo . ' that instantiate the class ' . get_called_class());
            return false;
        }
    }

    /**
     * Write your data access(insert/update/delete) without needing database transaction
     * This method is to be overide from inheritance class
     *
     * @return  array
     * @format	['status' => boolean, 'error'=>'some error message']
     * Note: 'error' key can be omit if status is true in return array
     */
    public function process()
    {
    }

    /**
     *
     *	@param query string
     *   @return query result
     *
     *
     **/


    public function trycatch($query, $type)
    {

        DB::beginTransaction();

        try {
            $result = DB::$type($query); //insert query

            if ($type == "select") return $result;

            else return true;

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            $msgUtil  = new MessageUtil;
            $errorMsg = $msgUtil->getErrorMessage('20000', 'Number');

            throw new Exception($errorMsg);
        }
    }

    public function select($query)
    {

        $type = "select";   // query type

        return $this->trycatch($query, $type);
    }

    public function insert($query)
    {

        $type = "insert";   // query type

        return $this->trycatch($query, $type);
    }

    public function update($query)
    {
        $type = "update";   // query typ
        return $this->trycatch($query, $type);
    }

    /**
     *
     *	@param $tableName=>database table name
     *   @param $attributes=> name of the column where it match  (in associate array)
     *   @param $value => name of the column where it match the (in associate array)
     *   @return query result
     *
     *
     **/

    public function updateorcreate_($tableName, $attributes, $value)
    {


        try {

            $exception = DB::transaction(function () use ($tableName, $attributes, $value) {
                $result = DB::table($tableName)->updateOrInsert($attributes, $value);

                if ($result == "true") {
                    return $result;
                } else {

                    $msgUtil  = new MessageUtil;
                    -$errorMsg = $msgUtil->getErrorMessage('20001', 'Number');
                    throw new Exception($errorMsg);
                }
            });
        } catch (\Exception $e) {

            //return "there is error";
            $msgUtil  = new MessageUtil;
            $errorMsg = $msgUtil->getErrorMessage('20000', 'Number');

            throw new Exception($errorMsg);
        }
    }

    public function delete($query)
    {

        //  $result = DB::delete($query);  //delete query
        $type = "delete";   // query typ
        return $this->trycatch($query, $type);
    }

    //this is for bulk query .
    public function transitionInsert($query)
    {


        try {

            //db transaction start here and all query strings will be in arrays
            $exception = DB::transaction(function () use ($query) {

                foreach ($query as $key => $val) {
                    $result[$key] =  DB::update($val);       // do querys for all array  db::update and db::insert , both works as same

                }
                if (in_array("0", $result)) throw new Exception;  //  if there is error in update, throw exception

            });


            //check error in db transaction

            if (is_null($exception)) {
                return "Query is successful";
            } else {
                throw new Exception;
            }
        } catch (\Exception $e) {

            $msgUtil  = new MessageUtil;
            $errorMsg = $msgUtil->getErrorMessage('20000', 'Number');

            throw new Exception($errorMsg);
        }
    }

    //this is for bulk query .
    public function transitionSelect($query)
    {

        try {

            //db transaction start here and all query strings will be in arrays
            $exception = DB::transaction(function () use ($query) {

                foreach ($query as $key => $val) {
                    $result[$key] = DB::select($val);  // do querys for all array
                }
                return print_r($result);
            });
        } catch (\Exception $e) {

            $msgUtil  = new MessageUtil;
            $errorMsg = $msgUtil->getErrorMessage('20000', 'Number');

            throw new Exception($errorMsg);
        }
    }



    /**
     *
     *	@param sql file name that stored in sql folder inside resources folder that is inside public folder
     *           (/public/resources/sql/)
     *   @param  value array
     *   @return query result
     *
     *
     **/

    public function query_sql($sqlFileName, $param = [])
    {

        DB::beginTransaction();
        try {
            $rows = DB::query()->sql($sqlFileName, $param);

            return response()->json($rows);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();

            $msgUtil  = new MessageUtil;
            $errorMsg = $msgUtil->getErrorMessage('20000', 'Number');

            throw new Exception($errorMsg);
        }
    }
}
