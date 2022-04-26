<?php

namespace App\DBTransaction;

use App\Libs\DBaccessUtil;
use Exception;

/**
 * Destroy database transaction
 */
class Destroy extends DBaccessUtil
{
    /**
     * Constructor to assign interface to variable
     * @param $model
     * @param int id
     */
    public function __construct($model, $id)
    {
        $this->model = $model;
        $this->id = $id;
    }

    /*
	 *call executeProcess method that already write database transaction
	 */
    public function process()
    {
        try {
            $this->model::whereId($this->id)->delete();
            return ['status' => true, 'error' => ''];
        } catch (Exception $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
}
