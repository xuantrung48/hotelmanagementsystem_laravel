<?php

namespace App\DBTransaction;

use App\Libs\DBaccessUtil;
use Exception;

/**
 * Update database transaction
 */
class Update extends DBaccessUtil
{
    /**
     * Constructor to assign interface to variable
     * @param $model
     * @param int id
     * @param array $data
     */
    public function __construct($model, $id, $data)
    {
        $this->model = $model;
        $this->id = $id;
        $this->data = $data;
    }
    /*
	 *call executeProcess method that already write database transactions
	 */
    public function process()
    {
        try {
            $this->model::whereId($this->id)->update($this->data);
            return ['status' => 'OK', 'error' => ''];
        } catch (Exception $e) {
            return ['status' => 'NG', 'error' => $e->getMessage()];
        }
    }
}
