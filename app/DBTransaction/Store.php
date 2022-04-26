<?php

namespace App\DBTransaction;

use App\Libs\DBaccessUtil;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Store database transaction
 */
class Store extends DBaccessUtil
{
    /**
     * Constructor to assign interface to variable
     * @param $model
     * @param array $data
     */
    public function __construct($model, $data)
    {
        $this->model = $model;
        $this->data = $data;
    }
    /*
	 *call executeProcess method that already write database transaction
	 */
    public function process()
    {
        try {
            $this->model::insert($this->data);
            return ['status' => 'OK', 'message' => 'Successfully saved'];
        } catch (Exception $e) {
            return ['status' => 'NG', 'message' => $e->getMessage()];
        }
    }
}
